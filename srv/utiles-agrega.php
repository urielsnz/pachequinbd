<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaTamaño.php";
require_once __DIR__ . "/../lib/php/validaColor.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_UTILES.php";

ejecutaServicio(function () {

 $nombre = recuperaTexto("nombre");
 $color = recuperaTexto("color");
 $tamaño = recuperaTexto("tamaño");
 $nombre = validaNombre($nombre);
 $color = validaColor( $color);
 $tamaño = validaTamaño($tamaño);


 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: UTILES, values: [PAS_NOMBRE => $nombre, PAS_COLOR => $color, PAS_TAMAÑO => $tamaño]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/utiles.php?id=$encodeId", [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "color" => ["value" => $color],
  "tamaño" => ["value" => $tamaño],
 ]);
});
