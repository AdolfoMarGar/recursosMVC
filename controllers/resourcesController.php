<?php

// CONTROLADOR DE LIBROS
include_once("models/resources.php");  // Modelos
include_once("models/seguridad.php");
include_once("views/view.php");

class ResourcesController{
    private $db;             // Conexión con la base de datos
    private $resource;  // Modelos

    public function __construct(){
        $this->resource = new Resources();
    }

    // --------------------------------- MOSTRAR LISTA DE RECURSOS ----------------------------------------
    public function mostrarListaResources(){
        //if (Seguridad::haySesion()) {
            $data["listaResources"] = $this->resource->getAll();
            View::render("resource/all", $data);
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- FORMULARIO ALTA DE RECURSOS ----------------------------------------

    public function formularioInsertarResources(){
        //if (Seguridad::haySesion()) {
            $data["resource"]=null;
            View::render("resource/form", $data);
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- INSERTAR LIBROS ----------------------------------------

    public function insertarResource(){

       // if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            
            $nameRes = Seguridad::limpiar($_REQUEST["nameRes"]);
            $description = Seguridad::limpiar($_REQUEST["description"]);
            $location = Seguridad::limpiar($_REQUEST["location"]);
            $image = $this->resource->uploadImage();            
            $result = $this->resource->insert($nameRes, $description, $location, $image);
            if ($result == 1) {
                
                $data["info"] = "Recuros insertado con éxito.";
               
            } else {
                // Si la inserción del libro ha fallado, mostramos mensaje de error
                $data["error"] = "Error al insertar el recurso.";
            }
            $data["listaResources"] = $this->resource->getAll();
            View::render("resource/all", $data);
            
       /* } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- BORRAR LIBROS ----------------------------------------

    public function borrarLibro()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el id del libro que hay que borrar
            $idLibro = Seguridad::limpiar($_REQUEST["idLibro"]);
            // Pedimos al modelo que intente borrar el libro
            $result = $this->libro->delete($idLibro);
            // Comprobamos si el borrado ha tenido éxito
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el libro. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Libro borrado con éxito";
            }
            $data["listaLibros"] = $this->libro->getAll();
            View::render("libro/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
    }

    // --------------------------------- FORMULARIO MODIFICAR LIBROS ----------------------------------------

    public function formularioModificarResource()
    {
        //if (Seguridad::haySesion()) {
            // Recuperamos los datos del libro a modificar
            $array = $this->resource->get($_REQUEST["idResource"]);
            $data["resource"] = $array[0];
            
            // Renderizamos la vista de inserción de libros, pero enviándole los datos del libro recuperado.
            // Esa vista necesitará la lista de todos los autores y, además, la lista
            // de los autores de este libro en concreto.
            View::render("resource/form", $data);
            /*
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- MODIFICAR LIBROS ----------------------------------------

    public function modificarResource(){

        //if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
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
                // Si la modificación del libro ha fallado, mostramos mensaje de error
                $data["error"] = "Ha ocurrido un error al modificar el recurso. Por favor, inténtelo más tarde";
            }
            $data["listaResources"] = $this->resource->getAll();
            View::render("resource/all", $data);
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- BUSCAR LIBROS ----------------------------------------

    public function buscarLibros()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos el texto de búsqueda de la variable de formulario
            $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
            // Buscamos los libros que coinciden con la búsqueda
            $data["listaLibros"] = $this->libro->search($textoBusqueda);
            $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
            // Mostramos el resultado en la misma vista que la lista completa de libros
            View::render("libro/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
    }


    // -------- LA APLICACIÓN CONTINUARÍA DESARROLLÁNDOSE AÑADIENDO FUNCIONES AQUÍ ------------------------

} // class
