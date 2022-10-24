<?php 
    class View {
        public static function render( $nombreVista, $data = null){
            include("./views/plantilla/head.php");
            include("./views/$nombreVista.php");
            include("./views/plantilla/end.php");
        }
    }