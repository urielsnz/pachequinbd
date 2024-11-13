<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaCategoria.php";
require_once __DIR__ . "/../lib/php/validaPrecio.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_UTIL.php";

ejecutaServicio(function () {

    $id = recuperaIdEntero("id");
    $nombre = recuperaTexto("nombre");
    $categoria = recuperaTexto("categoria");
    $precio = recuperaTexto("precio");
    $nombre = validaNombre($nombre);
    $categoria = validaCategoria($categoria);
    $precio = validaPrecio($precio);

    update(
        pdo: Bd::pdo(),
        table: UTIL,
        set: [UTL_NOMBRE => $nombre, UTL_CATEGORIA => $categoria, UTL_PRECIO => $precio],
        where: [UTL_ID => $id]
    );

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "categoria" => ["value" => $categoria],
        "precio" => ["value" => $precio],
    ]);
});
