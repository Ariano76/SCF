<?php include("../administrador/config/connection.php");
$id = $_POST['id'];
$sql = "SELECT * FROM vista_tipo_discapacidad WHERE id_tipo_discapacidad='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
