<?php include("../template/cabecera.php") ?>
<?php 

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";


include("../config/bddemo.php");

switch ($accion) {
	case "agregar":
	$sql = $conexion->prepare("insert into libros (nombre,imagen) values (:nombre,:imagen)
		;");
	$sql->bindparam(":nombre", $txtNombre);

	$fecha=new DateTime();
	$nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"img.jpg";
	$tmpImagen = $_FILES['txtImagen']['tmp_name'];

	if ($tmpImagen!="") {
		move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);
	}

	$sql->bindparam(":imagen", $nombreArchivo);
	$sql->execute();

	header("Location:productos.php");

	break;

	case "modificar":
	$sql = $conexion->prepare("update libros set nombre=:nombre where idlibros=:id");
	$sql->bindparam(":id", $txtID);
	$sql->bindparam(":nombre", $txtNombre);
	$sql->execute();

	if ($txtImagen!="") {

		$fecha=new DateTime();
		$nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"img.jpg";
		$tmpImagen = $_FILES['txtImagen']['tmp_name'];

		move_uploaded_file($tmpImagen, "../../img/".$nombreArchivo);

		$sql = $conexion->prepare("select * from libros where idlibros=:id");
		$sql->bindparam(":id", $txtID);
		$sql->execute();
		$libro = $sql->fetch(PDO::FETCH_LAZY);

		if (isset($libro["imagen"]) && ($libro['imagen']!= 'img.jpg')) {
			if (file_exists('../../img/'.$libro['imagen'])) {
				unlink('../../img/'.$libro['imagen']);
			}
		}

		$sql = $conexion->prepare("update libros set imagen=:imagen where idlibros=:id");
		$sql->bindparam(":id", $txtID);
		$sql->bindparam(":imagen", $nombreArchivo);
		$sql->execute();

	}

	header("Location:productos.php");

	break;

	case "cancelar":
	header("Location:productos.php");

	break;

	case "seleccionar":
	$sql = $conexion->prepare("select * from libros where idlibros=:id");
	$sql->bindparam(":id", $txtID);
	$sql->execute();
	$libro = $sql->fetch(PDO::FETCH_LAZY);

	$txtNombre = $libro['nombre'];
	$txtImagen = $libro['imagen'];

	break;

	case "borrar":
	$sql = $conexion->prepare("select imagen from libros where idlibros=:id");
	$sql->bindparam(":id", $txtID);
	$sql->execute();
	$libro = $sql->fetch(PDO::FETCH_LAZY);

	if (isset($libro["imagen"]) && ($libro['imagen']!= 'img.jpg')) {
		if (file_exists('../../img/'.$libro['imagen'])) {
			unlink('../../img/'.$libro['imagen']);
		}
	}

	$sql = $conexion->prepare("delete from libros where idlibros=:id");
	$sql->bindparam(":id", $txtID);
	$sql->execute();

	header("Location:productos.php");

	break;
}

$sql = $conexion->prepare("select * from libros");
$sql->execute();
$listaLibros = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">

	<div class="card text-dark bg-light">
		<div class="card-header">
			Datos de Libros
		</div>
		<div class="card-body">

			<form method="POST" enctype="multipart/form-data">

				<div class="form-group">
					<label for="txtID">ID:</label>
					<input required readonly type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">			
				</div>

				<div class="form-group">
					<label for="txtNombre">Nombre:</label>
					<input required type="text" class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del libro">			
				</div>

				<div class="form-group">
					<label for="txtImagen">Imagen:</label>
					<br>

					<?php 

					if ($txtImagen!="") { ?>
						<img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="50" alt="" srcset="">

					<?php } ?>
					<br>
					<input type="file" class="form-control" name="txtImagen" id="txtImagen" >	
				</div>

				<div class="btn-group" role="group" aria-label="Basic example">
					<button type="submit" name="accion" <?php echo($accion=="seleccionar")?"disabled":""; ?> value="agregar" class="btn btn-success btn-lg">Agregar</button>
					<button type="submit" name="accion" <?php echo($accion!=="seleccionar")?"disabled":""; ?> value="modificar" class="btn btn-warning btn-lg">Moficar</button>
					<button type="submit" name="accion" <?php echo($accion!=="seleccionar")?"disabled":""; ?> value="cancelar" class="btn btn-info btn-lg">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="col-md-7">

	<table class="table table-bordered table-inverse table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Imagen</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($listaLibros as $libro) {?>
				
				<tr>
					<td><?php echo $libro['idlibros'] ?></td>
					<td><?php echo $libro['nombre'] ?></td>
					<td>

						<img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="50" alt="" srcset="">
					</td>
					
					<td>
						<form method="POST"> 
							<input type="hidden" name="txtID" value="<?php echo $libro['idlibros'];?>" />
							<input type="submit" name="accion" value="seleccionar" class="btn btn-primary" />
							<input type="submit" name="accion" value="borrar" class="btn btn-danger" />
						</form>
					</td>
				</tr>

			<?php } ?>
		</tbody>
	</table>

</div>


<?php include("../template/pie.php") ?>