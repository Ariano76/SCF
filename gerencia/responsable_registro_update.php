<?php 
include('../administrador/config/connection.php');
$nom_persona_registro = $_POST['nom_persona_registro'];

$id = $_POST['id'];

$sql = "UPDATE `responsable_registro` SET  `nom_persona_registro`= '$nom_persona_registro' 
WHERE id_persona_registro='$id' ";

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