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

  // self::$pdo->exec("DROP TABLE IF EXISTS UTIL");

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS UTIL (
      UTL_ID INTEGER,
      UTL_NOMBRE TEXT NOT NULL,
      UTL_CATEGORIA TEXT NOT NULL,
      UTL_PRECIO REAL NOT NULL,

      CONSTRAINT UTL_PK
       PRIMARY KEY(UTL_ID),

      CONSTRAINT UTL_NOM_UNQ
       UNIQUE(UTL_NOMBRE),

      CONSTRAINT UTL_NOM_NV
       CHECK(LENGTH(UTL_NOMBRE) > 0),
       
      CONSTRAINT UTL_CAT_NV
       CHECK(LENGTH(UTL_CATEGORIA) > 0),
       
      CONSTRAINT UTL_PRECIO_NV
       CHECK(UTL_PRECIO > 0)
     )"
   );
  }

  return self::$pdo;
 }
}