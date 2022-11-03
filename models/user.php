<?php

// MODELO DE RECURSOS

include_once "model.php";
class User extends Model{

    public function __construct(){
        $this->table = "users";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Devuelve el último id asignado
    public function getMaxId()
    {
        $result = $this->db->dataQuery("SELECT MAX(id) AS ultimoIdUser FROM user");
        return $result[0]->ultimoIdUser;
    }

    // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($username, $password, $realname, $type)
    {
        return $this->db->dataManipulation("INSERT INTO users (username, password, realname, type) VALUES ('$username', '$password', '$realname', '$type');");
    }


    // Actualiza un resource. Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $username, $password, $realname, $type)
    {
        $ok = $this->db->dataManipulation("
            UPDATE `users`
            SET `username` = '$username',
            `password` = '$password', 
            `realname` = '$realname',
            `type` = '$type' 
            WHERE `user`.`id` = $id; 
            ");
        return $ok;
    }


}