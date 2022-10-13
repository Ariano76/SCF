<?php 
include('../administrador/config/connection.php');
$nom_tipo_proyecto = $_POST['nom_tipo_proyecto'];

$id = $_POST['id'];

$sql = "UPDATE `tipo_proyecto` SET  `nom_tipo_proyecto`= '$nom_tipo_proyecto' 
WHERE id_tipo_proyecto='$id' ";

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