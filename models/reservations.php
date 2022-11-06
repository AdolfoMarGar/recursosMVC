<?php

// MODELO DE RECURSOS

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


    // Actualiza un resource. Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($idResource, $idUser, $idTimeSlot, $date, $remark)
    {
        $ok = $this->db->dataManipulation("UPDATE reservations SET
                                idResource = '$idResource',
                                idUser = '$idUser',
                                idTimeSlot = '$idTimeSlot',
                                date = '$date',
                                remark = '$remark'
                                WHERE idResource = '$idResource'
                                AND idUser = '$idTimeSlot'
                                AND idTimeSlot = '$idTimeSlot'");
        return $ok;
    }


}