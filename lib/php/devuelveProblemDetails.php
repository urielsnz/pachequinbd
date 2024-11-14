<?php

require_once __DIR__ . "/devuelveResultadoNoJson.php";
require_once __DIR__ . "/ProblemDetails.php";

function devuelveProblemDetails(ProblemDetails $details)
{

 $body = ["title" => $details->title];
 if ($details->type !== null) {
  $body["type"] = $details->type;
 }
 if ($details->detail !== null) {
  $body["detail"] = $details->detail;
 }

 $json = json_encode($body);

 if ($json === false) {

  devuelveResultadoNoJson();
 } else {

  http_response_code($details->status);
  header("Content-Type: application/problem+json");
  echo $json;
 }
}
