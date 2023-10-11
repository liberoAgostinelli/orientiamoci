const id = document.getElementById("textarea_note");

/* Funzione che ingrandisce la textarea al superamento della lunghezza*/
function moreWords(id, maxHeight) {
  // creo una variabile per l'accesso alle proprietà di stile della textarea
  var txtarea = id && id.style ? id : document.getElementById(id);

  // se non riesco esco senza fa nulla
  if (!txtarea) return;

  // creo una variabile in cui salvo inizialmente l'altezza attuale della textarea
  var newHeight = txtarea.clientHeight;

  // se l'altezza massima non è stata impostata o questa è maggiore dell'altezza attuale...
  if (!maxHeight || maxHeight > newHeight) {
    // ridefinisco il valore di newHeight individuando il maggiore tra l'altezza dei contenuti (scrollHeight) ed il suo valore attuale
    newHeight = Math.max(txtarea.scrollHeight, newHeight);

    // se l'altezza massima è stata impostata..
    if (maxHeight)
      // ridefinisco il valore di newHeight individuando il valore minore tra l'altezza massima (maxHeight) ed il suo valore attuale
      newHeight = Math.min(maxHeight, newHeight);

    // se l'altezza calcolata (newHeight) è maggiore di quella attuale della textarea
    // effettuo la modifica ed allungo la textarea
    if (newHeight > txtarea.clientHeight) {
      txtarea.style.height = newHeight + "px";
      txtarea.style.overflow = "hidden";
    }
  }
  // se l'altezza massima è stata raggiunta mostro la barra di scorrimento
  else if (maxHeight && maxHeight <= newHeight) {
    txtarea.style.overflow = "auto";
  }
}
/**
 * Funzione che ritorna l'id dell'utente loggato per identificare chi inserisce il record
 * @returns id_user
 */
async function getIdUserLoggato() {
  let response = await fetch("http://localhost:3000/api/getIdUserloggato.php");
  let data = await response.json();
  //console.log("id.." + data.id_user);
  return data.id_user;
}

export default getIdUserLoggato;
