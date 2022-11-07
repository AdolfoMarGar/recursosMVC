<?php
// CONTROLADOR DE RESERVATIONS
include_once("models/reservations.php");  // Modelo de reservation
include_once("models/resources.php");  // Modelo de resources
include_once("models/timeSlot.php");  // Modelo de timeSlot
include_once("models/user.php");  // Modelo de user
include_once("models/seguridad.php");  // Modelo de seguridad
include_once("views/view.php");        // Modelo base de View

class ReservationsController{
    private $reservation;  // Objeto del modelo reservation para utilizar sus metodos
    private $resource;  // Objeto del modelo resource para utilizar sus metodos
    private $user;  // Objeto del modelo user para utilizar sus metodos
    private $timeSlot;  // Objeto del modelo timeSlot para utilizar sus metodos
    private $esAdmin;     //comprueba si el usuario es admin o no


    public function __construct(){
        $this->reservation = new Reservations();  //Inicializamos el objeto reservation
        $this->resource = new Resources();  //Inicializamos el objeto resource
        $this->user = new User();  //Inicializamos el objeto user
        $this->timeSlot = new TimeSlot();  //Inicializamos el objeto timeSlot
        $this->esAdmin =Seguridad::esAdmin();//obtenemos si es admin o no
        
    }
    
    // --------------------------------- MOSTRAR LISTA DE RESERVAS ----------------------------------------
    public function mostrarListaReservations($data){
        $listaResources = array();
        $listaUser = array();
        $listaTimeSlot = array();
        $listaReservations = $this->reservation->getAll();  //Obtenemos un arraya con la totalidad de los elementos en la tabla reservations
        //con este bucle obtenemos a traves de las ids de la tabla reservations sus datos asociados y lo almacenamos en un array
        foreach($listaReservations as $fila){
            $listaResources[]=$this->resource->get($fila->idResource);
            $listaUser[]=$this->user->get($fila->idUser);
            $listaTimeSlot[]=$this->timeSlot->get($fila->idTimeSlot);
        }
        
        //los asignamos a data
        $data["listaResources"] = $listaResources;
        $data["listaReservations"] = $listaReservations;
        $data["listaUser"] = $listaUser;
        $data["listaTimeSlot"] = $listaTimeSlot;

        //y llamamos una view o otra.
        if ($this->esAdmin==1) {
            View::render("reservation/allAdmin", $data);  //Llamamos a la vista reservation/all y le pasamos los datos obtenidos.
        } else {
            View::render("reservation/allUser", $data);  //Llamamos a la vista reservation/all y le pasamos los datos obtenidos.

        }
    }

    // --------------------------------- MOSTRAR LISTA DE RECURSOS ----------------------------------------

    public function selectResources(){
        //Metodo que te muestra los recursos existentes
        // Primero, recuperamos todos los datos del formulario
        $listaResources = array();
        $listaResources = $this->resource->getAll();  //Obtenemos un arraya con la totalidad de los elementos en la tabla recursos
        
        $data["listaResources"] = $listaResources;
        View::render("reservation/selectResource", $data);     
        
    }

    public function selectTimeSlot(){
        // Primero, recuperamos todos los datos del formulario
        $listaTimeSlot = array();
        $listaReservations = $this->reservation->getIdResources($_REQUEST["idResource"]);  
        //Obtenemos un array de la tabla reservas que ya existan con ese recurso
        //para obtener los tramos horarios no utilizados
        if(count($listaReservations)==0){
            //si no hay ninguno se muestran todos los tramos horarios
            $listaTimeSlot = $this->timeSlot->getAll();
        }else{
            foreach($listaReservations as $fila){
                //sino se mostraran los no ocupados
                $listaTimeSlot= $this->timeSlot->getSinOcupados($fila->idTimeSlot);

            }
        }
        //se asignan los datos obtenidos a data y se carga el formulario
        $data["listaTimeSlot"] = $listaTimeSlot;
        View::render("reservation/selectTimeSlot", $data);      
    }

    public function resume(){
        //es una vista que te muestra el resumen de lo seleccionado
        //Recuperamos todos los datos del formulario y lo cargamos
        
        $data["TimeSlot"] = $this->timeSlot->get($_REQUEST["idTimeSlot"]);
        $data["Resource"] = $this->resource->get($_REQUEST["idResource"]);
        View::render("reservation/resume", $data);
    }


    // --------------------------------- INSERTAR RESERVAS ----------------------------------------

    public function insertarReservation(){
        $idResource = Seguridad::limpiar($_REQUEST["idResource"]);
        $idUser = $_SESSION["idUsuario"];
        $idTimeSlot = Seguridad::limpiar($_REQUEST["idTimeSlot"]);
        $date = $_REQUEST["date"];
        if($date==""||$date==null){
            //si no han seleccionado fecha se obtendra la de hoy.
            $date = date('Y/m/d', time());
        } 
        $remark = Seguridad::limpiar($_REQUEST["remark"]);
        $result = $this->reservation->insert($idResource, $idUser, $idTimeSlot, $date, $remark); //Se ejecuta un insert a la db a traves del modelo resources
        if ($result == 1) {
            $data["info"] = "Reserva insertado con éxito.";
        } else {
            $data["error"] = "Error al insertar la reserva.";
        }
        //Segun la respuesta de la db indicamos si se ha realizado el insert correctamente o no.

        //Vovlemos a cargar la vista principal de resources
        $this->mostrarListaReservations($data);
    }

    // --------------------------------- BORRAR RESERVAS ----------------------------------------

    public function borrarReservation(){
        if ($this->esAdmin==1) {
            // Obtenemos el id del recurso a borrar a traves del formulario
            $id = Seguridad::limpiar($_REQUEST["idReservation"]);
            // Pedimos al modelo reservation que intente borrarlo
            $result = $this->reservation->delete($id);
            // Comprobamos si el borrado ha tenido éxito segun la respuesta de la db
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el reserva. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Reserva borrado con éxito";
            }
            //Volvemos a cargar todos los RESERVAS
            $this->mostrarListaReservations($data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }
}