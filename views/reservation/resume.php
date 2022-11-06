<?php
include_once("views/plantilla/nav.php");
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$resource = $data["Resource"];
$timeSlot = $data["TimeSlot"];

echo "<table border ='1'>";
echo "<tr>";
echo "<td>Nombre</td>";
echo "<td>Descripcion</td>";
echo "<td>Localización</td>";
echo "<td>Imagen</td>";
echo "<tr>";
echo "<tr>";
echo "<td>" . $resource[0]->name . "</td>";
echo "<td><p>" . $resource[0]->description ."</p></td>";
echo "<td>" . $resource[0]->location . "</td>";
echo "<td><img src='" . $resource[0]->image . "' width='100' height='100'></td>";
echo "</tr>";
echo "</table>";

echo "</br></br>";

echo "<table border ='1'>";
echo "<tr>";
echo "<td>Dia de la semana</td>";
echo "<td>Hora inicio</td>";
echo "<td>Hora fin</td>";
echo "<td>Fecha</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . $timeSlot[0]->dayOfWeek . "</td>";
echo "<td><p>" . $timeSlot[0]->startTime ."</p></td>";
echo "<td>" . $timeSlot[0]->endTime . "</td>";
echo "<td>" . $_REQUEST["date"] . "</td>";
echo "</tr>";
echo "</table>";

echo "</br></br>";

echo "<form action = '/' method = 'post'>";
echo "<input type='hidden' name='controller' value='ReservationsController'>";
echo "<input type='hidden' name='idResource' value='".$resource[0]->id."'>";
echo "<input type='hidden' name='date' value='".$_REQUEST["date"]."'>";
echo "<input type='hidden' name='idTimeSlot' value='".$timeSlot[0]->id."'>";
echo 'Comentario:<input type="text"  name="remark" maxlength="1000" size="50" value=""></br>';
echo '<button name="action" value="mostrarListaReservations">Inicio</button>';
echo '<button name="action" value="insertarReservation">Confirmar</button>';
echo "</form>";

echo "<form action = '/' method = 'post'>";
echo "<input type='hidden' name='controller' value='ReservationsController'>";
echo "<input type='hidden' name='idResource' value='".$resource[0]->id."'>";
echo '<button name="action" value="selectTimeSlot">Volver</button>';
echo "</form>";
