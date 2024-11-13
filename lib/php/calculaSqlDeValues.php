<?php

function calculaSqlDeValues(array $values)
{
 $primerValue = true;
 $sqlDeValues = "";
 foreach ($values as $nombreDeValue => $valorDeValue) {
  $sqlDeValues .= ($primerValue === true ? "" : ",") . ":$nombreDeValue";
  $primerValue = false;
 }
 return $sqlDeValues;
}
