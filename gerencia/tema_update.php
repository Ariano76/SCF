<?php 
include('../administrador/config/connection.php');
$nom_tema = $_POST['nom_tema'];

$id = $_POST['id'];

$sql = "UPDATE `tema` SET  `nom_tema`= '$nom_tema' 
WHERE id_tema='$id' ";

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