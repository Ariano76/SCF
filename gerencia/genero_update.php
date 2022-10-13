<?php 
include('../administrador/config/connection.php');
$nom_genero = $_POST['nom_genero'];

$id = $_POST['id'];

$sql = "UPDATE `genero` SET  `nom_genero`= '$nom_genero' 
WHERE id_genero='$id' ";

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