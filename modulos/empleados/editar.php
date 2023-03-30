<?php
//CONEXION
include ("../../conexion.php");

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id_empleado=:id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $primerNombre = $registro['primer_nombre'];
    $segundoNombre = $registro['segundo_nombre'];
    $primerApellido = $registro['primer_apellido'];
    $segundoApellido = $registro['segundo_apellido'];
    $foto = $registro['foto'];
    $cv = $registro['cv'];
    $idPuesto = $registro['idPuesto'];
    $fehcaIngreso = $registro['fecha_ingreso'];

    //print_r($registro);
}

?>

<?php include "../../template/header.php"; ?>

</br>
<div class="card">
    <div class="card-header">
        Datos del Empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <div class="mb-3">
                <label for="primerNombre" class="form-label">Primer nombre</label>
                <input type="text" value="<?php echo $primerNombre; ?>" class="form-control" name="primerNombre" id="primerNombre" aria-describedby="helpId" placeholder="Primer nombre">
            </div>

            <div class="mb-3">
                <label for="segundoNombre" class="form-label">Segundo nombre</label>
                <input type="text" value="<?php echo $segundoNombre; ?>" class="form-control" name="segundoNombre" id="segundoNombre" aria-describedby="helpId" placeholder="Segundo nombre">
            </div>

            <div class="mb-3">
                <label for="primerApellido" class="form-label">Primer apellido</label>
                <input type="text" value="<?php echo $primerApellido; ?>" class="form-control" name="primerApellido" id="primerApellido" aria-describedby="helpId" placeholder="Primer apellido">
            </div>

            <div class="mb-3">
                <label for="segundoApellido" class="form-label">Segundo apellido</label>
                <input type="text" value="<?php echo $segundoApellido; ?>" class="form-control" name="segundoApellido" id="segundoApellido" aria-describedby="helpId" placeholder="Segundo apellio">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Foto:</label>
                <input type="file" value="<?php echo $foto; ?>" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
            </div>

            <div class="mb-3">
                <label for="cv" class="form-label">CV(pdf):</label>
                <input type="file" value="<?php echo $cv; ?>" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
            </div>

            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                    <!-- Ciclo for each para la tabla puestos -->
                    <?php foreach ($lista_table_puesto as $registro) { ?>
                        <option value="<?php echo $registro['id_puestos'] ?>"><?php echo $registro['nombre_puesto'] ?></option>
                    <?php } ?>
                </select>

            </div>

            <div class="mb-3">
                <label for="fehcaIngreso" class="form-label">Fecha de ingreso:</label>
                <input type="date" value="<?php echo $fehcaIngreso; ?>" class="form-control" name="fehcaIngreso" id="fehcaIngreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
            </div>


            <button type="submit" class="btn btn-success">Agregar registro</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>
    </div>
</div>



<?php include "../../template/footer.php"; ?>
