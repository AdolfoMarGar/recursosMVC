<?php
echo'
    <form action="/" method="post">
        <table border="1">
            <tr>
                <td>Actores:</td>
                <td>
                    <button type="submit" name="do" value="viewPersona">Ver actor.</button>
                </td>
                <td>
                    <button type="submit" name="do" value="addPersona1">Añadir actor.</button>
                </td>
                <td>
                    <button type="submit" name="do" value="editPersona">Editar actor.</button>
                </td>
                <td>
                    <button type="submit" name="do" value="deletePersona">Borrar actor.</button>
                </td>
            </tr>
            <tr>
                <td>Peliculas:</td>
                <td>
                    <button type="submit" name="do" value="viewPelicula">Ver pelicula.</button>
                </td>
                <td>
                    <button type="submit" name="do" value="addPelicula" >Añadir pelicula.</button>
                </td>
                <td>
                    <button type="submit" name="do" value="editPelicula" >Editar pelicula.</button>
                </td>
                <td>
                    <button type="submit" name="do" value="deletePelicula">Borrar pelicula.</button>
                </td>
            </tr>
        </table>
    </form>
';