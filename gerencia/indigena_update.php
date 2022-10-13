<?php 
include('../administrador/config/connection.php');
$nom_indigena = $_POST['nom_indigena'];

$id = $_POST['id'];

$sql = "UPDATE `indigena` SET  `nom_indigena`= '$nom_indigena' 
WHERE id_indigena='$id' ";

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