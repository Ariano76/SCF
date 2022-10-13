<?php 
include('../administrador/config/connection.php');
$viaja_con_menores_de_17_anios = $_POST['viaja_con_menores_de_17_anios'];
$todos_los_nna_estan_matriculados = $_POST['todos_los_nna_estan_matriculados'];
$que_dispositvo_utilizan_en_clases_virtuales = $_POST['que_dispositvo_utilizan_en_clases_virtuales'];
$celular_basico = $_POST['celular_basico'];
$smartphone = $_POST['smartphone'];
$laptop = $_POST['laptop'];
$ninguno = $_POST['ninguno'];
$que_dificultades_tuvo_al_matricular_nna = $_POST['que_dificultades_tuvo_al_matricular_nna'];
$no_conocia_procedimiento_matricula = $_POST['no_conocia_procedimiento_matricula'];
$no_cuento_con_los_documentos = $_POST['no_cuento_con_los_documentos'];
$no_habia_vacantes = $_POST['no_habia_vacantes'];
$otro = $_POST['otro'];

$id = $_POST['id'];

$sql = "UPDATE `educacion` SET `viaja_con_menores_de_17_anios`= '$viaja_con_menores_de_17_anios', `todos_los_nna_estan_matriculados`='$todos_los_nna_estan_matriculados', `que_dispositvo_utilizan_en_clases_virtuales`='$que_dispositvo_utilizan_en_clases_virtuales', `celular_basico`='$celular_basico', `smartphone`='$smartphone', `laptop`='$laptop', `ninguno`='$ninguno',  `que_dificultades_tuvo_al_matricular_nna`='$que_dificultades_tuvo_al_matricular_nna', `no_conocia_procedimiento_matricula`='$no_conocia_procedimiento_matricula', `no_cuento_con_los_documentos`='$no_cuento_con_los_documentos', `no_habia_vacantes`='$no_habia_vacantes', `otro`='$otro'
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