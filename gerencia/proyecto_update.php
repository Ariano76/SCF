<?php 
include('../administrador/config/connection.php');
$nom_proyecto = $_POST['nom_proyecto'];

$id = $_POST['id'];

$sql = "UPDATE `proyecto` SET  `nom_proyecto`= '$nom_proyecto' 
WHERE id_proyecto='$id' ";

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