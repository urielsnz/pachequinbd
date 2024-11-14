<?php

/** Detalle de los errores devueltos por un servicio. */
class ProblemDetails extends Exception
{

 public int $status;
 public string $title;
 public ?string $type;
 public ?string $detail;

 public function __construct(
  int $status,
  string $title,
  ?string $type = null,
  ?string $detail = null,
  Throwable $previous = null
 ) {
  parent::__construct($title, $status, $previous);
  $this->status = $status;
  $this->type = $type;
  $this->title = $title;
  $this->detail = $detail;
 }
}
