<?php 
include('../administrador/config/connection.php');
$nom_discapacidad = $_POST['nom_discapacidad'];

$id = $_POST['id'];

$sql = "UPDATE `discapacidad` SET  `nom_discapacidad`= '$nom_discapacidad' 
WHERE id_discapacidad='$id' ";

$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);

if($query==true)
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