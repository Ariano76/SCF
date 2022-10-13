<?php 
include('../administrador/config/connection.php');
$nom_adulto = $_POST['nom_adulto'];

$id = $_POST['id'];

$sql = "UPDATE `adulto` SET  `nom_adulto`= '$nom_adulto' WHERE id_adulto='$id' ";

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