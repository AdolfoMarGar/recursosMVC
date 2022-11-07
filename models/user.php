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
        $result = $this->db->selectQuery("SELECT MAX(id) AS ultimoIdUser FROM user");
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
            WHERE `users`.`id` = $id; 
            ");
        return $ok;
    }

    //comprueba el usuario y la contraseña introducidas en el login 
    public function login($username, $password) {
        $array = $this->db->selectQuery("SELECT * FROM users WHERE username='$username' AND password='$password'");
        if (count($array) == 1) {
            Seguridad::iniciarSesion($array[0]->id,$array[0]->type);
            
            return true;
        } else {
            return false;
        }
    }

    // Cierra una sesión (destruye variables de sesión)
    public function cerrarSesion() {
        Seguridad::cerrarSesion();
    }

}