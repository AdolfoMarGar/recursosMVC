<?php
include_once("views/plantilla/nav.php");

// VISTA PARA INSERCIÓN/EDICIÓN DE resourceS

extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales  ej ($resource)

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $resource: si existe, es porque estamos modificando un resource. Si no, estamos insertando uno nuevo.
if (isset($resource)) {   
    echo "<h1>Modificación de recursos</h1>";
} else {
    echo "<h1>Inserción de recursos</h1>";
}

// Sacamos los datos del resource (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay resource, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $resource->id ?? ""; 
$nameRes = $resource->name ?? "";
$description = $resource->description ?? "";
$location = $resource->location ?? "";
$image = $resource->image ?? null;

// Creamos el formulario con los campos del resource
echo "<form enctype='multipart/form-data' action = '/' method = 'post'>
        <input type='hidden' name='controller' value='ResourcesController'>

        <table border ='1'>
        <input type='hidden' name='id' value='".$id."'>
        <tr>
        <td>Nombre:</td>
        <td><input type='text' name='nameRes' value='".$nameRes."'></td>
        </tr>
        <tr>
        <td>Descripcion:</td>
        <td><input type='text' name='description' value='".$description."'></td>
        </tr>
        <tr>
        <td>Localización:</td>
        <td><input type='text' name='location' value='".$location."'></td>
        </tr>
        <tr>
        <td>Imagen:</td>
        <td>

         ";
        if ($image!=null||$image!="") {
            echo "<input type='hidden' name='image' value='".$image."'>";
            echo"<img src='" . $image . "' width='100' height='100'></br>";
        }
        echo"
        <input type='file' name='archivo'> 
        </td>
        </tr>
        </table>
        <br>";



// Finalizamos el formulario
if (isset($resource)) {
    echo "  <input type='hidden' name='action' value='modificarResource'>";
} else {
    echo "  <input type='hidden' name='action' value='insertarResource'>";
}
echo '<button name="action" value="mostrarListaResources"  >Volver</button>';

echo "	<input type='submit'></form>";

