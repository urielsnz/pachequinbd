<?php

require_once __DIR__ . "/devuelveResultadoNoJson.php";

function devuelveCreated($urlDelNuevo, $resultado)
{

 $json = json_encode($resultado);

 if ($json === false) {

  devuelveResultadoNoJson();
 } else {

  http_response_code(201);
  header("Location: {$urlDelNuevo}");
  header("Content-Type: application/json");
  echo $json;
 }
}
