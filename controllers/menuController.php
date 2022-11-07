<?php
include_once("views/view.php");        // Modelo base de View

//Controlador muy sencillo ya que solo llama a la vista del menu. Podria incluso eliminarse. 
//Pero si hubiese una implementacion de un menu mas complejo podria utilizarse este controlador
class MenuController{
    public function __construct(){}

    public function mostrarStartMenu(){
        View::render("menu/start", null);  //Llamamos a la vista del menu de inicio.

    }
}