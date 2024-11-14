<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaTamaño.php";
require_once __DIR__ . "/../lib/php/validaColor.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_UTILES.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $nombre = recuperaTexto("nombre");
 $color = recuperaTexto("color");
 $tamaño = recuperaTexto("tamaño");
 $nombre = validaNombre($nombre);
 $color = validaColor($color);
 $tamaño = validaTamaño($tamaño);

 

 update(
  pdo: Bd::pdo(),
  table: UTILES,
  set: [PAS_NOMBRE => $nombre, PAS_COLOR => $color, PAS_TAMAÑO => $tamaño],
  where: [PAS_ID => $id]
 );

 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "color" => ["value" => $color],
  "tamaño" => ["value" => $tamaño],
 ]);
});
