<?php 
include('../administrador/config/connection.php');
$nom_indigena = $_POST['nom_indigena'];

$sql = "INSERT INTO `indigena` (`nom_indigena`) values ('$nom_indigena')";
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