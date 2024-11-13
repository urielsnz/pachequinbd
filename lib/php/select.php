<?php

require_once __DIR__ . "/fetchAll.php";
require_once __DIR__ . "/calculaSqlDeAsignaciones.php";

function select(
 PDO $pdo,
 string $from,
 array $where = [],
 string $orderBy = "",
 int $mode = PDO::FETCH_ASSOC,
 $opcional = null
) {
 $sql = "SELECT * FROM $from";

 if (sizeof($where) > 0) {
  $sqlDeWhere = calculaSqlDeAsignaciones(" AND ", $where);
  $sql .= " WHERE $sqlDeWhere";
 }

 if ($orderBy !== "") {
  $sql .= " ORDER BY $orderBy";
 }

 if (sizeof($where) === 0) {
  $statement = $pdo->query($sql);
  return fetchAll($statement, [], $mode, $opcional);
 } else {
  $statement = $pdo->prepare($sql);
  $parametros = calculaArregloDeParametros($where);
  return fetchAll($statement, $parametros, $mode, $opcional);
 }
}
