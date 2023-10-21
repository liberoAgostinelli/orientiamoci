"use strict";

import { getAziende, getAziendaUsaTech, getTecnologia } from "./myFunction.js";

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
  //wrap_azienda.appendChild();
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
  const div_tech_assoc = document.createElement("div");
  div_tech_assoc.setAttribute("id", campi_azienda.id_azienda);

  div_tech_assoc.classList.add("div_tech_assoc");
  div_tech_assoc.classList.add("flex");

  for (let i = 0; i < campi_tech_assoc.length; i++) {
    //console.log(campi_tech_assoc[i]);
    div_tech_assoc.appendChild(
      await createDivTech(campi_tech_assoc[i], campi_azienda)
    );
  }

  return div_tech_assoc;
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
    document.getElementById(campi_tech.id_azienda).remove();
    const wrap_azienda = document.getElementById(
      "wrap_azienda_" + campi_tech.id_azienda
    );
    //console.log(wrap_azienda);
    //console.log(createWrappTechAssoc(campi_azienda));
    wrap_azienda.appendChild(await createWrappTechAssoc(campi_azienda));
  });
  div_tech.appendChild(btn_elimina_tech);

  return div_tech;
}

function eliminaTechAssociata(id_azienda, id_tecnologia) {
  fetch(
    "http://localhost:3000/api/azienda2tech/deleteAssoc.php?id_azienda=" +
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

createPage(array_aziende);
