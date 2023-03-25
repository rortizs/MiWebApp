<!-- REQUIERO LA CONEXION A LA BASE DE DATOS -->
<?php

//CONEXION
include "../../bd.php";

//para insertar informacion

if ($_POST) {

	print_r($_POST);

	//SE TOMAN LOS DATOS DEL METODO POST
	$nombre_puesto = (isset($_POST["nombrePuesto"]) ? $_POST["nombrePuesto"] : "");

	//SENTECIA SQL
	$sentencia = $conexion->prepare("INSERT INTO tbl_puestos(id_puestos,nombre_puesto)
                                 VALUES (null, :nombrePuesto)");
	print_r($sentencia);

	//asignando los valores del metodo post, del formulario
	$sentencia->bindParam(":nombrePuesto", $nombre_puesto);
	$sentencia->execute();
	header("Location: index.php");

}

//imprimo la lista
//print_r($lista_table_puesto);

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
              <label for="nombrePuesto" class="form-label">Nombre del puesto:</label>
              <input type="text"
                class="form-control" name="nombrePuesto" id="nombrePuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>




<?php include "../../templates/footer.php";?>
