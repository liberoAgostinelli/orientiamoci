<?php

  function createTable($arr){
    $str = "<table class='styled-table'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Descrizione</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>";
    for($i = 0; $i< count($arr); $i++){
      if($i % 2 == 0){
        $str .= "<tr>
                <td>{$arr[$i]['id_tecnologia']}</td>
                <td>{$arr[$i]['nome']}</td>
                <td>{$arr[$i]['tipo']}</td>
                <td>{$arr[$i]['descrizione']}</td>
                <td><a id='btnMod$i' class='btn btn_mod' href='$_SERVER[PHP_SELF]?id={$arr[$i]['id_tecnologia']}&btn=mod'>Modifica</a></td>
                <td><a id='btnCanc$i' class='btn btn_canc' href='$_SERVER[PHP_SELF]?id={$arr[$i]['id_tecnologia']}&btn=canc'>Cancella</a></td>
              </tr>";
      }else{
        $str .= "<tr class='active-row'>
        <td>{$arr[$i]['id_tecnologia']}</td>
        <td>{$arr[$i]['nome']}</td>
        <td>{$arr[$i]['tipo']}</td>
        <td>{$arr[$i]['descrizione']}</td>
        <td><a id='btnMod$i' class='btn btn_mod' href='$_SERVER[PHP_SELF]?id={$arr[$i]['id_tecnologia']}&btn=mod'>Modifica</a></td>
        <td><a id='btnCanc$i' class='btn btn_canc' href='$_SERVER[PHP_SELF]?id={$arr[$i]['id_tecnologia']}&btn=canc'>Cancella</a></td>
        </tr>";
      }
      
    }
    $str .= "</tbody>
    </table>";
    return $str;
  }

  function getFormTech($id = null){
    if($id === null){
      $str = "<form action='$_SERVER[PHP_SELF]' method='post' name='tecnologie' class='form' id='form_tecnologie'>
      <div class='x'><span id='x'><a href='$_SERVER[PHP_SELF]?reset=true'>X</a></span></div>
      <div class='wInput'>
          <span>Tecnologie</span>
      </div>
      <div class='wInput'>
          <input type='text' name='nome' placeholder='Nome' >
      </div>
      <div class='wInput'>
          <input type='text' name='tipo' placeholder='Tipo'>
      </div>
      <div class='wInput'>
          <textarea name='descrizione' id='descrizione' cols='30' rows='5' placeholder='Descrizione' onkeyup='moreWords(this)'></textarea>
      </div>
      <div class='wInput'>
          <input type='submit' value='Inserisci' class='btnSubmit'>
      </div>
  </form>";
    return $str;
    }else{
      $str = "<form action='$_SERVER[PHP_SELF]?id=$id' method='post' name='tecnologie' class='form' id='form_tecnologie'>
      <div class='x'><span id='x'><a href='$_SERVER[PHP_SELF]?reset=true'>X</a></span></div>
      <div class='wInput'>
          <span>Tecnologie ID $id</span>
      </div>
      <div class='wInput'>
          <input type='text' name='nome' placeholder='Nome' >
      </div>
      <div class='wInput'>
          <input type='text' name='tipo' placeholder='Tipo'>
      </div>
      <div class='wInput'>
          <textarea name='descrizione' id='descrizione' cols='30' rows='5' placeholder='Descrizione' onkeyup='moreWords(this)'></textarea>
      </div>
      <div class='wInput'>
          <input type='submit' value='Inserisci' class='btnSubmit'>
      </div>
  </form>";
  return $str;
    }
    
  }

?>