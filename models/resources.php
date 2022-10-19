<?php

// MODELO DE RECURSOS

include_once "model.php";
class Resources extends Model{

    public function __construct(){
        $this->table = "resources";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Devuelve el último id asignado
    public function getMaxId()
    {
        $result = $this->db->dataQuery("SELECT MAX(id) AS ultimoIdResources FROM resources");
        return $result[0]->ultimoIdResources;
    }

    // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($name, $description, $location, $image)
    {
        return $this->db->dataManipulation("INSERT INTO resources (name,description,location,image) VALUES ('$name','$description', '$location', '$image')");
    }


    // Actualiza un libro (todo menos sus autores). Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $name, $description, $location, $image)
    {
        $ok = $this->db->query("UPDATE resources SET
                                name = '$name',
                                description = '$description',
                                location = '$location',
                                image = '$image'
                                WHERE id = '$id'");
        return $ok;
    }
}