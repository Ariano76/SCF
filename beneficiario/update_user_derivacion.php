<?php 
include('../administrador/config/connection.php');
$interesado_participar_nutricion = $_POST['interesado_participar_nutricion'];
$interesado_participar_salud = $_POST['interesado_participar_salud'];
$interesado_participar_medios_vida = $_POST['interesado_participar_medios_vida'];
$actividades_interesado_participar = $_POST['actividades_interesado_participar'];
$interesado_entrenamiento_vocacional = $_POST['interesado_entrenamiento_vocacional'];
$interesado_emprendimiento = $_POST['interesado_emprendimiento'];

$id = $_POST['id'];

$sql = "UPDATE `derivacion_sectores` SET `interesado_participar_nutricion`='$interesado_participar_nutricion', `interesado_participar_salud`='$interesado_participar_salud', `interesado_participar_medios_vida`='$interesado_participar_medios_vida', `actividades_interesado_participar`='$actividades_interesado_participar', `interesado_entrenamiento_vocacional`='$interesado_entrenamiento_vocacional', `interesado_emprendimiento`='$interesado_emprendimiento'
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