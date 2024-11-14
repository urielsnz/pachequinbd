<?php

function fetch(
 PDOStatement|false $statement,
 $parametros = [],
 int $mode = PDO::FETCH_ASSOC,
 $opcional = null
) {

 if ($statement === false) {

  return false;
 } else {

  if (sizeof($parametros) > 0) {
   $statement->execute($parametros);
  }

  if ($opcional === null) {
   return $statement->fetch($mode);
  } else {
   $statement->setFetchMode($mode, $opcional);
   return $statement->fetch();
  }
 }
}
