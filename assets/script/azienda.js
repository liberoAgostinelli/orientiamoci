"use strict";

import getIdUserLoggato from "./script.js";

import { dominio } from "./myFunction.js";

const tr = document.getElementById("tr");
const t_body = document.getElementById("t_body");
const wForm = document.getElementById("wForm");

let toggle = true; // Toggle che serve per...

const idUserLoggato = await getIdUserLoggato();

const params = [
  "ID",
  "Ragione Sociale",
  "P. iva",
  "N. dipendenti",
  "N. tel",
  "Email",
  "Indirizzo",
  "Comune",
  "Provincia",
  "Regione",
  "Referente",
  "Ambito",
  "Note",
  "Descrizione",
  "Id_user",
];

function caricaTr(params) {
  for (let i = 0; i < params.length; i++) {
    const th = document.createElement("th");
    th.innerText = params[i];
    tr.appendChild(th);
  }
  tr.appendChild(document.createElement("th"));
  tr.appendChild(document.createElement("th"));
}

function createTable() {
  fetch(dominio + "/api/azienda/getAziende.php")
    .then((response) => response.json())
    .then((data) => {
      //console.log(data);
      for (let i = 0; i < data.length; i++) {
        const tr = document.createElement("tr");
        const tdBtnMod = document.createElement("td");
        const btnMod = document.createElement("button");
        btnMod.innerText = "Modifica";
        btnMod.setAttribute("id", data[i].id_azienda);
        btnMod.classList.add("btn");
        btnMod.classList.add("btn_mod");
        btnMod.addEventListener("click", (e) => {
          //console.log(e.target.id);
          let id = e.target.id;
          let valuesAzienda = getAzienda(e.target.id);
          modForm(id, valuesAzienda);
        });
        tdBtnMod.appendChild(btnMod);
        const tdBtnCanc = document.createElement("td");
        const btnCanc = document.createElement("button");
        btnCanc.innerText = "Cancella";
        btnCanc.setAttribute("id", data[i].id_azienda);
        btnCanc.classList.add("btn");
        btnCanc.classList.add("btn_canc");
        btnCanc.addEventListener("click", (e) => {
          //console.log(e.target.id);
          deleteElem(e.target.id);
          deleteTable(); // Cancella intera tabella
          createTable(); // Ricostruisce l'intera tabella
        });
        tdBtnCanc.appendChild(btnCanc);
        //console.log(data[i]);

        Object.keys(data[i]).forEach((key) => {
          const td = document.createElement("td");
          td.innerText = data[i][key];
          tr.appendChild(td);
        });

        tr.appendChild(tdBtnMod);
        tr.appendChild(tdBtnCanc);
        t_body.appendChild(tr);
      }
    })
    .catch((data) => {
      console.error("Error: ", data.message);
    });
}

function deleteTable() {
  t_body.innerHTML = "";
}

function deleteElem(id) {
  fetch(dominio + "/api/azienda/deleteAzienda.php", {
    method: "DELETE",
    body: JSON.stringify(id),
  })
    .then((response) => response.json())
    .then((data) => console.log(data));
}

function createForm(titolo, path, method, params = [], values = []) {
  const prs = [...params];
  prs.shift();
  //console.log(prs);
  const form = document.createElement("form");
  form.setAttribute("method", method);
  form.setAttribute("action", path);
  form.classList.add("form");
  // Div per la x
  const divX = document.createElement("div");
  divX.classList.add("x");
  const spanX = document.createElement("span");
  spanX.addEventListener("click", deleteForm);
  spanX.innerText = "X";
  divX.appendChild(spanX);
  form.appendChild(divX);
  // Div per il titolo
  const divTitolo = document.createElement("div");
  divTitolo.classList.add("wInput");
  const span = document.createElement("span");
  span.innerText = titolo;
  divTitolo.appendChild(span);
  form.appendChild(divTitolo);

  const arrInput = [];
  for (let i = 0; i < 11; i++) {
    const div = document.createElement("div");
    div.classList.add("wInput");
    const input = document.createElement("input");
    if (prs[i] === "Email") {
      input.setAttribute("type", "email");
    } else {
      input.setAttribute("type", "text");
    }

    input.setAttribute("placeholder", prs[i]);
    if (values.length !== 0) input.value = values[i];
    div.appendChild(input);
    form.appendChild(div);
    arrInput.push(input);
  }

  const divTextAreaNote = document.createElement("div");
  divTextAreaNote.classList.add("wInput");
  const textAreaNote = document.createElement("textarea");
  textAreaNote.setAttribute("placeholder", "Note");
  if (values.length !== 0) textAreaNote.value = values[11];
  arrInput.push(textAreaNote);

  divTextAreaNote.appendChild(textAreaNote);
  form.appendChild(divTextAreaNote);

  const divTextAreaDesc = document.createElement("div");
  divTextAreaDesc.classList.add("wInput");
  const textAreadesc = document.createElement("textarea");
  textAreadesc.setAttribute("placeholder", "Descrizione");
  if (values.length !== 0) textAreadesc.value = values[12];
  arrInput.push(textAreadesc);

  divTextAreaDesc.appendChild(textAreadesc);
  form.appendChild(divTextAreaDesc);

  const divSubmit = document.createElement("div");
  divSubmit.classList.add("winput");
  const input_submit = document.createElement("input");
  input_submit.setAttribute("type", "submit");
  input_submit.classList.add("btnSubmit");
  divSubmit.appendChild(input_submit);
  form.appendChild(divSubmit);

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    //console.log(dati);
    const paramsInput = [];
    for (let i = 0; i < arrInput.length; i++) {
      paramsInput.push(arrInput[i].value);
    }
    paramsInput.push(idUserLoggato);
    //console.log("Pi: " + paramsInput);
    fetch(path, {
      method: method,
      headers: {
        "Content-Type": "application/json",
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: JSON.stringify(paramsInput),
    })
      .then((response) => response.json())
      .then((data) => {
        deleteTable();
        createTable();
        deleteForm();
        resetForm();
      });
  });

  wForm.appendChild(form);
  toggle = false;
}

function resetForm() {
  createForm(
    "Aggiungi Azienda",
    dominio + "/api/azienda/postAzienda.php",
    "POST",
    params
  );
}

function deleteForm() {
  console.log("delete form");
  if (toggle === false) {
    wForm.innerHTML = "";
    toggle = true;
  }
}

function modForm(id, values) {
  //console.log(values);
  wForm.innerHTML = "";
  createForm(
    "Modifica Azienda ID " + id,
    dominio + "/api/azienda/modAzienda.php?id=" + id,
    "POST",
    params,
    values
  );
}

const btn_add = document.getElementById("btn_add");
btn_add.addEventListener("click", () => {
  if (toggle === true)
    createForm(
      "Aggiungi Azienda",
      dominio + "/api/azienda/postAzienda.php",
      "POST",
      params
    );
});

function getAzienda(id) {
  fetch(dominio + "/api/azienda/getAzienda.php?id=" + id)
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      let values = [];
      Object.keys(data).forEach((key) => {
        values.push(data[key]);
      });
      values.shift();
      modForm(data.id_azienda, values);
    });
}
caricaTr(params);
createTable(); // Richiesta campi tabella e creazione tabella
