<?php 
include('../administrador/config/connection.php');
$alguien_de_su_hogar_esta_embarazada = $_POST['alguien_de_su_hogar_esta_embarazada'];
$tiempo_de_gestacion = $_POST['tiempo_de_gestacion'];
$lleva_su_control_en_centro_de_salud = $_POST['lleva_su_control_en_centro_de_salud'];
$alguien_de_su_hogar_tiene_siguientes_condiciones = $_POST['alguien_de_su_hogar_tiene_siguientes_condiciones'];
$lactando_con_nn_menor_2_anios = $_POST['lactando_con_nn_menor_2_anios'];
$no_lactando_con_nn_menor_2_anios = $_POST['no_lactando_con_nn_menor_2_anios'];
$madre_nn_2_a_5_anios = $_POST['madre_nn_2_a_5_anios'];
$ninguno = $_POST['ninguno'];

$id = $_POST['id'];

$sql = "UPDATE `nutricion` SET `alguien_de_su_hogar_esta_embarazada`= '$alguien_de_su_hogar_esta_embarazada', `tiempo_de_gestacion`='$tiempo_de_gestacion', `lleva_su_control_en_centro_de_salud`='$lleva_su_control_en_centro_de_salud', `alguien_de_su_hogar_tiene_siguientes_condiciones`='$alguien_de_su_hogar_tiene_siguientes_condiciones', `lactando_con_nn_menor_2_anios`='$lactando_con_nn_menor_2_anios', `no_lactando_con_nn_menor_2_anios`='$no_lactando_con_nn_menor_2_anios', `madre_nn_2_a_5_anios`='$madre_nn_2_a_5_anios',  `ninguno`='$ninguno'
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