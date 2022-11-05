<?php

echo "<h1> SISTEMA GESTOR DE RECURSOS </h1>";
if (isset($data["error"])) {
    echo "<div style='color:red'>".$data["error"]."</div>";
  }
  echo "<div><h2>";
if(Seguridad::esAdmin()==1){
  echo "<a href='index.php?action=mostrarListaResources&controller=ResourcesController'>Recursos</a></br></br>";
  echo "<a href='index.php?action=mostrarListaTimeSlot&controller=TimeSlotController'>Tramos horarios</a></br></br>";
  echo "<a href='index.php?action=mostrarListaUser&controller=UserController'>Usuarios</a></br></br>";
}
echo "<a href='index.php?action=mostrarListaUser&controller=UserController'>Reservas</a></br></br>";
echo "<a href='index.php?action=cerrarSesion&controller=UserController'>LogOut</a></br></br><h2></div>";





 