"use strict";

const localhost = "http://localhost:3000";
const nameDominio = "https://orientiamoci.netsons.org";

export let dominio = localhost;

/**
 * Funzione che richiede tutte le tecnologie associate all'azienda dell'id passato
 * come parametro
 *
 */

export async function getAziendaUsaTech(id_azienda) {
  let response = await fetch(
    dominio + "/api/azienda2tech/getTecnologie.php?id=" + id_azienda
  );
  let data = await response.json();
  return data;
}

export async function getAziende() {
  let response = await fetch(dominio + "/api/azienda/getAziende.php");
  let data = await response.json();
  return data;
}

export async function getTecnologia(id_tecnologia) {
  let response = await fetch(
    dominio + "/api/tecnologia/getTecnologia.php?id=" + id_tecnologia
  );
  let data = await response.json();
  return data;
}
