<?php
//Falta implementar la capa de seguridad.

// CONTROLADOR DE User
include_once("models/user.php");        // Modelo de User
include_once("models/seguridad.php");   // Modelo de seguridad
include_once("views/view.php");         // Modelo base de View

class UserController{
    private $db;        // Conexión con la base de datos
    private $user;  // Objeto del modelo User para utilizar sus metodos

    public function __construct(){
        $this->user = new User();  //Inicializamos el objeto User
    }

    // --------------------------------- MOSTRAR LISTA DE RECURSOS ----------------------------------------
    public function mostrarListaUser(){
        //if (Seguridad::haySesion()) {
            $data["listaUser"] = $this->user->getAll();  //Obtenemos un arraya con la totalidad de los elementos en la tabla recursos
            View::render("user/all", $data);  //Llamamos a la vista User/all y le pasamos los datos obtenidos.
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- FORMULARIO ALTA DE RECURSOS ----------------------------------------

    public function formularioInsertarUser(){
        //if (Seguridad::haySesion()) {
            $data["user"]=null; //Le pasamos User=null para que no de error al buscar en algo inexistente. Aunque no tenga valores al asignarle null
                                    //se le ha creado el espacio de memoria y nos ahorra problemas
            View::render("user/form", $data);  //LLamamos a la vista formulario de User
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- INSERTAR USER ----------------------------------------

    public function insertarUser(){

       // if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario
            
            $username = Seguridad::limpiar($_REQUEST["username"]);
            $password = Seguridad::limpiar($_REQUEST["password"]);
            $realname = Seguridad::limpiar($_REQUEST["realname"]);
            $type = Seguridad::limpiar($_REQUEST["type"]);
            $result = $this->user->insert($username, $password, $realname, $type); //Se ejecuta un insert a la db a traves del modelo User
            if ($result == 1) {
                $data["info"] = "Recuros insertado con éxito.";
            } else {
                $data["error"] = "Error al insertar el recurso.";
            }
            //Segun la respuesta de la db indicamos si se ha realizado el insert correctamente o no.

            //Vovlemos a cargar la vista principal de User
            $data["listaUser"] = $this->user->getAll();
            View::render("user/all", $data);
            
       /* } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- BORRAR USER ----------------------------------------

    public function borrarUser(){
        //if (Seguridad::haySesion()) {
            // Obtenemos el id del recurso a borrar a traves del formulario
            $id = Seguridad::limpiar($_REQUEST["idUser"]);
            // Pedimos al modelo user que intente borrarlo
            $result = $this->user->delete($id);
            // Comprobamos si el borrado ha tenido éxito segun la respuesta de la db
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el recurso. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Recurso borrado con éxito";
            }
            //Volvemos a cargar todos los recursos
            $data["listaUser"] = $this->user->getAll();
            View::render("user/all", $data);
            /*
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- FORMULARIO MODIFICAR USER ----------------------------------------

    public function formularioModificarUser(){
        //if (Seguridad::haySesion()) {
            // Recuperamos la id del libro a modificar y la asignamos a data
            $array = $this->user->get($_REQUEST["idUser"]);
            $data["user"] = $array[0];
            
            // Renderizamos la vista de inserción de recursos, pero enviándole los datos del recurso ya obtenido en su totalidad.
            // La vista en si se encarga de utilizar los datos pasados para cargar el formulario y trabajar a partir de ahi
            View::render("user/form", $data);
            /*
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- MODIFICAR USER ----------------------------------------

    public function modificarUser(){

        //if (Seguridad::haySesion()) {
            // Primero, recuperamos todos los datos del formulario

            //Recuperamos los datos del formulario.
            $id = Seguridad::limpiar($_REQUEST["id"]);
            $username = Seguridad::limpiar($_REQUEST["username"]);
            $password = Seguridad::limpiar($_REQUEST["password"]);
            $realname = Seguridad::limpiar($_REQUEST["realname"]);
            $type = Seguridad::limpiar($_REQUEST["type"]);

            // Pedimos al modelo que haga el update
            $result = $this->user->update($id, $username, $password, $realname, $type);
            if ($result == 1) {
                $data["info"] = "Recurso actualizado con éxito";
            } else {
                $data["error"] = "Ha ocurrido un error al modificar el recurso. Por favor, inténtelo más tarde";
            }
            //Segun la respuesta de la db decimos si se ha realizado correctamente o no
            //Y volvemos a cargar la vista inicial
            $data["listaUser"] = $this->user->getAll();
            View::render("user/all", $data);
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }
        */
    }

    // --------------------------------- BUSCAR USER ----------------------------------------




} // class
