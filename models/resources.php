<?php

// MODELO DE RECURSOS

include_once "model.php";
class Resources extends Model{

    public function __construct(){
        $this->table = "resources";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Devuelve el último id asignado
    public function getMaxId()
    {
        $result = $this->db->dataQuery("SELECT MAX(id) AS ultimoIdResources FROM resources");
        return $result[0]->ultimoIdResources;
    }

    // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($name, $description, $location, $image)
    {
        return $this->db->dataManipulation("INSERT INTO resources (name,description,location,image) VALUES ('$name','$description', '$location', '$image')");
    }


    // Actualiza un libro (todo menos sus autores). Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $name, $description, $location, $image)
    {
        $ok = $this->db->dataManipulation("UPDATE resources SET
                                name = '$name',
                                description = '$description',
                                location = '$location',
                                image = '$image'
                                WHERE id = '$id'");
        return $ok;
    }


    public function uploadImage(){
        $archivo = $_FILES['archivo']['name'];
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
           if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg")|| strpos($tipo, "webp") || strpos($tipo, "png")) && ($tamano < 2000000000))) {
              echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
              - Se permiten archivos .gif, .jpg, .png, .webp y de 200 kb como máximo.</b></div>';
           }
           else {
              //Si la imagen es correcta en tamaño y tipo
              //Se intenta subir al servidor
              if (move_uploaded_file($temp, 'images/'.$archivo)) {
                  //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                  return 'images/'.$archivo;

              }
              else {
                 //Si no se ha podido subir la imagen, mostramos un mensaje de error
                 echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
              }
            }
         }
    }
}