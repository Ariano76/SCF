<?php 
include('../administrador/config/connection.php');
$nom_adulto = $_POST['nom_adulto'];

$sql = "INSERT INTO `adulto` (`nom_adulto`) values ('$nom_adulto')";
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