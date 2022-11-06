<?php
//Falta implementar la capa de seguridad.

// CONTROLADOR DE RESOURCES
include_once("models/reservations.php");  // Modelo de resources
include_once("models/seguridad.php");  // Modelo de seguridad
include_once("views/view.php");        // Modelo base de View

class ReservationsController{
    private $reservation;  // Objeto del modelo reservation para utilizar sus metodos
    private $resource;  // Objeto del modelo reservation para utilizar sus metodos
    private $user;  // Objeto del modelo reservation para utilizar sus metodos
    private $timeSlot;  // Objeto del modelo reservation para utilizar sus metodos
    private $esAdmin;     


    public function __construct(){
        $this->reservation = new Reservations();  //Inicializamos el objeto reservation
        $this->resource = new Resources();  //Inicializamos el objeto reservation
        $this->user = new User();  //Inicializamos el objeto reservation
        $this->timeSlot = new TimeSlot();  //Inicializamos el objeto reservation
        $this->esAdmin =Seguridad::esAdmin();
        
    }
    
    // --------------------------------- MOSTRAR LISTA DE RECURSOS ----------------------------------------
    public function mostrarListaReservations(){
        if ($this->esAdmin==1) {
            $listaResources = array();
            $listaUser = array();
            $listaTimeSlot = array();
            $listaReservations = $this->reservation->getAll();  //Obtenemos un arraya con la totalidad de los elementos en la tabla recursos
            foreach($listaReservations as $fila){
                $listaResources[]=$this->resource->get($fila->idResource);
                $listaUser[]=$this->user->get($fila->idUser);
                $listaTimeSlot[]=$this->timeSlot->get($fila->idTimeSlot);
            }
            
            $data["listaResources"] = $listaResources;
            $data["listaReservations"] = $listaReservations;
            $data["listaUser"] = $listaUser;
            $data["listaTimeSlot"] = $listaTimeSlot;
            View::render("reservation/all", $data);  //Llamamos a la vista reservation/all y le pasamos los datos obtenidos.
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
    }

    // --------------------------------- FORMULARIO ALTA DE RECURSOS ----------------------------------------

    public function formularioInsertarReservations(){
        if ($this->esAdmin==1) {
            $data["reservation"]=null; //Le pasamos reservation=null para que no de error al buscar en algo inexistente. Aunque no tenga valores al asignarle null
                                    //se le ha creado el espacio de memoria y nos ahorra problemas
            View::render("reservation/form", $data);  //LLamamos a la vista formulario de resources
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    public function selectResources(){

        if ($this->esAdmin==1) {
            // Primero, recuperamos todos los datos del formulario
            $listaResources = array();
            $listaResources = $this->resource->getAll();  //Obtenemos un arraya con la totalidad de los elementos en la tabla recursos
            
            $data["listaResources"] = $listaResources;
            View::render("reservation/selectResource", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    public function selectTimeSlot(){

        if ($this->esAdmin==1) {
            // Primero, recuperamos todos los datos del formulario
            $listaTimeSlot = array();
            $listaReservations = $this->reservation->getIdResources($_REQUEST["idResource"]);  //Obtenemos un arraya con la totalidad de los elementos en la tabla recursos

            if(count($listaReservations)==0){
                $listaTimeSlot = $this->timeSlot->getAll();
            }else{
                foreach($listaReservations as $fila){
                    $listaTimeSlot= $this->timeSlot->getSinOcupados($fila->idTimeSlot);

                }

            }
          
            $data["listaTimeSlot"] = $listaTimeSlot;
            View::render("reservation/selectTimeSlot", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    public function resume(){

        if ($this->esAdmin==1) {
            // Primero, recuperamos todos los datos del formulario
            
            $data["TimeSlot"] = $this->timeSlot->get($_REQUEST["idTimeSlot"]);
            $data["Resource"] = $this->resource->get($_REQUEST["idResource"]);
            View::render("reservation/resume", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }


    // --------------------------------- INSERTAR RESOURCE ----------------------------------------

    public function insertarReservation(){

        if ($this->esAdmin==1) {
            // Primero, recuperamos todos los datos del formulario
            
            $idResource = Seguridad::limpiar($_REQUEST["idResource"]);
            $idUser = $_SESSION["idUsuario"];
            $idTimeSlot = Seguridad::limpiar($_REQUEST["idTimeSlot"]);
            $date = $_REQUEST["date"];
            if($date==""||$date==null){
                $date = date('Y/m/d', time());
            } 
            $remark = Seguridad::limpiar($_REQUEST["remark"]);
            $result = $this->reservation->insert($idResource, $idUser, $idTimeSlot, $date, $remark); //Se ejecuta un insert a la db a traves del modelo resources
            if ($result == 1) {
                $data["info"] = "Recuros insertado con éxito.";
            } else {
                $data["error"] = "Error al insertar el recurso.";
            }
            //Segun la respuesta de la db indicamos si se ha realizado el insert correctamente o no.

            //Vovlemos a cargar la vista principal de resources
            $listaResources = array();
            $listaUser = array();
            $listaTimeSlot = array();
            $listaReservations = $this->reservation->getAll();  //Obtenemos un arraya con la totalidad de los elementos en la tabla recursos
            foreach($listaReservations as $fila){
                $listaResources[]=$this->resource->get($fila->idResource);
                $listaUser[]=$this->user->get($fila->idUser);
                $listaTimeSlot[]=$this->timeSlot->get($fila->idTimeSlot);
            }
            
            $data["listaResources"] = $listaResources;
            $data["listaReservations"] = $listaReservations;
            $data["listaUser"] = $listaUser;
            $data["listaTimeSlot"] = $listaTimeSlot;
            View::render("reservation/all", $data);  //Llamamos a la vista reservation/all y le pasamos los datos obtenidos.
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- BORRAR RESOURCE ----------------------------------------

    public function borrarReservation(){
        if ($this->esAdmin==1) {
            // Obtenemos el id del recurso a borrar a traves del formulario
            $id = Seguridad::limpiar($_REQUEST["idReservation"]);
            // Pedimos al modelo reservation que intente borrarlo
            $result = $this->reservation->delete($id);
            // Comprobamos si el borrado ha tenido éxito segun la respuesta de la db
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el recurso. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Recurso borrado con éxito";
            }
            //Volvemos a cargar todos los recursos
            $data["listaReservations"] = $this->reservation->getAll();
            View::render("reservation/all", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- FORMULARIO MODIFICAR RESOURCE ----------------------------------------

    public function formularioModificarReservation(){
        if ($this->esAdmin==1) {
            // Recuperamos la id del libro a modificar y la asignamos a data
            $array = $this->reservation->get($_REQUEST["idReservation"]);
            $data["reservation"] = $array[0];
            
            // Renderizamos la vista de inserción de recursos, pero enviándole los datos del recurso ya obtenido en su totalidad.
            // La vista en si se encarga de utilizar los datos pasados para cargar el formulario y trabajar a partir de ahi
            View::render("reservation/form", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- MODIFICAR RESOURCE ----------------------------------------

    public function modificarReservation(){

        if ($this->esAdmin==1) {
            // Primero, recuperamos todos los datos del formulario

            //Recuperamos los datos del formulario.
            $idReservation = Seguridad::limpiar($_REQUEST["idReservation"]);
            $idUser = Seguridad::limpiar($_REQUEST["idUser"]);
            $idTimeSlot = Seguridad::limpiar($_REQUEST["idTimeSlot"]);
            $date = Seguridad::limpiar($_REQUEST["date"]);
            $remark = Seguridad::limpiar($_REQUEST["remark"]);

            // Pedimos al modelo que haga el update
            $result = $this->reservation->update($idReservation, $idUser, $idTimeSlot, $date, $remark);
            if ($result == 1) {
                $data["info"] = "Recurso actualizado con éxito";
            } else {
                $data["error"] = "Ha ocurrido un error al modificar el recurso. Por favor, inténtelo más tarde";
            }
            //Segun la respuesta de la db decimos si se ha realizado correctamente o no
            //Y volvemos a cargar la vista inicial
            $data["listaReservations"] = $this->reservation->getAll();
            View::render("reservation/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- BUSCAR RESOURCE ----------------------------------------







}