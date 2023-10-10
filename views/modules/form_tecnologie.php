<form action="<?php $_SERVER['PHP_SELF']?>" method="post" name="tecnologie" class="form" id="form_tecnologie">
    <div class="wInput">
        <span>Tecnologie</span>
    </div>
    <div class="wInput">
        <input type="text" name="nome" placeholder="Nome" >
    </div>
    <div class="wInput">
        <input type="text" name="tipo" placeholder="Tipo">
    </div>
    <div class="wInput">
        <textarea name="descrizione" id="descrizione" cols="30" rows="5" placeholder="Descrizione" onkeyup="moreWords(this)"></textarea>
    </div>
    <div class="wInput">
        <input type="submit" value="Inserisci" class="btnSubmit">
    </div>
</form>