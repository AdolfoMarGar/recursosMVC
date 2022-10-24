<?php

// CONTROLADOR DE LIBROS
include_once("models/resources.php");  // Modelos

include_once("views/view.php");

class ResourcesController{
    private $db;             // Conexión con la base de datos
    private $resource;  // Modelos

    public function __construct(){
        $this->resource = new Resources();
    }

    // --------------------------------- MOSTRAR LISTA DE RECURSOS ----------------------------------------
    public function mostrarListaResources()
    {
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

    public function formularioInsertarResources()
    {
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

    public function insertarLibro()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $titulo = Seguridad::limpiar($_REQUEST["titulo"]);
            $genero = Seguridad::limpiar($_REQUEST["genero"]);
            $pais = Seguridad::limpiar($_REQUEST["pais"]);
            $ano = Seguridad::limpiar($_REQUEST["ano"]);
            $numPaginas = Seguridad::limpiar($_REQUEST["numPaginas"]);
            $autores = Seguridad::limpiar($_REQUEST["autor"]);

            $result = $this->libro->insert($titulo, $genero, $pais, $ano, $numPaginas);
            if ($result == 1) {
                // Si la inserción del libro ha funcionado, continuamos insertando los autores, pero
                // necesitamos conocer el id del libro que acabamos de insertar
                $idLibro = $this->libro->getMaxId();
                // Ya podemos insertar todos los autores junto con el libro en "escriben"
                $result = $this->libro->insertAutores($idLibro, $autores);
                if ($result > 0) {
                    $data["info"] = "Libro insertado con éxito";
                } else {
                    $data["error"] = "Error al insertar los autores del libro";
                }
            } else {
                // Si la inserción del libro ha fallado, mostramos mensaje de error
                $data["error"] = "Error al insertar el libro";
            }
            $data["listaLibros"] = $this->libro->getAll();
            View::render("libro/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
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

    public function formularioModificarLibro()
    {
        if (Seguridad::haySesion()) {
            // Recuperamos los datos del libro a modificar
            $data["libro"] = $this->libro->get(Seguridad::limpiar($_REQUEST["idLibro"])[0]);
            // Renderizamos la vista de inserción de libros, pero enviándole los datos del libro recuperado.
            // Esa vista necesitará la lista de todos los autores y, además, la lista
            // de los autores de este libro en concreto.
            $data["todosLosAutores"] = $this->autor->getAll();
            $data["autoresLibro"] = $this->autor->getAutores(Seguridad::limpiar($_REQUEST["idLibro"]));
            View::render("libro/form", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
    }

    // --------------------------------- MODIFICAR LIBROS ----------------------------------------

    public function modificarLibro()
    {
        if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            $idLibro = Seguridad::limpiar($_REQUEST["idLibro"]);
            $titulo = Seguridad::limpiar($_REQUEST["titulo"]);
            $genero = Seguridad::limpiar($_REQUEST["genero"]);
            $pais = Seguridad::limpiar($_REQUEST["pais"]);
            $ano = Seguridad::limpiar($_REQUEST["ano"]);
            $numPaginas = Seguridad::limpiar($_REQUEST["numPaginas"]);
            $autores = Seguridad::limpiar($_REQUEST["autor"]);

            // Pedimos al modelo que haga el update
            $result = $this->libro->update($idLibro, $titulo, $genero, $pais, $ano, $numPaginas);
            if ($result == 1) {
                $data["info"] = "Libro actualizado con éxito";
            } else {
                // Si la modificación del libro ha fallado, mostramos mensaje de error
                $data["error"] = "Ha ocurrido un error al modificar el libro. Por favor, inténtelo más tarde";
            }
            $data["listaLibros"] = $this->libro->getAll();
            View::render("libro/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
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
