<?php
//Falta implementar la capa de seguridad.

// CONTROLADOR DE TimeSlot
include_once("models/timeSlot.php");  // Modelo de TimeSlot
include_once("models/seguridad.php");  // Modelo de seguridad
include_once("views/view.php");        // Modelo base de View

class TimeSlotController{
    private $db;        // Conexión con la base de datos
    private $timeSlot;  // Objeto del modelo TimeSlot para utilizar sus metodos

    public function __construct(){
        $this->timeSlot = new TimeSlot();  //Inicializamos el objeto TimeSlot
    }

    // --------------------------------- MOSTRAR LISTA DE RECURSOS ----------------------------------------
    public function mostrarListaTimeSlot(){
        //if (Seguridad::haySesion()) {
            $data["listaTimeSlot"] = $this->timeSlot->getAll();  //Obtenemos un arraya con la totalidad de los elementos en la tabla recursos
            View::render("timeSlot/all", $data);  //Llamamos a la vista TimeSlot/all y le pasamos los datos obtenidos.
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- FORMULARIO ALTA DE RECURSOS ----------------------------------------

    public function formularioInsertarTimeSlot(){
        //if (Seguridad::haySesion()) {
            $data["timeSlot"]=null; //Le pasamos TimeSlot=null para que no de error al buscar en algo inexistente. Aunque no tenga valores al asignarle null
                                    //se le ha creado el espacio de memoria y nos ahorra problemas
            View::render("timeSlot/form", $data);  //LLamamos a la vista formulario de TimeSlot
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- INSERTAR TIMESLOT ----------------------------------------

    public function insertarTimeSlot(){

       // if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            
            $dayOfWeek = Seguridad::limpiar($_REQUEST["dayOfWeek"]);
            $startTime = Seguridad::limpiar($_REQUEST["startTime"]);
            $endTime = Seguridad::limpiar($_REQUEST["endTime"]);
            $result = $this->timeSlot->insert($dayOfWeek, $startTime, $endTime); //Se ejecuta un insert a la db a traves del modelo TimeSlot
            if ($result == 1) {
                $data["info"] = "Recuros insertado con éxito.";
            } else {
                $data["error"] = "Error al insertar el recurso.";
            }
            //Segun la respuesta de la db indicamos si se ha realizado el insert correctamente o no.

            //Vovlemos a cargar la vista principal de TimeSlot
            $data["listaTimeSlot"] = $this->timeSlot->getAll();
            View::render("timeSlot/all", $data);
            
       /* } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- BORRAR TIMESLOT ----------------------------------------

    public function borrarTimeSlot(){
        //if (Seguridad::haySesion()) {
            // Obtenemos el id del recurso a borrar a traves del formulario
            $id = Seguridad::limpiar($_REQUEST["idTimeSlot"]);
            // Pedimos al modelo timeSlot que intente borrarlo
            $result = $this->timeSlot->delete($id);
            // Comprobamos si el borrado ha tenido éxito segun la respuesta de la db
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el recurso. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Recurso borrado con éxito";
            }
            //Volvemos a cargar todos los recursos
            $data["listaTimeSlot"] = $this->timeSlot->getAll();
            View::render("timeSlot/all", $data);
            /*
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- FORMULARIO MODIFICAR TIMESLOT ----------------------------------------

    public function formularioModificarTimeSlot(){
        //if (Seguridad::haySesion()) {
            // Recuperamos la id del libro a modificar y la asignamos a data
            $array = $this->timeSlot->get($_REQUEST["idTimeSlot"]);
            $data["timeSlot"] = $array[0];
            
            // Renderizamos la vista de inserción de recursos, pero enviándole los datos del recurso ya obtenido en su totalidad.
            // La vista en si se encarga de utilizar los datos pasados para cargar el formulario y trabajar a partir de ahi
            View::render("timeSlot/form", $data);
            /*
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- MODIFICAR TIMESLOT ----------------------------------------

    public function modificarTimeSlot(){

        //if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario

            //Recuperamos los datos del formulario.
            $id = Seguridad::limpiar($_REQUEST["id"]);
            $dayOfWeek = Seguridad::limpiar($_REQUEST["dayOfWeek"]);
            $startTime = Seguridad::limpiar($_REQUEST["startTime"]);
            $endTime = Seguridad::limpiar($_REQUEST["endTime"]);

            // Pedimos al modelo que haga el update
            $result = $this->timeSlot->update($id, $dayOfWeek, $startTime, $endTime);
            if ($result == 1) {
                $data["info"] = "Recurso actualizado con éxito";
            } else {
                $data["error"] = "Ha ocurrido un error al modificar el recurso. Por favor, inténtelo más tarde";
            }
            //Segun la respuesta de la db decimos si se ha realizado correctamente o no
            //Y volvemos a cargar la vista inicial
            $data["listaTimeSlot"] = $this->timeSlot->getAll();
            View::render("timeSlot/all", $data);
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- BUSCAR TIMESLOT ----------------------------------------

  



} // class
