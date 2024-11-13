<?php
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_UTIL.php";

ejecutaServicio(function () {
    $list = select(
        pdo: Bd::pdo(),
        from: UTIL,
        orderBy: UTL_NOMBRE
    );

    $modelos = [];
    foreach ($list as $modelo) {
        $modelos[] = [
            "id" => $modelo[UTL_ID],
            "nombre" => $modelo[UTL_NOMBRE],
            "categoria" => $modelo[UTL_CATEGORIA],
            "precio" => $modelo[UTL_PRECIO]
        ];
    }

    devuelveJson($modelos);
});