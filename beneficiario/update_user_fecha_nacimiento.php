<?php 

require_once '../administrador/config/bdPDObenef.php';

$db = new TransactionSCI();
$conn = $db->Connect();

/*function debug_to_console( $opc ) {
    if ( is_array( $opc ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $opc) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $opc . "' );</script>";
    echo $output;
}*/

$cedula_beneficiario_principal = $_POST['cedula_beneficiario_principal'];
$nombre = $_POST['nombre'];
$genero = $_POST['genero'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$edad = $_POST['edad'];
$relacion = $_POST['relacion'];

$id = $_POST['id'];

$cod_00 = $db->Update_General($cedula_beneficiario_principal, $nombre, $genero, $fecha_nacimiento, $edad, $relacion, $id);

//$sql = "UPDATE `beneficiario` SET  `primer_nombre`='$primer_nombre',  `segundo_nombre`='$segundo_nombre',  `primer_apellido`='$primer_apellido',  `segundo_apellido`='$segundo_apellido',  `numero_cedula`='$numero_cedula', `tipo_identificacion`='$tipo_identificacion',  `numero_identificacion`='$numero_identificacion', `fecha_nacimiento`='$fecha_nacimiento' WHERE id_beneficiario='$id' ";
//$query= mysqli_query($con,$sql);
//$lastId = mysqli_insert_id($con);

//debug_to_console( $cod_00 );
// El SP DEVUELVE 1
if($cod_00 == true) 
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