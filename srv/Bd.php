<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

  // self::$pdo->exec("DROP TABLE IF EXISTS PASATIEMPO");
  // self::$pdo->exec("DROP TABLE IF EXISTS UTILES");
  

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS UTILES (
      PAS_ID INTEGER,
      PAS_NOMBRE TEXT NOT NULL,
      PAS_COLOR TEXT NOT NULL,
      PAS_TAMAÑO TEXT NOT NULL,

      CONSTRAINT PAS_PK
       PRIMARY KEY(PAS_ID),

      CONSTRAINT PAS_NOM_UNQ
       UNIQUE(PAS_NOMBRE),

      CONSTRAINT PAS_NOM_NV
       CHECK(LENGTH(PAS_NOMBRE) > 0),
       
      CONSTRAINT PAS_COLOR_NV
       CHECK(LENGTH(PAS_COLOR) > 0),
       
      CONSTRAINT PAS_HAB_NV
       CHECK(LENGTH(PAS_TAMAÑO) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
