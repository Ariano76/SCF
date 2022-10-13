<?php 
include('../administrador/config/connection.php');
$nom_gestante = $_POST['nom_gestante'];

$sql = "INSERT INTO `gestante` (`nom_gestante`) values ('$nom_gestante')";
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