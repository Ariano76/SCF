<?php 
include('../administrador/config/connection.php');
$nom_tema = $_POST['nom_tema'];

$sql = "INSERT INTO `tema` (`nom_tema`) values ('$nom_tema')";
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