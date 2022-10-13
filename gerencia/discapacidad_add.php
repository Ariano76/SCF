<?php 
include('../administrador/config/connection.php');
$nom_discapacidad = $_POST['nom_discapacidad'];

$sql = "INSERT INTO `discapacidad` (`nom_discapacidad`) values ('$nom_discapacidad')";
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