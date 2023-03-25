<?php

//CONEXION
include "../../bd.php";

if (isset($_GET['txtID'])) {
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

	$sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id_usuario=:id");
	$sentencia->bindParam(':id', $txtID);
	$sentencia->execute();

	$registro = $sentencia->fetch(PDO::FETCH_LAZY);
	$usuario = $registro['usuario'];
	$password = $registro['password'];
	$correo = $registro['correo'];

	print_r($registro);
}

//para editar informacion

if ($_POST) {

	print_r($_POST);

	//SE TOMAN LOS DATOS DEL METODO POST
	$txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
	$usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
	$password = (isset($_POST["password"]) ? $_POST["password"] : "");
	$correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");

	//SENTECIA SQL
	$sentencia = $conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario, password=:password, correo=:correo WHERE id_usuario=:id");

	//asignando los valores del metodo post, del formulario
	$sentencia->bindParam(":usuario", $usuario);
	$sentencia->bindParam(":password", $password);
	$sentencia->bindParam(":correo", $correo);
	$sentencia->bindParam(":id", $txtID);
	$sentencia->execute();
	header("Location: index.php");
}

?>

<?php include "../../templates/header.php";?>


</br>
<div class="card">
    <div class="card-header">
        Datos del Usuarios
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" value="<?php echo $password; ?>" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password del usuario">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" value="<?php echo $correo; ?>" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>



<?php include "../../templates/footer.php";?>
