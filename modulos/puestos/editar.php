
<?php

//CONEXION
include "../../bd.php";

if (isset($_GET['txtID'])) {
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

	$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos WHERE id_puestos=:id");
	$sentencia->bindParam(':id', $txtID);
	$sentencia->execute();

	$registro = $sentencia->fetch(PDO::FETCH_LAZY);
	$nombrePuesto = $registro['nombre_puesto'];
	//print_r($registro);
}

//para editar informacion

if ($_POST) {

	print_r($_POST);

	//SE TOMAN LOS DATOS DEL METODO POST
	$txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
	$nombre_puesto = (isset($_POST["nombrePuesto"]) ? $_POST["nombrePuesto"] : "");

	//SENTECIA SQL
	$sentencia = $conexion->prepare("UPDATE tbl_puestos SET nombre_puesto=:nombrePuesto WHERE id_puestos=:id");

	//asignando los valores del metodo post, del formulario
	$sentencia->bindParam(":nombrePuesto", $nombre_puesto);
	$sentencia->bindParam(":id", $txtID);
	$sentencia->execute();
	header("Location: index.php");
}

?>

<?php include "../../templates/header.php";?>


</br>
<div class="card">
    <div class="card-header">
        Puestos
    </div>

    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text" value="<?php echo $txtID; ?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
              <label for="nombrePuesto" class="form-label">Nombre del puesto:</label>
              <input type="text" value="<?php echo $nombrePuesto; ?>"
                class="form-control" name="nombrePuesto" id="nombrePuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>



<?php include "../../templates/footer.php";?>
