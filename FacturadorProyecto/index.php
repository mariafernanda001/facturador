<html>
    <head> <title>Facturador</title></head>

    <body style="background-color:pink;">

    <h1>Inicio de sesion</h1>
    
    <form action="#" method="POST">
		<input type="text" id="usuario" name="usuario" required placeholder='Usuario'/><br><br>
        <input type="text" id="contrasena" name="contrasena" required placeholder='Contraseña'/><br><br>
		<input style="background-color:#ff0080; color:white;"type="submit" value="Iniciar sesion" id="iniciar" name="iniciar" />
	</form>

    </body>
</html>

<?php
    require 'mysql/conexion.php';

    if(isset($_POST['usuario'])){
        $user = $_POST ['usuario'];
        $contra = $_POST ['contrasena'];
    }
    else{
        $user = null;
    }

    if($user != null && $contra != null){

        $sqlUser = "SELECT correo, contrasena FROM cliente WHERE correo='$user' AND contrasena='$contra'";
        $resUser = mysqli_query($mysql,$sqlUser);      
        $array = mysqli_fetch_array($resUser);

        $sqlAdmin = "SELECT codRol FROM cliente where correo='$user' AND contrasena='$contra'";
        $resAdmin = mysqli_query($mysql,$sqlAdmin);
        $arrayAdmin= mysqli_fetch_array($resAdmin);

        $correo= $array['correo'];

        if ($array['correo']==$user && $array['contrasena']==$contra){

            switch($arrayAdmin['codRol']){
                case 0:
                    header ('location: admin.php');
                break;

                case 1:
                    header ('location: cliente.php');
                break;

                default;
            }
            
        }
        else{
            echo "<h2>Ese usuario no existe</h2>";
        }

    }
?>




