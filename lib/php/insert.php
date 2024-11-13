<?php

require_once __DIR__ . "/calculaSqlDeCamposDeInsert.php"; 
require_once __DIR__ . "/calculaSqlDeValues.php"; 
require_once __DIR__ . "/calculaArregloDeParametros.php";

function insert(PDO $pdo, string $into, array $values)
{
 $sqlDeCampos = calculaSqlDeCamposDeInsert($values);
 $sqlDeValues = calculaSqlDeValues($values);
 $sql = "INSERT INTO $into ($sqlDeCampos) VALUES ($sqlDeValues)";
 $parametros = calculaArregloDeParametros($values);
 $pdo->prepare($sql)->execute($parametros);
}
