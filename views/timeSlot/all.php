<?php
include_once("views/plantilla/nav.php");

// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$listaTimeSlot = $data["listaTimeSlot"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

// Ahora, la tabla con los datos de los libros
if (count($listaTimeSlot) == 0) {
  echo "No hay datos";
} else {
  echo "<table border ='1'>";
  echo "<tr>";
  echo "<td>Dia de la semana</td>";
  echo "<td>Hora inicio</td>";
  echo "<td>Hora fin</td>";
  echo "<td>Acciones</td>";
  echo "<tr>";
  foreach ($listaTimeSlot as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->dayOfWeek . "</td>";
    echo "<td><p>" . $fila->startTime ."</p></td>";
    echo "<td>" . $fila->endTime . "</td>";
    
    
    echo '<td>';

    echo "<form action = '/' method = 'post'>";
    echo "<input type='hidden' name='controller' value='TimeSlotController'>";
    echo "<input type='hidden' name='idTimeSlot' value='".$fila->id."'>";
    echo '<button name="action" value="formularioModificarTimeSlot">Modificar</button>';
    echo "</form>";

    echo "<form action = '/' method = 'post'>";
    echo "<input type='hidden' name='controller' value='TimeSlotController'>";
    echo "<input type='hidden' name='idTimeSlot' value='".$fila->id."'>";
    echo '<button name="action" value="borrarTimeSlot">Borrar</button>';
    echo "</form>";


    echo'</td>';

    echo "</tr>";
  }
  echo "</table>";
}
echo "<form action = '/' method = 'post'>";
echo "<input type='hidden' name='controller' value='TimeSlotController'>";
echo '<button name="action" value="formularioInsertarTimeSlot">Nuevo</button>';

echo "</form>";
