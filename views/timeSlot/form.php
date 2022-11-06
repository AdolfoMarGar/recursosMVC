<?php
include_once("views/plantilla/nav.php");

// VISTA PARA INSERCIÓN/EDICIÓN DE resourceS

extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales  ej ($resource)

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $resource: si existe, es porque estamos modificando un resource. Si no, estamos insertando uno nuevo.
if (isset($timeSlot)) {   
    echo "<h1>Modificación de tramo horario</h1>";
} else {
    echo "<h1>Inserción de tramo horario</h1>";
}

// Sacamos los datos del resource (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay resource, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $timeSlot->id ?? ""; 
$dayOfWeek = $timeSlot->dayOfWeek ?? "";
$startTime = $timeSlot->startTime ?? "";
$endTime = $timeSlot->endTime ?? "";

// Creamos el formulario con los campos del resource
echo "<form enctype='multipart/form-data' action = '/' method = 'post'>
    <input type='hidden' name='controller' value='TimeSlotController'>

        <input type='hidden' name='id' value='".$id."'>
        <table border ='1'>
        <tr>
        <td>Dia de la semana:</td>
        <td>
        <select name='dayOfWeek'>
        
        <option";
        if($dayOfWeek == 'Lunes'){
            echo(" selected");
        }
        echo " value='Lunes'>Lunes</option>

        <option";
        if($dayOfWeek == 'Martes'){
            echo(" selected");
        }
        echo " value='Martes'>Martes</option>

        <option";
        if($dayOfWeek == 'Miercoles'){
            echo(" selected");
        }
        echo " value='Miercoles'>Miercoles</option>

        <option";
        if($dayOfWeek == 'Jueves'){
            echo(" selected");
        }
        echo " value='Jueves'>Jueves</option>

        <option";
        if($dayOfWeek == 'Viernes'){
            echo(" selected");
        }
        echo " value='Viernes'>Viernes</option>

        
        </select>
        </td>
        </tr>
        <tr>
        <td>Hora inicio:</td>
        <td><input type='time' name='startTime' value='".$startTime."'></td>
        </tr>
        <tr>
        <td>Hora fin:</td>
        <td><input type='time' name='endTime' value='".$endTime."'></td>
        </tr>
       
        </table>
        <br>";



// Finalizamos el formulario
if (isset($timeSlot)) {
    echo "  <input type='hidden' name='action' value='modificarTimeSlot'>";
} else {
    echo "  <input type='hidden' name='action' value='insertarTimeSlot'>";
}
echo '<button name="action" value="mostrarListaTimeSlot"  >Volver</button>';

echo "	<input type='submit'></form>";

