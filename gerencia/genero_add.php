<?php 
include('../administrador/config/connection.php');
$nom_genero = $_POST['nom_genero'];

$sql = "INSERT INTO `genero` (`nom_genero`) values ('$nom_genero')";
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