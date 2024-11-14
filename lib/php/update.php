<?php

require_once __DIR__ . "/calculaArregloDeParametros.php";
require_once __DIR__ . "/calculaSqlDeAsignaciones.php";


function update(PDO $pdo, string $table, array $set, array $where)
{
 $sqlDeSet = calculaSqlDeAsignaciones(",", $set);
 $sqlDeWhere = calculaSqlDeAsignaciones(" AND ", $where);
 $sql = "UPDATE $table SET $sqlDeSet WHERE $sqlDeWhere";

 $parametros = calculaArregloDeParametros($set);
 foreach ($where as $nombreDeWhere => $valorDeWhere) {
  $parametros[":$nombreDeWhere"] = $valorDeWhere;
 }
 $statement = $pdo->prepare($sql);
 $statement->execute($parametros);
}
