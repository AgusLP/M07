<?php

function comprovar_campo($campo) {
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

function comprovar_email($email) {
    $email = comprovar_campo($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = True;
    } else {
        $emailError = False;
    }
    return $emailError;
}

function comprovar_contra($contra) {
    $contra = comprovar_campo($contra);
    if (!preg_match("/[^a-zA-Z\d]/",$contra)) {
        $contraError = True;
    } else {
        $contraError = False;
    }
    return $contraError;
}

function crear_cookie($aceptado) {
    if ($aceptado == "Si") {
        setcookie("aceptado", 1, time() + 365 * 24 * 60 * 60);
        header("Location: UF1-A5-ExerciciPublic.php");
    } else {
        header("Location: https://www.google.es");
    }
}

function cerrar_session() {
    session_unset();
    session_regenerate_id();
    session_destroy();
    header("Location: UF1-A5-ExerciciPublic.php");
}

function iniciar_sesion($user, $password) {
    if (comprovar_email($user) && comprovar_contra($password)) {
        $conn = new mysqli("localhost", "alarrosa", "alarrosa", "alarrosa_Actividad05");
                
        $sql = "SELECT * FROM usuario WHERE User='$user' and Password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $_SESSION["user"] = comprovar_campo($usuario["user"]);
            $_SESSION["password"] = comprovar_campo($usuario["password"]);

            $conn->close();
            if ($usuario["rols"] == 1) {
                header("Location: UF1-A5-ExerciciPrivatAdmin.php");
            } else if ($usuario["rols"] == 2) {
                header("Location: UF1-A5-ExerciciPrivat.php");
            }
        } else {
            echo "<p>Datos incorrectos!</p>";
        }
    } else {
        echo "<p>Has escrito el correo/contraseña incorrectamente!</p>";
    }
}

function registrar_usuario($user, $password, $rols) {
    if (!comprovar_email($user)) {
        echo "<p>No has escrito el correo correctamente!</p>";
    } else if (!comprovar_contra($password)) {
        echo "<p>No has escrito la contraseña correctamente!</p>";
    } else {
        $conn = new mysqli("localhost", "alarrosa", "alarrosa", "alarrosa_Actividad05");
        
        $sql = "SELECT * FROM usuario WHERE user='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO usuario VALUES ('$user','$password','$rols', NULL)";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Usuario registrado con exito!</p>";
            } else {
                echo "Error: ".$sql."<br>".$conn->error;
            }
        } else {
            echo "<p>Ya existe un usuario con ese correo!</p>";
        }
        $conn->close();
    }
}

function modificar_usuario($user, $password, $newuser ,$newpassword) {
    if ($password != $_SESSION["password"]) {
        echo "<p>La contraseña no coincide!</p>";
    } else if (!comprovar_email($newuser)) {
        echo "<p>No has escrito el correo a modificar correctamente!</p>";
    } else if (!comprovar_contra($newpassword)) {
        echo "<p>No has escrito la nueva contraseña correctamente!</p>";
    } else {
        $conn = new mysqli("localhost", "alarrosa", "alarrosa", "alarrosa_Actividad05"");

        $sql = "SELECT user FROM usuario WHERE user='$newuser'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "SELECT * FROM usuario WHERE user='$user'";
            $result = $conn->query($sql);
            $usuario = $result->fetch_assoc();
            $IdUsuario = $usuario["IdUsuario"];

            $sql = "UPDATE usuario SET user='$newuser' WHERE IdUsuario=$IdUsuario";
            $result = $conn->query($sql);
            $sql = "UPDATE usuario SET password='$newpassword' WHERE IdUsuario=$IdUsuario";
            $result = $conn->query($sql);

            $conn->close();

            $_SESSION["user"] = $newuser;
            $_SESSION["password"] = $newpassword;
            echo "Usuario actualizado!";
        } else {
            echo "<p>Ya existe un usuario con ese correo!</p>";
        }
    }
}

function generar_tabla_admin() {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>CORREO</th><th>CONTRASEÑA</th><th>ROL</th></th><th colspan='2'>ACCION</th></tr>";
    $conn = new mysqli("localhost", "alarrosa", "alarrosa", "alarrosa_Actividad05");
    
    $nombres = Array();
    $rols = Array();
    $IdUsuario = Array();

    $sql = "SELECT user, rols, IdUsuario FROM usuario";
    $result = $conn->query($sql);

    while($usuario = $result->fetch_assoc()) {
        $nombres[] = $usuario["user"];
        $rols[] = $usuario["rols"];
        $IdUsuario[] = $usuario["id"];
    }

    for ($n=0; $n < count($nombres); $n++) { 
        echo "<form method='post'>";
        echo "<tr>
            <td><input size='1' type='text' name='id' value='".$id[$n]."' readonly></td>
            <td><input type='text' name='newuser' value='".$nombres[$n]."'></td>
            <td><input type='password' name='newpassword'></td>";

                if ($n == 0) {
                    echo "<td><select name='newrol' disabled><option value='1' selected>Administrador</option><option value='2'>Usuario</option></select></td>";
                    echo "<input type='hidden' name='newrol' value='1' />";
                } else {
                    if ($rols[$n] == 1) {
                        echo "<td><select name='newrol'><option value='1' selected>Administrador</option><option value='2'>Usuario</option></select></td>";
                    } elseif ($rols[$n] == 2) {
                        echo "<td><select name='newrol'><option value='1'>Administrador</option><option value='2' selected>Usuario</option></select></td>";
                    }
                }

                if ($n == 0) {
                    echo "<td colspan='2' style='text-align: center;'><button type='submit' name='modificar' value='si'>Modificar</button></td>";
                } else if ($n != 0) {
                    echo "<td><button type='submit' name='modificar' value='si'>Modificar</button></td>
                        <td><button type='submit' name='borrar' value='si'>Eliminar</button></td>";
                }
        echo "</tr>";
        echo "</form>";
    }
    echo "</table><br>";

    echo "<h3>Crear usuario:</h3>";
    echo "<table border='1'>
            <form method='post'>
                <tr><th>CORREO</th><th>CONTRASEÑA</th><th>ROL</th></th><th>ACCION</th></tr>
                <td><input type='text' name='reguser'></td>
                <td><input type='password' name='regpassword'></td>
                <td><select name='regrol'><option value='1'>Administrador</option><option value='2' selected>Usuario</option></select></td>
                <td><button type='submit' name='crear' value='si'>Crear</button></td>
            </form>
        </table>";
}

function borrar_usuario($user) {
    $conn = new mysqli("localhost", "alarrosa", "alarrosa", "alarrosa_Actividad05");

    $sql = "SELECT IdUsuario FROM usuario WHERE user='$user'";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
    $IdUsuario = $usuario["IdUsuario"];

    $sql = "DELETE FROM usuario WHERE IdUsuario='$id'";
    $result = $conn->query($sql);
    $conn->close();

    echo "Usuario eliminado!";
}

function modificar_usuario_admin($user, $password, $rols, $IdUsuario) {
    if (!comprovar_email($user)) {
        echo "<p>No has escrito el correo a modificar correctamente!</p>";
    } else if (empty($password)) {
        echo "<p>No has escrito la nueva contraseña!</p>";
    } else if (!comprovar_contra($password)) {
        echo "<p>No has escrito la nueva contraseña correctamente!</p>";
    } else {
        $conn = new mysqli("localhost", "alarrosa", "alarrosa", "alarrosa_Actividad05");

        $sql = "SELECT user FROM usuario WHERE user='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "UPDATE usuario SET user='$user' WHERE id=$IdUsuario";
            $result = $conn->query($sql);
            $sql = "UPDATE usuario SET password='$password' WHERE id=$IdUsuario";
            $result = $conn->query($sql);
            $sql = "UPDATE usuario SET rols='$rols' WHERE id=$IdUsuario";
            $result = $conn->query($sql);

            $conn->close();

            echo "Usuario actualizado!";
        } else {
            echo "Ya existe un usuario con ese correo!";
        }
    }
}
?>
