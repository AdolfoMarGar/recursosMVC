<?php
  echo "<table><tr>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='MenuController'>";
  echo '<button name="action" value="mostrarStartMenu"><h4>Menu</h4></button>';
  echo "</form>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='ResourcesController'>";
  echo '<button name="action" value="mostrarListaResources"><h4>Recursos</h4></button>';
  echo "</form>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='TimeSlotController'>";
  echo '<button name="action" value="mostrarListaTimeSlot"><h4>Tramos horarios</h4></button>';
  echo "</form>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='UserController'>";
  echo '<button name="action" value="mostrarListaUser"><h4>Usuarios</h4></button>';
  echo "</form>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='UserController'>";
  echo '<button name="action" value="cerrarSesion"><h4>Logout</h4></button>';
  echo "</form>";




  echo "</tr></table>";
  echo "</br>";