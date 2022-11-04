<?php
session_start();

//include_once "models/seguridad.php";

// Hacemos include de todos los controladores
/*
foreach (glob("controllers/*.php") as $file){
    include $file;
}
*/
echo "Se incluye menucontrolless";

include_once("controllers/menuController.php");
include_once("controllers/resourcesController.php");
include_once("controllers/timeSlotController.php");
include_once("controllers/userController.php");

// Miramos el valor de la variable "controller", si existe. Si no, le asignamos un controlador por defecto
if (isset($_REQUEST["controller"])){
    $controller = $_REQUEST["controller"];
}else{
    $controller = "MenuController";  // Controlador por defecto
}

// Miramos el valor de la variable "action", si existe. Si no, le asignamos una acción por defecto
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "mostrarStartMenu";  // Acción por defecto
}

// Creamos un objeto de tipo $controller y llamamos al método $action()
//$biblio = new $controller();
//$biblio->$action();
