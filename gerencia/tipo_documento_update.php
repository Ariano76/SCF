<?php 
include('../administrador/config/connection.php');
$nom_documento = $_POST['nom_documento'];

$id = $_POST['id'];

$sql = "UPDATE `tipo_documento` SET  `nom_documento`= '$nom_documento' 
WHERE id_tipo_documento='$id' ";

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