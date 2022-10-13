<?php 
include('../administrador/config/connection.php');
$nom_persona_registro = $_POST['nom_persona_registro'];

$sql = "INSERT INTO `responsable_registro` (`nom_persona_registro`) values ('$nom_persona_registro')";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
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