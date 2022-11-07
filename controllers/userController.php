<?php
// CONTROLADOR DE USER
//El controlador es igual al de resources solo que varian los datos para que cuadren con la tabla user
//Excepto por el control de inicio/fin de sesion el cual se controla desde este controlador
//ya que esta tabla almacena los usuarios y sus datos

include_once("models/user.php");        
include_once("models/seguridad.php");  
include_once("views/view.php");       

class UserController{
    private $user; 
    private $reservation;  
    private $esAdmin;     


    public function __construct(){
        $this->user = new User();  
        $this->reservation = new Reservations(); 
        $this->esAdmin =Seguridad::esAdmin();
    }

    // --------------------------------- MOSTRAR LISTA DE USER ----------------------------------------
    public function mostrarListaUser($data){
        if ($this->esAdmin==1) {
            $data["listaUser"] = $this->user->getAll();  
            View::render("user/all", $data);  
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- FORMULARIO ALTA DE USER ----------------------------------------

    public function formularioInsertarUser(){
        if ($this->esAdmin==1) {
            $data["user"]=null; 
            View::render("user/form", $data); 
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- INSERTAR USER ----------------------------------------

    public function insertarUser(){

        if ($this->esAdmin==1) {
            $username = Seguridad::limpiar($_REQUEST["username"]);
            $password = Seguridad::limpiar($_REQUEST["password"]);
            $realname = Seguridad::limpiar($_REQUEST["realname"]);
            $type = Seguridad::limpiar($_REQUEST["type"]);
            $result = $this->user->insert($username, $password, $realname, $type); 
            if ($result == 1) {
                $data["info"] = "Usuario insertado con éxito.";
            } else {
                $data["error"] = "Error al insertar el usuario.";
            }

            $this->mostrarListaUser($data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
    }

    // --------------------------------- BORRAR USER ----------------------------------------

    public function borrarUser(){
        if ($this->esAdmin==1) {
            $id = Seguridad::limpiar($_REQUEST["idUser"]);
            $this->reservation->deleteFromUser($id);
            $result = $this->user->delete($id);
            if ($result == 0) {
                $data["error"] = "Ha ocurrido un error al borrar el usuario. Por favor, inténtelo de nuevo";
            } else {
                $data["info"] = "Usuario borrado con éxito";
            }
            $this->mostrarListaUser($data);

        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- FORMULARIO MODIFICAR USER ----------------------------------------

    public function formularioModificarUser(){
        if ($this->esAdmin==1) {
            $array = $this->user->get($_REQUEST["idUser"]);
            $data["user"] = $array[0];
            
            View::render("user/form", $data);
            
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- MODIFICAR USER ----------------------------------------

    public function modificarUser(){

        if ($this->esAdmin==1) {
            $id = Seguridad::limpiar($_REQUEST["id"]);
            $username = Seguridad::limpiar($_REQUEST["username"]);
            $password = Seguridad::limpiar($_REQUEST["password"]);
            $realname = Seguridad::limpiar($_REQUEST["realname"]);
            $type = Seguridad::limpiar($_REQUEST["type"]);

            $result = $this->user->update($id, $username, $password, $realname, $type);
            if ($result == 1) {
                $data["info"] = "Usuario actualizado con éxito";
            } else {
                $data["error"] = "Ha ocurrido un error al modificar el usuario. Por favor, inténtelo más tarde";
            }
            $this->mostrarListaUser($data);

        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("menu/start", $data);
        }
        
    }

    // --------------------------------- METODOS LOGIN ----------------------------------------


    // Muestra el formulario de login
    public function formLogin() {
        View::render("user/login");
    }

    // Comprueba los datos de login. Si son correctos, el modelo iniciará la sesión y
    // desde aquí se redirige a otra vista. Si no, nos devuelve al formulario de login.
    public function procesarFormLogin() {
        $username = Seguridad::limpiar($_REQUEST["username"]);
        $passwd = Seguridad::limpiar($_REQUEST["password"]);
        $result = $this->user->login($username, $passwd);
        if ($result) { 
            header("Location: index.php?controller=MenuController&action=mostrarStartMenu");
        } else {
            $data["error"] = "Usuario o contraseña incorrectos";
            View::render("user/login", $data);
        }
    }

    // Cierra la sesión y nos lleva a la vista de login
    public function cerrarSesion() {
        $this->user->cerrarSesion();
        $data["info"] = "Sesión cerrada con éxito";
        View::render("user/login", $data);
    }
 
} // class
