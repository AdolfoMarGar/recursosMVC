<?php

include_once("models/menu.php");
include_once("models/seguridad.php");  // Modelo de seguridad
include_once("views/view.php");        // Modelo base de View


class MenuController{
    public function __construct(){

    }

    public function mostrarStartMenu(){
        View::render("menu/start", null);  //Llamamos a la vista resource/all y le pasamos los datos obtenidos.

    }

}


