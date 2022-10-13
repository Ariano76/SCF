<?php 
include('../administrador/config/connection.php');
$nom_proyecto = $_POST['nom_proyecto'];

$sql = "INSERT INTO `proyecto` (`nom_proyecto`) values ('$nom_proyecto')";
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