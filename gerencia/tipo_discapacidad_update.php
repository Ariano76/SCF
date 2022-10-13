<?php 
include('../administrador/config/connection.php');
$nom_tipo_discapacidad = $_POST['nom_tipo_discapacidad'];

$id = $_POST['id'];

$sql = "UPDATE `tipo_discapacidad` SET  `nom_tipo_discapacidad`= '$nom_tipo_discapacidad' 
WHERE id_tipo_discapacidad='$id' ";

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