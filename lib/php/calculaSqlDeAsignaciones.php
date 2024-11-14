<?php

function calculaSqlDeAsignaciones(string $separador, array $arreglo)
{
 $primerElemento = true;
 $sqlDeAsignacion = "";
 foreach ($arreglo as $llave => $valor) {
  $sqlDeAsignacion .=
   ($primerElemento === true ? "" : $separador) . "$llave=:$llave";
  $primerElemento = false;
 }
 return $sqlDeAsignacion;
}
