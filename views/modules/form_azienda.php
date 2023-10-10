
<form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form" id="form_azienda">

    <div class="wInput">
        <span>Form Azienda</span>
    </div>
  <div class="wInput">
    <input type="text" placeholder="Ragione Sociale" name="ragione_sociale" id="ragione_sociale">
  </div>

  <div class="wInput">
    <input type="text" placeholder="P. iva" name="p_iva">
  </div>

  <div class="wInput">
    <input type="text" placeholder="N. dipendenti" name="n_dipendenti">
  </div>

  <div class="wInput">
    <input type="text" placeholder="N. tel" name="n_tel">
  </div>

  <div class="wInput">
    <input type="text" placeholder="Email" name="email">
  </div>

  <div class="wInput">
    <input type="email" placeholder="Indirizzo" name="indirizzo">
  </div>

  <div class="wInput">
    <input type="text" placeholder="Referente" name="referente">
  </div>

  <div class="wInput">
    <input type="text" placeholder="Ambito" name="ambito">
  </div>

  <div class="wInput">
    <textarea name="note" id="textarea_note" cols="30" rows="5" placeholder="Note" onkeyup="moreWords(this)"></textarea>
  </div>

  <div class="wInput">
    <textarea name="descrizione" id="textarea_descrizione" cols="30" rows="5" placeholder="Descrizione" onkeyup="moreWords(this)"></textarea>
  </div>

  <div class="wInput">
        <input type="submit" value="Inserisci" class="btnSubmit">
    </div>
  
</form>