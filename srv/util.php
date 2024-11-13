<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_UTIL.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");

 $modelo =
  selectFirst(pdo: Bd::pdo(), from: UTIL, where: [UTL_ID => $id]);

 if ($modelo === false) {
  $idHtml = htmlentities($id);
  throw new ProblemDetails(
   status: NOT_FOUND,
   title: "Útil escolar no encontrado.",
   type: "/error/utilnoencontrado.html",
   detail: "No se encontró ningún útil escolar con el id $idHtml.",
  );
 }

 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $modelo[UTL_NOMBRE]],
  "categoria" => ["value" => $modelo[UTL_CATEGORIA]],
  "precio" => ["value" => $modelo[UTL_PRECIO]],
 ]);
});