<?php

function calculaSqlDeCamposDeInsert(array $values)
{
 $primerCampo = true;
 $sqlDeCampos = "";
 foreach ($values as $nombreDeValue => $valorDeValue) {
  $sqlDeCampos .= ($primerCampo === true ? "" : ",") . "$nombreDeValue";
  $primerCampo = false;
 }
 return $sqlDeCampos;
}
