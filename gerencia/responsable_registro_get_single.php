<?php include("../administrador/config/connection.php");
$id = $_POST['id'];
$sql = "SELECT * FROM vista_responsable_registro WHERE id_persona_registro='$id' LIMIT 1";
$query = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
?>
