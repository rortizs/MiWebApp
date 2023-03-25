<?php

//CONEXION
include "../../bd.php";

//para insertar informacion

if ($_POST) {

	print_r($_POST);
	print_r($_FILES);

	//SE TOMAN LOS DATOS DEL METODO POST
	$primerNombre = (isset($_POST["primerNombre"]) ? $_POST["primerNombre"] : "");
	$segundoNombre = (isset($_POST["segundoNombre"]) ? $_POST["segundoNombre"] : "");
	$primerApellido = (isset($_POST["primerApellido"]) ? $_POST["primerApellido"] : "");
	$segundoApellido = (isset($_POST["segundoApellido"]) ? $_POST["segundoApellido"] : "");

	$idPuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "");
	$fehcaIngreso = (isset($_POST["fehcaIngreso"]) ? $_POST["fehcaIngreso"] : "");

	$foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");
	$cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");

	//SENTECIA SQL
	$sentencia = $conexion->prepare("INSERT INTO
            `tbl_empleados` (`id_empleado`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `foto`, `cv`, `id_puesto`, `fecha_ingreso`)
            VALUES (NULL,:primer_nombre,:segundo_nombre,:primer_apellido,:segundo_apellido,:foto,:cv,:idPuesto,:fecha_ingreso);");

	//asignando los valores del metodo post, del formulario
	$sentencia->bindParam(":primer_nombre", $primerNombre);
	$sentencia->bindParam(":segundo_nombre", $segundoNombre);
	$sentencia->bindParam(":primer_apellido", $primerApellido);
	$sentencia->bindParam(":segundo_apellido", $segundoApellido);

	//se adjunta la foto
	$fecha_foto = new DateTime();
	$nombreArchivo_foto = ($foto != '') ? $fecha_foto->getTimestamp() . "_" . $_FILES['foto']['name'] : "";
	$tmp_foto = $_FILES['foto']['tmp_name'];

	//validamos si todo esta bien
	if ($tmp_foto != '') {
		move_uploaded_file($tmp_foto, "./" . $nombreArchivo_foto);
	}
	$sentencia->bindParam(":foto", $nombreArchivo_foto);

	//se adjunta el cv
	$nombreArchivo_cv = ($cv != '') ? $fecha_foto->getTimestamp() . "_" . $_FILES['cv']['name'] : "";
	$tmp_cv = $_FILES['cv']['tmp_name'];

	//validamos si todo esta bien
	if ($tmp_cv != '') {
		move_uploaded_file($tmp_cv, "./" . $nombreArchivo_cv);
	}
	$sentencia->bindParam(":cv", $nombreArchivo_cv);

	$sentencia->bindParam(":idPuesto", $idPuesto);
	$sentencia->bindParam(":fecha_ingreso", $fehcaIngreso);

	$sentencia->execute();
	header("Location: index.php");
}

//CONSULTA SQL A LA TABLA PUESTOS
$sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");
//EJECUTO EL QUERY
$sentencia->execute();
//CARGO EN UNA VARIABLE LISTA LOS DATOS
$lista_table_puesto = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include "../../templates/header.php";?>

</br>
<div class="card">
  <div class="card-header">
    Datos del Empleado
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">

      <div class="mb-3">
        <label for="primerNombre" class="form-label">Primer nombre</label>
        <input type="text" class="form-control" name="primerNombre" id="primerNombre" aria-describedby="helpId" placeholder="Primer nombre">
      </div>

      <div class="mb-3">
        <label for="segundoNombre" class="form-label">Segundo nombre</label>
        <input type="text" class="form-control" name="segundoNombre" id="segundoNombre" aria-describedby="helpId" placeholder="Segundo nombre">
      </div>

      <div class="mb-3">
        <label for="primerApellido" class="form-label">Primer apellido</label>
        <input type="text" class="form-control" name="primerApellido" id="primerApellido" aria-describedby="helpId" placeholder="Primer apellido">
      </div>

      <div class="mb-3">
        <label for="segundoApellido" class="form-label">Segundo apellido</label>
        <input type="text" class="form-control" name="segundoApellido" id="segundoApellido" aria-describedby="helpId" placeholder="Segundo apellio">
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Foto:</label>
        <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
      </div>

      <div class="mb-3">
        <label for="cv" class="form-label">CV(pdf):</label>
        <input type="file" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
      </div>

      <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto:</label>
        <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
          <!-- Ciclo for each para la tabla puestos -->
          <?php foreach ($lista_table_puesto as $registro) {?>
            <option value="<?php echo $registro['id_puestos'] ?>"><?php echo $registro['nombre_puesto'] ?></option>
          <?php }?>
        </select>

      </div>

      <div class="mb-3">
        <label for="fehcaIngreso" class="form-label">Fecha de ingreso:</label>
        <input type="date" class="form-control" name="fehcaIngreso" id="fehcaIngreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso a la empresa">
      </div>


      <button type="submit" class="btn btn-success">Agregar registro</button>
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


    </form>
  </div>
</div>



<?php include "../../templates/footer.php";?>
