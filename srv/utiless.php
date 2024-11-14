<?php
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_UTILES.PHP";

ejecutaServicio(function () {
    $lista = select(pdo: Bd::pdo(), from: UTILES, orderBy: PAS_NOMBRE);
    
    // Inicia la lista de descripción con un fondo verde claro
    $render = "<dl class='row p-4 rounded shadow-sm' style='background-color: #e8f5e9;'>"; // Verde claro de fondo
    
    foreach ($lista as $modelo) {
        $encodeId = urlencode($modelo[PAS_ID]);
        $id = htmlentities($encodeId);
        $nombre = htmlentities($modelo[PAS_NOMBRE]);
        $color = htmlentities($modelo[PAS_COLOR]);
        $tamaño = htmlentities($modelo[PAS_TAMAÑO]);
        
        $render .= "
            <div class='col-12'>
                <dt class='font-weight-bold' style='color: #388e3c; font-family: Verdana, sans-serif;'>
                    <a href='modifica.html?id=$id' class='text-decoration-none' style='color: #388e3c;'>$nombre</a>
                </dt>
                <dd class='text-muted' style='font-family: Verdana, sans-serif;'>
                    <a href='modifica.html?id=$id' class='text-dark text-decoration-none' style='color: #1b5e20;'>$color, $tamaño</a>
                </dd>
            </div>
            <hr class='col-12 my-3'>";
    }
    
    $render .= "</dl>";
    
    devuelveJson(["tabla" => ["innerHTML" => $render]]);
});
