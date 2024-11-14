<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/recuperaEntero.php";
require_once __DIR__ . "/ProblemDetails.php";

function recuperaIdEntero(string $parametro): int
{

 $id = recuperaEntero($parametro);

 if ($id === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta el id.",
   type: "/error/faltaid.html",
   detail: "La solicitud no tiene el valor de id.",
  );

 if ($id === null)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Id en blanco.",
   type: "/error/idenblanco.html",
  );

 return $id;
}
