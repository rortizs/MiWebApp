<?php

//CONEXION
include "../../bd.php";

//validamos, y enviamos parametros por el metodo get, para borrar
if (isset($_GET['txtID'])) {

	//if ternario
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

	//todo: Primero
	/* Getting the foto and cv from the tbl_empleados table where the id_empleado is equal to the id. */
	$sentencia = $conexion->prepare("SELECT foto, cv FROM `tbl_empleados` WHERE `id_empleado` = :id");
	$sentencia->bindParam(':id', $txtID);
	$sentencia->execute();
	$registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

	//print_r($registro_recuperad);

	//todo: Segundo
	/* Checking if the file exists and if it does, it deletes it. */
	if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
		if (file_exists("./") . $registro_recuperado["foto"]) {
			unlink("./" . $registro_recuperado["foto"]);
		}
	}

	/* Checking if the file exists and if it does, it deletes it. */
	if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "") {
		if (file_exists("./") . $registro_recuperado["cv"]) {
			unlink("./" . $registro_recuperado["cv"]);
		}
	}

	//todo: Tercero
	//$id=$_GET['txtID'];

	/* Deleting the record from the database. */
	$sentencia = $conexion->prepare("DELETE FROM `tbl_empleados` WHERE `id_empleado` = :id");
	$sentencia->bindParam(':id', $txtID);
	$sentencia->execute();
	header("Location: index.php");
}

// Consulta para obtener los datos de la tabla empleados y el puesto
// para ello trabajamos con la subconsulta
$sentencia = $conexion->prepare("SELECT *,(SELECT nombre_puesto FROM tbl_puestos WHERE tbl_puestos.id_puestos=tbl_empleados.id_puesto limit 1) as puesto FROM `tbl_empleados`");
//EJECUTO EL QUERY
$sentencia->execute();
//CARGO EN UNA VARIABLE LISTA LOS DATOS
$lista_table_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//imprimo la lista
//print_r($lista_table_puesto);

?>

<?php include "../../templates/header.php";?>
</br>
<h4> Empleados </h4>
<div class="card">
    <div class="card-header">

        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>

    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de Ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo for each -->
                    <?php foreach ($lista_table_empleados as $registro) {?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id_empleado'] ?></td>
                            <td scope="row">
                                <?php echo $registro['primer_nombre'] ?>
                                <?php echo $registro['segundo_nombre'] ?>
                                <?php echo $registro['primer_apellido'] ?>
                                <?php echo $registro['segundo_apellido'] ?>
                            </td>
                            <td>
                                <img width="50" src="<?php echo $registro['foto'] ?>" class="img-fluid rounded" alt="" />
                            </td>
                            <td scope="row"><?php echo $registro['cv'] ?></td>
                            <td scope="row"><?php echo $registro['puesto'] ?></td>
                            <td scope="row"><?php echo $registro['fecha_ingreso'] ?></td>
                            <td>
                                <a name="" id="" class="btn btn-primary" href="#" role="button">Carta</a>|
                                <a class="btn btn-warning" href="editar.php?txtID=<?php echo $registro['id_empleado']; ?>" role="button">Editar</a>

                                <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id_empleado']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar al empleado?')" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted">
        Módulo de Empleados
    </div>
</div>



<?php include "../../templates/footer.php";?>
