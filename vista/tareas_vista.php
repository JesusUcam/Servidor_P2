<?php

if (isset($_SESSION['email'])) {
    require_once("menu.php");

    ?>
    <h3>Nueva Tarea</h3>

    <div class="container">
        <div id="nuevo">
            <form action="" method="post">
                <label for="fname">Nombre:</label>
                <input type="text" id="fname" name="nombre" placeholder="Nombre..."><br>

                <label for="fdescripcion">Descripcion:</label>
                <input type="text" id="fdescripcion" name="descripcion" placeholder="Descripcion..."><br>

                <label for="">Estado:</label>
                <!-- <input type="text" id="festado" name="estado" placeholder="Estado..."> -->
                <input type="radio" id="festado1" name="estado" value="Activa">
                <label for="estado1"> Activa</label>
                <input type="radio" id="festado2" name="estado" value="Pendiente">
                <label for="estado2"> Pendiente</label>
                <input type="radio" id="festado3" name="estado" value="Finalizada">
                <label for="estado3"> Finalizada</label><br>

                <label for="ffecha_creacion">Fecha de creacion:</label>
                <input type="date" id="ffecha_creacion" name="fecha_creacion" placeholder="Fecha de creacion..."><br>

                <label for="fautor">autor:</label>
                <!-- <input type="text" id="fautor" name="autor" placeholder="Autor..."> -->
                <select name="autor" id="autor">
                    <?php
                    foreach ($array_usuarios2 as $value) {
                        echo "<option value='" . $value['email'] . "'>" . $value['email'] . "</option>";
                    }
                    ?>
                </select>

                <input type="submit" name="insertar" value="Insertar">
            </form>
        </div>

        <div id="contenido"></div>

        <?php


        if (isset($array_usuarios2)) {
            $listaautores = [];
            foreach ($array_usuarios2 as $value) {
                foreach ($value as $k => $value2) {
                    if ($k == "email") {
                        $listaautores[] = $value2;
                    }
                }
            }
            echo "<input type='hidden' id='listaautores' name='autores' value='".implode(", ",$listaautores)."'>";
        }



        if (isset($array_tareas)) {
            $listaautores = [];
            echo "<table border><tr><th>Nombre</th><th>Descripcion</th><th>Estado</th><th>Fecha creacion</th><th>autor</th></tr>";
            foreach ($array_tareas as $value) {
                echo "<tr>";
                foreach ($value as $k => $value2) {
                    echo "<td>$value2</td>";
                    if ($k == "autor") {
                        $listaautores[] = $value2;
                    }
                }

                $nombreTarea = str_replace(" ", "_", $value['nombre']);

                echo "<td><form action='' method='post'>
                <input type='hidden' name='nombre' value='".$value['nombre']."'>
                  <input type='submit' name='borrar' value='Borrar'>
                  </form></td>";
                echo "<td>
                  <input type='hidden' id='nombre".$nombreTarea."' value='" . $value['nombre'] . "'>
                  <input type='hidden' id='descripcion".$nombreTarea."' value='" . $value['descripcion'] . "'>
                  <input type='hidden' id='estado".$nombreTarea."' value='" . $value['estado'] . "'>
                  <input type='hidden' id='fecha_creacion".$nombreTarea."' value='" . $value['fecha_creacion'] . "'>
                  <input type='hidden' id='autor".$nombreTarea."' value='" . $value['estado'] . "'>
                  <input type='submit' name='modificar' value='Modificar' onclick=modificarTarea(`".$nombreTarea."`)></td>";
                echo "</tr>";
            }
            
            echo "<input type='hidden' id='listaautores' name='autores' value='".implode(", ",$listaautores)."'>";
            echo "</table>";
        }
} else {
    ?>
        <div class="container">
            <h3>Inicio de sesión</h3>
            <form action="" method="post">
                <label for="nombre">Email de usuario:</label>
                <input type="text" name="nombre" id="nombre">
                <br><br>
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" id="clave">
                <br><br>
                <input type="submit" id="btn-enviar" value="Enviar">
            </form>
            <?php
}
echo "<p>$error</p>";
?>