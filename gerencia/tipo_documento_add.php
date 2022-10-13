<?php 
include('../administrador/config/connection.php');
$nom_documento = $_POST['nom_documento'];

$sql = "INSERT INTO `tipo_documento` (`nom_documento`) values ('$nom_documento')";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
    $data = array(
        'status'=>'true',       
    );
    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
    );
    echo json_encode($data);
} 

?>