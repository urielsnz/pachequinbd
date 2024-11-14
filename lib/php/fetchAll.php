<?php

function fetchAll(
 PDOStatement|false $statement,
 $parametros = [],
 int $mode = PDO::FETCH_ASSOC,
 $opcional = null
): array {

 if ($statement === false) {

  return [];
 } else {

  if (sizeof($parametros) > 0) {
   $statement->execute($parametros);
  }

  $resultado = $opcional === null
   ? $statement->fetchAll($mode)
   : $statement->fetchAll($mode, $opcional);

  if ($resultado === false) {
   return [];
  } else {
   return $resultado;
  }
 }
}
