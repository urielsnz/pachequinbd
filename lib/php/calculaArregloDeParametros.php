<?php

function calculaArregloDeParametros(array $arreglo)
{
 $parametros = [];
 foreach ($arreglo as $llave => $valor) {
  $parametros[":$llave"] = $valor;
 }
 return $parametros;
}
