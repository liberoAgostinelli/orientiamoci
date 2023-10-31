"use strict";

import { getAziende, getAziendaUsaTech, dominio } from "./myFunction.js";

let toggle_table = true;

const array_aziende = await getAziende();

const wrap_page = document.getElementById("wrap_page");

/**
 * Fetch che richiede tramite una chiamata get alla pagina getAziende.php
 * tutte le aziende presenti nel database nella tabella Aziende.
 * getAziende.php ritorna un array di oggetti con tutti i campi chiave valore
 * in json che po vengono ritrasformati in oggetti da response.json()
 */
async function createPage(array_aziende) {
  /**
   * For eseguito per ogni azienda
   */
  for (let i = 0; i < array_aziende.length; i++) {
    wrap_page.appendChild(await createWrappAzienda(array_aziende[i]));
  }
  //console.log(data);
}

/**
 * Funzione creatrice di wrap_azienda
 */

async function createWrappAzienda(campi_azienda) {
  //console.log(campi_azienda);
  const wrap_azienda = document.createElement("div");
  wrap_azienda.classList.add("wrap_azienda");
  wrap_azienda.classList.add("flex");
  wrap_azienda.setAttribute("id", "wrap_azienda_" + campi_azienda.id_azienda);

  wrap_azienda.appendChild(await createContentAzienda(campi_azienda));
  wrap_azienda.appendChild(await createWrappTechAssoc(campi_azienda));
  wrap_azienda.appendChild(createDivAddTech(campi_azienda.id_azienda));
  return wrap_azienda;
}

/**
 * Funzione che crea il div con i dati dell'azienda
 * @param {*} campi_azienda
 * @returns
 */
async function createContentAzienda(campi_azienda) {
  //console.log("createContentAzienda");
  const content_azienda = document.createElement("div");
  content_azienda.classList.add("content_azienda");

  /**
   * ForEach eseguito per ogni campo dell'azienda dove viene constuito
   * componente content_azienda
   */
  Object.keys(campi_azienda).forEach((key) => {
    const div_field = document.createElement("div");
    div_field.classList.add("field");
    div_field.classList.add("flex");

    const span_colum = document.createElement("span");
    span_colum.classList.add("span_colum");
    span_colum.classList.add("flex");
    span_colum.innerText = key;

    const span_field = document.createElement("span");
    span_field.classList.add("span_field");
    span_field.classList.add("flex");
    span_field.innerText = campi_azienda[key];

    div_field.appendChild(span_colum);
    div_field.appendChild(span_field);

    content_azienda.appendChild(div_field);
  });
  return content_azienda;
}

/**
 * Funzione che tramite una chiamata get si fa restituire tutte le tecnologie
 * associate all'azienda, tramite l'id_tecnologia.
 *
 * @param {data} : array di oggetti composi dalle righe della tabella Azienda_usa_tech,
 * dove id = id_azienda. Righe restituite dalla tabella Azienda_usa_tech dove id = id passato.
 */
async function createWrappTechAssoc(campi_azienda) {
  //console.log("createWrappTechAssoc");
  const campi_tech_assoc = await getAziendaUsaTech(campi_azienda.id_azienda);
  //console.log(campi_tech_assoc);
  const wrap_tech_assoc = document.createElement("div");
  wrap_tech_assoc.setAttribute(
    "id",
    "wrap_tech_assoc_" + campi_azienda.id_azienda
  );
  wrap_tech_assoc.classList.add("wrap_tech_assoc");
  const div_tech_assoc = document.createElement("div");
  div_tech_assoc.setAttribute(
    "id",
    "div_tech_assoc_" + campi_azienda.id_azienda
  );

  div_tech_assoc.classList.add("div_tech_assoc");
  div_tech_assoc.classList.add("flex");

  for (let i = 0; i < campi_tech_assoc.length; i++) {
    //console.log(campi_tech_assoc[i]);
    div_tech_assoc.appendChild(
      await createDivTech(campi_tech_assoc[i], campi_azienda)
    );
  }
  wrap_tech_assoc.appendChild(div_tech_assoc);
  return wrap_tech_assoc;
}

async function createDivTech(campi_tech, campi_azienda) {
  //console.log(campi_tech);

  const div_tech = document.createElement("div");
  div_tech.classList.add("div_tech");
  div_tech.classList.add("flex");

  Object.keys(campi_tech).forEach((key) => {
    //console.log(key + " : " + elem[key]);
    if (key === "id_azienda" || key === "id_tecnologia") {
    } else {
      const span = document.createElement("span");
      span.innerText = campi_tech[key];
      div_tech.appendChild(span);
    }
  });
  //console.log("fine obj key");
  const btn_elimina_tech = document.createElement("button");
  btn_elimina_tech.setAttribute("data-id_azienda", campi_tech.id_azienda);
  btn_elimina_tech.setAttribute("data-id_tecnologia", campi_tech.id_tecnologia);
  btn_elimina_tech.innerText = "Elimina";

  btn_elimina_tech.addEventListener("click", async (e) => {
    // console.log("id_azienda: " + e.target.dataset["id_azienda"]);
    // console.log("id_tecnologia " + e.target.dataset["id_tecnologia"]);
    eliminaTechAssociata(
      e.target.dataset["id_azienda"],
      e.target.dataset["id_tecnologia"]
    );
    deleteTableAssoc(campi_tech.id_azienda, campi_azienda);
    //console.log(wrap_azienda);
    //console.log(createWrappTechAssoc(campi_azienda));
  });
  div_tech.appendChild(btn_elimina_tech);

  return div_tech;
}

async function deleteTableAssoc(campi_tech_id_azienda, campi_azienda) {
  document.getElementById("div_tech_assoc_" + campi_tech_id_azienda).remove();
  const wrap_tech_assoc = document.getElementById(
    "wrap_tech_assoc_" + campi_tech_id_azienda
  );
  wrap_tech_assoc.appendChild(await createWrappTechAssoc(campi_azienda));
}

/**
 * Funzione che crea il div aggiungi tecnologia
 */

function createDivAddTech(id) {
  const div_add_Tech = document.createElement("div");
  div_add_Tech.classList.add("div_add_Tech");
  div_add_Tech.setAttribute("id", "div_add_Tech_" + id);

  const btn_add = document.createElement("button");
  btn_add.classList.add("btn_add");
  btn_add.setAttribute("id", "btn_add_" + id);
  btn_add.innerText = "Aggiungi";

  btn_add.addEventListener("click", (e) => {
    console.log(e.target);
    if (toggle_table === true) {
      div_add_Tech.appendChild(creaTable(id));
      //toggle_table = false;
    }
  });

  div_add_Tech.appendChild(btn_add);

  return div_add_Tech;
}

function eliminaTechAssociata(id_azienda, id_tecnologia) {
  fetch(
    dominio +
      "/api/azienda2tech/deleteAssoc.php?id_azienda=" +
      id_azienda +
      "&" +
      "id_tecnologia=" +
      id_tecnologia,
    {
      method: "DELETE",
      body: JSON.stringify([id_azienda, id_tecnologia]),
    }
  )
    .then((response) => response.json())
    .then((data) => console.log(data));
}

function creaTable(id) {
  const wrap_table = document.createElement("div");
  wrap_table.classList.add("wrap_table");
  wrap_table.setAttribute("id", "wrap_table_" + id);

  const divX = document.createElement("div");
  divX.classList.add("x");
  const spanX = document.createElement("span");
  spanX.addEventListener("click", (e) => {
    console.log(e.target);
    deleteTable(id);
  });
  spanX.innerText = "X";
  spanX.setAttribute("id", "span_table_tech_" + id);
  divX.appendChild(spanX);

  wrap_table.appendChild(divX);

  const table = document.createElement("table");
  table.classList.add("styled-table");
  table.setAttribute("id", "table_" + id);

  const thead = document.createElement("thead");

  const tr = document.createElement("tr");

  const t_body = document.createElement("tbody");

  fetch(dominio + "/api/tecnologia/getTecnologie.php")
    .then((response) => response.json())
    .then((data) => {
      //console.log(data);
      Object.keys(data[0]).forEach((key) => {
        const th = document.createElement("th");
        th.innerText = key;
        tr.appendChild(th);
      });
      tr.appendChild(document.createElement("th"));

      for (let i = 0; i < data.length; i++) {
        const tr = document.createElement("tr");
        Object.keys(data[i]).forEach((key) => {
          const td = document.createElement("td");
          td.innerText = data[i][key];
          tr.appendChild(td);
        });
        const btn_aggiungi_tech = document.createElement("button");
        btn_aggiungi_tech.innerText = "+";
        btn_aggiungi_tech.classList.add("btn");
        btn_aggiungi_tech.classList.add("btn_mod");
        btn_aggiungi_tech.setAttribute("data-id_azienda", id);
        btn_aggiungi_tech.setAttribute(
          "data-id_tecnologia",
          data[i].id_tecnologia
        );
        btn_aggiungi_tech.setAttribute("data-id_user", data[i].id_user);
        btn_aggiungi_tech.addEventListener("click", (e) => {
          deleteTable(id);
          console.log(
            e.target.dataset["id_azienda"],
            e.target.dataset["id_tecnologia"],
            e.target.dataset["id_user"]
          );
          fetch(dominio + "/api/azienda2tech/postAzienda2tech.php", {
            method: "POST",
            body: JSON.stringify([
              e.target.dataset["id_azienda"],
              e.target.dataset["id_tecnologia"],
              e.target.dataset["id_user"],
            ]),
          })
            .then((response) => response.json())
            .then((data) => {
              console.log(data);
              //deleteTableAssoc(campi_tech.id_azienda, campi_azienda);
            });
        });
        const td_btn = document.createElement("td");
        td_btn.appendChild(btn_aggiungi_tech);
        tr.appendChild(td_btn);
        t_body.appendChild(tr);
        //console.log(data[i]);
      }
    });

  thead.appendChild(tr);

  table.appendChild(thead);

  table.appendChild(t_body);

  wrap_table.appendChild(table);

  toggle_table = false;

  return wrap_table;
}

function deleteTable(id) {
  document.getElementById("wrap_table_" + id).remove();
  toggle_table = true;
}

createPage(array_aziende);
