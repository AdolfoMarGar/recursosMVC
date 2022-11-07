<?php

// CONTROLADOR DE TimeSlot

//El controlador es igual al de resources solo que varian los datos para que cuadren con la tabla timeSlot
include_once("models/timeSlot.php");
include_once("models/seguridad.php");  
include_once("views/view.php");

class TimeSlotController{
    private $timeSlot;  
    private $reservation; 
    private $esAdmin;     

    public function __construct(){
        $this->timeSlot = new TimeSlot(); 
        $this->reservation = new Reservations(); 
        $this->esAdmin =Seguridad::esAdmin();
    }

    // --------------------------------- MOSTRAR LISTA DE TIMESLOT ----------------------------------------
    public function mostrarListaTimeSlot($data){
        if ($this->esAdmin==1) {
            $data["listaTimeSlot"] = $this->timeSlot->getAll();  
            View::render("timeSlot/all", $data);  
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- FORMULARIO ALTA DE TIMESLOT ----------------------------------------

    public function formularioInsertarTimeSlot(){
        if ($this->esAdmin==1) {
            $data["timeSlot"]=null; 
            View::render("timeSlot/form", $data); 
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
    }

    // --------------------------------- INSERTAR TIMESLOT ----------------------------------------

    public function insertarTimeSlot(){
        if ($this->esAdmin==1) {          
            $dayOfWeek = Seguridad::limpiar($_REQUEST["dayOfWeek"]);
            $startTime = Seguridad::limpiar($_REQUEST["startTime"]);
            $endTime = Seguridad::limpiar($_REQUEST["endTime"]);
            $result = $this->timeSlot->insert($dayOfWeek, $startTime, $endTime); 
            if ($result == 1) {
                $data["info"] = "Tramo horario insertado con éxito.";
            } else {
                $data["error"] = "Error al insertar el tramo horario.";
            }
            $this->mostrarListaTimeSlot($data);   
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- BORRAR TIMESLOT ----------------------------------------

    public function borrarTimeSlot(){
        if ($this->esAdmin==1) {
            $id = Seguridad::limpiar($_REQUEST["idTimeSlot"]);
            $this->reservation ->deleteFromTimeSlot($id);
            $result = $this->timeSlot->delete($id);
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el tramo horario. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Tramo horario borrado con éxito";
            }
            $this->mostrarListaTimeSlot($data);   
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- FORMULARIO MODIFICAR TIMESLOT ----------------------------------------

    public function formularioModificarTimeSlot(){
        if ($this->esAdmin==1) {
            $array = $this->timeSlot->get($_REQUEST["idTimeSlot"]);
            $data["timeSlot"] = $array[0];
            View::render("timeSlot/form", $data);
    
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
    }

    // --------------------------------- MODIFICAR TIMESLOT ----------------------------------------

    public function modificarTimeSlot(){
        if ($this->esAdmin==1) {
            $id = Seguridad::limpiar($_REQUEST["id"]);
            $dayOfWeek = Seguridad::limpiar($_REQUEST["dayOfWeek"]);
            $startTime = Seguridad::limpiar($_REQUEST["startTime"]);
            $endTime = Seguridad::limpiar($_REQUEST["endTime"]);

            // Pedimos al modelo que haga el update
            $result = $this->timeSlot->update($id, $dayOfWeek, $startTime, $endTime);
            if ($result == 1) {
                $data["info"] = "Tramo horario actualizado con éxito";
            } else {
                $data["error"] = "Ha ocurrido un error al modificar el tramo horario. Por favor, inténtelo más tarde";
            }
            $this->mostrarListaTimeSlot($data);   
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }
} // class
