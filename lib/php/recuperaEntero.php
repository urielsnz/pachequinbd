<?php

require_once __DIR__ . "/recuperaTexto.php";

/**
 * Devuelve el valor entero de un parámetro recibido en el
 * servidor por medio de GET, POST o cookie.
 * 
 * Si el parámetro no se recibe, devuekve false
 *
 * Si se recibe una cadena vacía, se devuelve null.
 * 
 * Si parámetro no se puede convertir a entero, se genera
 * un error.
 */
function recuperaEntero(string $parametro): false|null|int
{
 $valor = recuperaTexto($parametro);
 if ($valor === false) {
  return false;
 } elseif ($valor === "") {
  return null;
 } else {
  return (int) trim($valor);
 }
}
