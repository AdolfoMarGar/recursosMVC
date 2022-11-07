<?php

// MODELO DE RESERVAS

include_once "model.php";
class Reservations extends Model{

    public function __construct(){
        $this->table = "reservations";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Devuelve el último id asignado
    public function getMaxId()
    {
        $result = $this->db->selectQuery("SELECT MAX(id) AS ultimoIdReservations FROM reservations");
        return $result[0]->ultimoIdReservations;
    }

    // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($idResource, $idUser, $idTimeSlot, $date, $remark)
    {
        return $this->db->dataManipulation("INSERT INTO reservations (idResource,idUser,idTimeSlot,date,remark) VALUES ('$idResource','$idUser', '$idTimeSlot', '$date', '$remark')");
    }

    //borra segun el id de un recurso
    public function deleteFromResources($id) {
        $result = $this->db->dataManipulation("DELETE FROM ".$this->table." WHERE idResource = $id");
        return $result;
      }

    //Obtiene una reserva segun la id de un recurso existente
    public function getIdResources($id) {
        $sql = 'SELECT * FROM `reservations` WHERE `idResource` = '.$id.';';
        $result = $this->db->selectQuery($sql);
        return $result;
    }

    //borra segun el id de un usuario
    public function deleteFromUser($id) {
    $result = $this->db->dataManipulation("DELETE FROM ".$this->table." WHERE idUser = $id");
    return $result;
    }

    //borra segun el id de un tramo horario
    public function deleteFromTimeSlot($id) {
        $result = $this->db->dataManipulation("DELETE FROM ".$this->table." WHERE idTimeSlot = $id");
        return $result;
    }

}