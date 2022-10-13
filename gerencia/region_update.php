<?php 
include('../administrador/config/connection.php');
$nom_region = $_POST['nom_region'];

$id = $_POST['id'];

$sql = "UPDATE `region` SET  `nom_region`= '$nom_region' 
WHERE id_region='$id' ";

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