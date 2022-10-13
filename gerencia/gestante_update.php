<?php 
include('../administrador/config/connection.php');
$nom_gestante = $_POST['nom_gestante'];

$id = $_POST['id'];

$sql = "UPDATE `gestante` SET  `nom_gestante`= '$nom_gestante' 
WHERE id_gestante='$id' ";

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