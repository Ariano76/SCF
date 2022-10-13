<?php 
include('../administrador/config/connection.php');
$tiene_los_siguientes_medios_comunicacion = $_POST['tiene_los_siguientes_medios_comunicacion'];
$celular_basico = $_POST['celular_basico'];
$smartphone = $_POST['smartphone'];
$laptop = $_POST['laptop'];
$ninguno = $_POST['ninguno'];
$cual_es_su_numero_whatsapp = $_POST['cual_es_su_numero_whatsapp'];
$cual_es_su_numero_recibir_sms = $_POST['cual_es_su_numero_recibir_sms'];
$cual_numero_usa_con_frecuencia = $_POST['cual_numero_usa_con_frecuencia'];
$es_telefono_propio = $_POST['es_telefono_propio'];
$como_accede_a_internet = $_POST['como_accede_a_internet'];
$cual_es_su_direccion = $_POST['cual_es_su_direccion'];
$vive_o_viaja_con_otros_familiares = $_POST['vive_o_viaja_con_otros_familiares'];
$cuantos_viven_o_viajan_con_usted = $_POST['cuantos_viven_o_viajan_con_usted'];
$cuantos_tienen_ingreso_por_trabajo = $_POST['cuantos_tienen_ingreso_por_trabajo'];

$id = $_POST['id'];

$sql = "UPDATE `comunicacion` SET `tiene_los_siguientes_medios_comunicacion`= '$tiene_los_siguientes_medios_comunicacion', `celular_basico`='$celular_basico', `smartphone`='$smartphone', `laptop`='$laptop', `ninguno`='$ninguno', `cual_es_su_numero_whatsapp`='$cual_es_su_numero_whatsapp', `cual_es_su_numero_recibir_sms`='$cual_es_su_numero_recibir_sms',  `cual_numero_usa_con_frecuencia`='$cual_numero_usa_con_frecuencia', `es_telefono_propio`='$es_telefono_propio', `como_accede_a_internet`='$como_accede_a_internet', `cual_es_su_direccion`='$cual_es_su_direccion', `vive_o_viaja_con_otros_familiares`='$vive_o_viaja_con_otros_familiares',  `cuantos_viven_o_viajan_con_usted`='$cuantos_viven_o_viajan_con_usted',  `cuantos_tienen_ingreso_por_trabajo`='$cuantos_tienen_ingreso_por_trabajo'
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