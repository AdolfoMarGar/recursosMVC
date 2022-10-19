<?php 
    class View {
        public static function render($carpeta, $nombreVista, $datos = null){
            include("./views/plantilla/head.php");
            include("./views/$carpeta/$nombreVista");
            include("./views/plantilla/end.php");
        }
    }