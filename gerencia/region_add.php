<?php 
include('../administrador/config/connection.php');
$nom_region = $_POST['nom_region'];

$sql = "INSERT INTO `region` (`nom_region`) values ('$nom_region')";
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