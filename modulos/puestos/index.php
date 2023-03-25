<!-- REQUIERO LA CONEXION A LA BASE DE DATOS -->
<?php

//CONEXION
include "../../bd.php";

//validamos, y enviamos parametros por el metodo get, para borrar
if (isset($_GET['txtID'])) {

	//if ternario
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

	//$id=$_GET['txtID'];
	$sentencia = $conexion->prepare("DELETE FROM `tbl_puestos` WHERE `id_puestos` = :id");
	$sentencia->bindParam(':id', $txtID);
	$sentencia->execute();
	header("Location: index.php");

}

//CONSULTA SQL A LA TABLA PUESTOS
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");

//EJECUTO EL QUERY
$sentencia->execute();

//CARGO EN UNA VARIABLE LISTA LOS DATOS
$lista_table_puesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//imprimo la lista
//print_r($lista_table_puesto);

?>
<?php include "../../templates/header.php";?>



</br>

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
                        <th scope="col">Nombre del Puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo for each -->
                    <?php foreach ($lista_table_puesto as $registro) {?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id_puestos'] ?></td>
                            <td><?php echo $registro['nombre_puesto'] ?></td>
                            <td>
                                <a class="btn btn-warning" href="editar.php?txtID=<?php echo $registro['id_puestos']; ?>" role="button">Editar</a>

                                <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id_puestos']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este puesto?')" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php }?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
        Módulo de Puestos
    </div>
</div>




<?php include "../../templates/footer.php";?>
