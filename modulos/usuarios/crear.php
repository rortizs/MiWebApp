<!-- REQUIERO LA CONEXION A LA BASE DE DATOS -->
<?php

//CONEXION
include("../../conexion.php");

//para insertar informacion

if ($_POST) {

  print_r($_POST);

  //SE TOMAN LOS DATOS DEL METODO POST
  $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
  $password = (isset($_POST["password"]) ? $_POST["password"] : "");
  $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");

  //SENTECIA SQL
  $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios(id_usuario,usuario,password,correo)
                                 VALUES (null,:usuario,:password,:correo)");

  //asignando los valores del metodo post, del formulario
  $sentencia->bindParam(":usuario", $usuario);
  $sentencia->bindParam(":password", $password);
  $sentencia->bindParam(":correo", $correo);
  $sentencia->execute();
  header("Location: index.php");
}

//imprimo la lista
//print_r($lista_table_puesto);

?>
<?php include("../../template/header.php"); ?>
</br>
<div class="card">
  <div class="card-header">
    Datos del Usuarios
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="usuario" class="form-label">Nombre del usuario:</label>
        <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password del usuario">
      </div>

      <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="text" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
      </div>

      <button type="submit" class="btn btn-success">Agregar</button>
      <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
    </form>

  </div>
  <div class="card-footer text-muted">

  </div>
</div>




<?php include("../../template/footer.php"); ?>
