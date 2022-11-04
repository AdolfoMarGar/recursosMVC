<?php

// MODELO DE RECURSOS

include_once "model.php";
class TimeSlot extends Model{

    public function __construct(){
        $this->table = "timeSlot";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Devuelve el último id asignado
    public function getMaxId()
    {
        $result = $this->db->selectQuery("SELECT MAX(id) AS ultimoIdTimeSlot FROM timeSlot");
        return $result[0]->ultimoIdTimeSlot;
    }

    // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($dayOfWeek, $startTime, $endTime)
    {
        return $this->db->dataManipulation("INSERT INTO timeSlot (dayOfWeek, startTime, endTime) VALUES ('$dayOfWeek', '$startTime', '$endTime');");
    }


    // Actualiza un resource. Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $dayOfWeek, $startTime, $endTime)
    {
        $ok = $this->db->dataManipulation("
            UPDATE `timeSlot`
            SET `dayOfWeek` = '$dayOfWeek',
            `startTime` = '$startTime', 
            `endTime` = '$endTime' 
            WHERE `timeSlot`.`id` = $id; 
            ");
        return $ok;
    }


}