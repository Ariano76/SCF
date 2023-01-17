<?php 
include('../administrador/config/connection.php');
$algun_miembro_tiene_discapacidad = $_POST['algun_miembro_tiene_discapacidad'];
$algun_miembro_tiene_problemas_salud = $_POST['algun_miembro_tiene_problemas_salud'];
$derivacion_salud = $_POST['derivacion_salud'];
$derivacion_proteccion = $_POST['derivacion_proteccion'];

$id = $_POST['id'];

$sql = "UPDATE `salud` SET `algun_miembro_tiene_discapacidad`= '$algun_miembro_tiene_discapacidad', `algun_miembro_tiene_problemas_salud`='$algun_miembro_tiene_problemas_salud', `derivacion_salud`='$derivacion_salud', `derivacion_proteccion`='$derivacion_proteccion'
   WHERE id_beneficiario='$id' ";

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