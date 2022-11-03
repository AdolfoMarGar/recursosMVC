<?php
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
    echo "<td><a href='index.php?action=formularioModificarTimeSlot&idTimeSlot=" . $fila->id . "'>Modificar</a>";
    echo "</br></br><a href='index.php?action=borrarTimeSlot&idTimeSlot=" . $fila->id . "'>Borrar</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}
echo "<form action = '/' method = 'post'>";
echo '<button name="action" value="formularioInsertarTimeSlot">Nuevo</button>';

echo "</form>";
