<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaCategoria.php"; // Nueva validación para categoría
require_once __DIR__ . "/../lib/php/validaPrecio.php"; // Nueva validación para precio
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_UTIL.php"; // Archivo con la tabla de útiles escolares

ejecutaServicio(function () {

    $nombre = recuperaTexto("nombre");
    $categoria = recuperaTexto("categoria");
    $precio = recuperaTexto("precio");

    $nombre = validaNombre($nombre);
    $categoria = validaCategoria($categoria); // Validación para categoría
    $precio = validaPrecio($precio); // Validación para precio

    $pdo = Bd::pdo();
    insert(
        pdo: $pdo, 
        into: UTIL, 
        values: [
            UTL_NOMBRE => $nombre, 
            UTL_CATEGORIA => $categoria, 
            UTL_PRECIO => $precio
        ]
    );
    
    $id = $pdo->lastInsertId();
    $encodeId = urlencode($id);

    devuelveCreated("/srv/util.php?id=$encodeId", [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "categoria" => ["value" => $categoria],
        "precio" => ["value" => $precio],
    ]);
});
