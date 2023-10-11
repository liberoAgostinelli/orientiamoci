<?php

function generate_url_token($data) {
  $rand_str = md5($data['nome'] . $data['cognome'] . $data['email']);
  return uniqid() . '_' . $rand_str;
}

function generaStringaRandom($lunghezza, $data) {
  $caratteri = generate_url_token($data);
  $stringaRandom = '';
  for ($i = 0; $i < $lunghezza; $i++) {
      $stringaRandom .= $caratteri[rand(0, strlen($caratteri) - 1)];
  }
  return $stringaRandom;
}

?>