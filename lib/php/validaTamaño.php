<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaTamaño(false| string  $tamaño)
{
    if ($tamaño === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el tamaño.",
            type: "/error/faltatamaño.html",
            detail: "La solicitud no tiene el valor de tamaño."
        );
    }

    $trimTamaño = trim($tamaño);

    if ($trimTamaño === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "tamaño en blanco.",
            type: "/error/tamañoenblanco.html",
            detail: "Pon texto en el campo tamaño."
        );
    }

    // Validación de longitud mínima
    if (strlen($trimTamaño) <= 2) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "tamaño demasiado corto.",
            type: "/error/tamañocorto.html",
            detail: "El tamaño debe tener minimo 3 caracteres."
        );
    }

    return $trimTamaño;
}
