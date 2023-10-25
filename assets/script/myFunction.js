"use strict";

/**
 * Funzione che richiede tutte le tecnologie associate all'azienda dell'id passato
 * come parametro
 *
 */

//export let toggle_table = true;

export async function getAziendaUsaTech(id_azienda) {
  let response = await fetch(
    "http://localhost:3000/api/azienda2tech/getTecnologie.php?id=" + id_azienda
  );
  let data = await response.json();
  return data;
}

export async function getAziende() {
  let response = await fetch(
    "http://localhost:3000/api/azienda/getAziende.php"
  );
  let data = await response.json();
  return data;
}

export async function getTecnologia(id_tecnologia) {
  let response = await fetch(
    "http://localhost:3000/api/tecnologia/getTecnologia.php?id=" + id_tecnologia
  );
  let data = await response.json();
  return data;
}

// export function creaTable(id) {
//   const wrap_table = document.createElement("div");
//   wrap_table.classList.add("wrap_table");
//   wrap_table.setAttribute("id", "wrap_table_" + id);

//   const divX = document.createElement("div");
//   divX.classList.add("x");
//   const spanX = document.createElement("span");
//   spanX.addEventListener("click", (e) => {
//     console.log(e.target);
//     deleteTable(id);
//   });
//   spanX.innerText = "X";
//   spanX.setAttribute("id", "span_table_tech_" + id);
//   divX.appendChild(spanX);

//   wrap_table.appendChild(divX);

//   const table = document.createElement("table");
//   table.classList.add("styled-table");
//   table.setAttribute("id", "table_" + id);

//   const thead = document.createElement("thead");

//   const tr = document.createElement("tr");

//   const t_body = document.createElement("tbody");

//   fetch("http://localhost:3000/api/tecnologia/getTecnologie.php")
//     .then((response) => response.json())
//     .then((data) => {
//       //console.log(data);
//       Object.keys(data[0]).forEach((key) => {
//         const th = document.createElement("th");
//         th.innerText = key;
//         tr.appendChild(th);
//       });
//       tr.appendChild(document.createElement("th"));

//       for (let i = 0; i < data.length; i++) {
//         const tr = document.createElement("tr");
//         Object.keys(data[i]).forEach((key) => {
//           const td = document.createElement("td");
//           td.innerText = data[i][key];
//           tr.appendChild(td);
//         });
//         const btn_aggiungi_tech = document.createElement("button");
//         btn_aggiungi_tech.innerText = "+";
//         btn_aggiungi_tech.classList.add("btn");
//         btn_aggiungi_tech.classList.add("btn_mod");
//         btn_aggiungi_tech.setAttribute("data-id_azienda", id);
//         btn_aggiungi_tech.setAttribute(
//           "data-id_tecnologia",
//           data[i].id_tecnologia
//         );
//         btn_aggiungi_tech.setAttribute("data-id_user", data[i].id_user);
//         btn_aggiungi_tech.addEventListener("click", (e) => {
//           deleteTable(id);
//           console.log(
//             e.target.dataset["id_azienda"],
//             e.target.dataset["id_tecnologia"],
//             e.target.dataset["id_user"]
//           );
//           fetch("http://localhost:3000/api/azienda2tech/postAzienda2tech.php", {
//             method: "POST",
//             body: JSON.stringify([
//               e.target.dataset["id_azienda"],
//               e.target.dataset["id_tecnologia"],
//               e.target.dataset["id_user"],
//             ]),
//           })
//             .then((response) => response.json())
//             .then((data) => console.log(data));
//         });
//         const td_btn = document.createElement("td");
//         td_btn.appendChild(btn_aggiungi_tech);
//         tr.appendChild(td_btn);
//         t_body.appendChild(tr);
//         console.log(data[i]);
//       }
//     });

//   thead.appendChild(tr);

//   table.appendChild(thead);

//   table.appendChild(t_body);

//   wrap_table.appendChild(table);

//   toggle_table = false;

//   return wrap_table;
// }

// export function deleteTable(id) {
//   document.getElementById("wrap_table_" + id).remove();
//   toggle_table = true;
// }
