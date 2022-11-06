<?php
//Falta implementar la capa de seguridad.

// CONTROLADOR DE RESOURCES
include_once("models/resources.php");  // Modelo de resources
include_once("models/seguridad.php");  // Modelo de seguridad
include_once("views/view.php");        // Modelo base de View

class ResourcesController{
    private $resource;  // Objeto del modelo resource para utilizar sus metodos
    private $reservation;  // Objeto del modelo resource para utilizar sus metodos
    private $esAdmin;     


    public function __construct(){
        $this->resource = new Resources();  //Inicializamos el objeto resource
        $this->reservation = new Reservations();  //Inicializamos el objeto resource
        $this->esAdmin =Seguridad::esAdmin();
    }

    // --------------------------------- MOSTRAR LISTA DE RECURSOS ----------------------------------------
    public function mostrarListaResources(){
        if ($this->esAdmin==1) {
            $data["listaResources"] = $this->resource->getAll();  //Obtenemos un arraya con la totalidad de los elementos en la tabla recursos
            View::render("resource/all", $data);  //Llamamos a la vista resource/all y le pasamos los datos obtenidos.
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- FORMULARIO ALTA DE RECURSOS ----------------------------------------

    public function formularioInsertarResources(){
        if ($this->esAdmin==1) {
            $data["resource"]=null; //Le pasamos resource=null para que no de error al buscar en algo inexistente. Aunque no tenga valores al asignarle null
                                    //se le ha creado el espacio de memoria y nos ahorra problemas
            View::render("resource/form", $data);  //LLamamos a la vista formulario de resources
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- INSERTAR RESOURCE ----------------------------------------

    public function insertarResource(){

        if ($this->esAdmin==1) {
            // Primero, recuperamos todos los datos del formulario
            
            $nameRes = Seguridad::limpiar($_REQUEST["nameRes"]);
            $description = Seguridad::limpiar($_REQUEST["description"]);
            $location = Seguridad::limpiar($_REQUEST["location"]);
            $image = $this->resource->uploadImage() ?? "";       //Se le asigna "" si no se sube ninguna imagen.      
            $result = $this->resource->insert($nameRes, $description, $location, $image); //Se ejecuta un insert a la db a traves del modelo resources
            if ($result == 1) {
                $data["info"] = "Recuros insertado con éxito.";
            } else {
                $data["error"] = "Error al insertar el recurso.";
            }
            //Segun la respuesta de la db indicamos si se ha realizado el insert correctamente o no.

            //Vovlemos a cargar la vista principal de resources
            $data["listaResources"] = $this->resource->getAll();
            View::render("resource/all", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- BORRAR RESOURCE ----------------------------------------

    public function borrarResource(){
        if ($this->esAdmin==1) {
            // Obtenemos el id del recurso a borrar a traves del formulario
            $id = Seguridad::limpiar($_REQUEST["idResource"]);
            // Pedimos al modelo resource que intente borrarlo
            $result = $this->resource->delete($id);
            $result = $this->reservation->deleteFromResources($id);            
            // Comprobamos si el borrado ha tenido éxito segun la respuesta de la db
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el recurso. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Recurso borrado con éxito";
            }
            //Volvemos a cargar todos los recursos
            $data["listaResources"] = $this->resource->getAll();
            View::render("resource/all", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- FORMULARIO MODIFICAR RESOURCE ----------------------------------------

    public function formularioModificarResource(){
        if ($this->esAdmin==1) {
            // Recuperamos la id del libro a modificar y la asignamos a data
            $array = $this->resource->get($_REQUEST["idResource"]);
            $data["resource"] = $array[0];
            
            // Renderizamos la vista de inserción de recursos, pero enviándole los datos del recurso ya obtenido en su totalidad.
            // La vista en si se encarga de utilizar los datos pasados para cargar el formulario y trabajar a partir de ahi
            View::render("resource/form", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- MODIFICAR RESOURCE ----------------------------------------

    public function modificarResource(){

        if ($this->esAdmin==1) {
            // Primero, recuperamos todos los datos del formulario

            //Recuperamos los datos del formulario.
            $id = Seguridad::limpiar($_REQUEST["id"]);
            $nameRes = Seguridad::limpiar($_REQUEST["nameRes"]);
            $description = Seguridad::limpiar($_REQUEST["description"]);
            $location = Seguridad::limpiar($_REQUEST["location"]);
            $image = $this->resource->uploadImage() ?? $_REQUEST["image"];

            // Pedimos al modelo que haga el update
            $result = $this->resource->update($id, $nameRes, $description, $location, $image);
            if ($result == 1) {
                $data["info"] = "Recurso actualizado con éxito";
            } else {
                $data["error"] = "Ha ocurrido un error al modificar el recurso. Por favor, inténtelo más tarde";
            }
            //Segun la respuesta de la db decimos si se ha realizado correctamente o no
            //Y volvemos a cargar la vista inicial
            $data["listaResources"] = $this->resource->getAll();
            View::render("resource/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- BUSCAR RESOURCE ----------------------------------------




} // class
