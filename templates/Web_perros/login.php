<?php
session_start();
// Conexión a la base de datos
$conn = new mysqli("debianaday", "root", "", "perros_hijas");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Styles_Admin.css">
</head>
<body>

<div class="div_h1">
    <h1>Login</h1>
</div>

<?php
$txt = "";
$error = "";

// Si el número de errores es menor a 5, mostramos el formulario
if (!isset($_SESSION["id_user"]) && $_SESSION["error_count"] < 5) {

    if (isset($_POST["passwd"]) && isset($_POST["Usuario"])) {

        

        // Usar consultas preparadas para evitar inyección SQL
        $stmt = $conn->prepare("SELECT id_admin, usuario, contraseña FROM acceso_admin where usuario=?;");
        $stmt->bind_param("s", $_POST["Usuario"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $r = $result->fetch_assoc();
        $stmt->close();

        if ($r) {
            // Verifica la contraseña
            if (md5($_POST["passwd"]) === $r["contraseña"]) {
                $_SESSION["id_user"] = $r["id_admin"];
                $_SESSION["rol"] = $r["rol"];  // Guardamos el rol del usuario en la sesión
                $_SESSION["error_count"] = 0;  // Resetea el contador de errores al hacer login exitoso
            } else {
                $error .= "<div class='error'>Contraseña incorrecta</div>";
                $_SESSION["error_count"]++;  // Incrementa el contador de errores
            }
        } else {
            

            $error .= "<div class='error'>Usuario incorrecto</div>";
            $_SESSION["error_count"]++;  // Incrementa el contador de errores
        }
    }

    if (!isset($_SESSION["id_user"])) {
        $txt .= '<form method="post" class="form_1">'
              . '<input name="Usuario" class="input_1" type="text" placeholder="Usuario" required>'
              . '<input name="passwd" type="password" class="input_1dd" placeholder="Contraseña" required>'
              . '<button type="submit" class="button-default">Enviar contraseña</button>'
              . '<div><button type="button" class="button-default"><a href="Registro.php">Registrarse</a></button></div>'
              . '</form>';
    }

    // Mostrar el número de errores si existen
    if ($_SESSION["error_count"] > 0 && $_SESSION["error_count"] < 5) {
        $txt .= "<div class='error_count'>Errores de intento: " . $_SESSION["error_count"] . "</div>";
    }
}



if (isset($_SESSION["id_user"])) {

    echo 'eoeoeoeeo';
    

    $txt.='<div>';


    

        

            $txt.='<tr><td>'
                .'<a href="?eliminar='.$U['id'].'" class="E_Usuario">Eliminar</a>'
                .'<td class="rol">'
                .'<form method="post" class="rol_section">'
                .'<select name="id_rol">'
                .'<option value="admin" '.($U['rol']=='admin'?'selected':'').'>admin</option>'
                .'<option value="usuario" '.($U['rol']=='usuario'?'selected':'').'>user</option>'
                .'</select>'
                .'<input type="hidden" name="id_user" value="'.$U['id'].'"/>'
                .'<button>Ir</button>'
                .'</form>'
                .'<td>'
                .'<input type"text" placeholder="Cambiar nombre">'
                .'<button>Ir</button>'                
                .'</td>'
                .'</td></tr>';
        
        $txt.= '</table>';
        

    

    
    $txt .= '<div class="adminsection">Bienvenido, administrador. Aquí tienes opciones avanzadas.</div>';
   

    $txt.='</div>';

    $txt .= '<a href="?logout=1" class="logout"><button class="button-default">LOGOUT</button></a>';
}

echo $txt . $error;

?>

</body>
</html>

<?php
$conn->close();  // Cerrar la conexión
?>
