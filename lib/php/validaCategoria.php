<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaCategoria(false|string $categoria)
{
    if ($categoria === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta la categoría.",
            type: "/error/faltacategoria.html",
            detail: "La solicitud no tiene el valor de categoría."
        );
    }

    $trimCategoria = trim($categoria);

    if ($trimCategoria === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Categoría en blanco.",
            type: "/error/categoriaenblanco.html",
            detail: "Pon texto en el campo categoría."
        );
    }

    // Validación de longitud mínima
    if (strlen($trimCategoria) <= 2) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Categoría demasiado corta.",
            type: "/error/categoriacorta.html",
            detail: "La categoría debe tener mínimo 3 caracteres."
        );
    }

    return $trimCategoria;
}
