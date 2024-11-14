<?php

require_once __DIR__ . "/ProblemDetails.php";
require_once __DIR__ . "/devuelveProblemDetails.php";
require_once __DIR__ . "/devuelveErrorInterno.php";

function ejecutaServicio(callable $codigo)
{
 try {
  $codigo();
 } catch (ProblemDetails $details) {
  devuelveProblemDetails($details);
 } catch (Throwable $error) {
  devuelveErrorInterno($error);
 }
}
