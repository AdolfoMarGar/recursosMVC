<?php

include_once "db.php";

// MODELO GENÉRICO

class Model {

  protected $table;    // Aquí guardaremos el nombre de la tabla a la que estamos accediendo
  protected $idColumn; // Aquí guardaremos el nombre de la columna que contiene el id 
  protected $db;       // Y aquí la capa de abstracción de datos

  public function __construct()  {
    $this->db = new Db();
  }

  public function getAll() { //obtiene todo de la tabla 
    $list = $this->db->selectQuery("SELECT * FROM ".$this->table);
    return $list;
  }

  public function get($id) { //obtiene el elemento con el que coincida la id
    $record = $this->db->selectQuery("SELECT * FROM ".$this->table." WHERE ".$this->idColumn."= $id");
    return $record;
  } 

  public function delete($id) { //borra un elemento segun la id introducida
    $result = $this->db->dataManipulation("DELETE FROM ".$this->table." WHERE ".$this->idColumn." = $id");
    return $result;
  }
}
