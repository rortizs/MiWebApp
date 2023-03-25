<!-- REQUIERO LA CONEXION A LA BASE DE DATOS -->
<?php

//CONEXION
include "../../bd.php";

//validamos, y enviamos parametros por el metodo get, para borrar
if (isset($_GET['txtID'])) {

	//if ternario
	$txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

	//$id=$_GET['txtID'];
	$sentencia = $conexion->prepare("DELETE FROM `tbl_usuarios` WHERE `id_usuario` = :id");
	$sentencia->bindParam(':id', $txtID);
	$sentencia->execute();
	header("Location: index.php");
}

//CONSULTA SQL A LA TABLA PUESTOS
$sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`");

//EJECUTO EL QUERY
$sentencia->execute();

//CARGO EN UNA VARIABLE LISTA LOS DATOS
$lista_table_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

//imprimo la lista
//print_r($lista_table_puesto);

?>

<?php include "../../templates/header.php";?>


</br>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar usuario</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del usuario</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ciclo for each -->
                    <?php foreach ($lista_table_usuarios as $registro) {?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id_usuario'] ?></td>
                            <td><?php echo $registro['usuario'] ?></td>
                            <td><?php echo $registro['password'] ?></td>
                            <td><?php echo $registro['correo'] ?></td>
                            <td>

                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id_usuario'] ?>" role="button">Editar</a>

                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id_usuario'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')" role="button">Borrar</a>

                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
        Módulo de Usuarios
    </div>
</div>



<?php include "../../templates/footer.php";?>
