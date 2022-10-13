<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_comunicacion";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_beneficiario',
	1 => 'nombre',
	2 => 'numero_cedula',
	3 => 'tiene_los_siguientes_medios_comunicacion',
	4 => 'celular_basico',
	5 => 'smartphone',	
	6 => 'laptop',
	7 => 'ninguno',
	8 => 'cual_es_su_numero_whatsapp',
	9 => 'cual_es_su_numero_recibir_sms',
	10 => 'cual_numero_usa_con_frecuencia',
	11 => 'es_telefono_propio',
	12 => 'como_accede_a_internet',
	13 => 'cual_es_su_direccion',
	14 => 'vive_o_viaja_con_otros_familiares',	
	15 => 'cuantos_viven_o_viajan_con_usted',
	16 => 'cuantos_tienen_ingreso_por_trabajo',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE nombre like '%".$search_value."%'";
	$sql .= " OR numero_cedula like '%".$search_value."%'";
	$sql .= " OR tiene_los_siguientes_medios_comunicacion like '%".$search_value."%'";
	$sql .= " OR celular_basico like '%".$search_value."%'";
	$sql .= " OR smartphone like '%".$search_value."%'";
	$sql .= " OR laptop like '%".$search_value."%'";
	$sql .= " OR ninguno like '%".$search_value."%'";
	$sql .= " OR cual_es_su_numero_whatsapp like '%".$search_value."%'";
	$sql .= " OR cual_es_su_numero_recibir_sms like '%".$search_value."%'";
	$sql .= " OR cual_numero_usa_con_frecuencia like '%".$search_value."%'";
	$sql .= " OR es_telefono_propio like '%".$search_value."%'";
	$sql .= " OR como_accede_a_internet like '%".$search_value."%'";
	$sql .= " OR cual_es_su_direccion like '%".$search_value."%'";
	$sql .= " OR vive_o_viaja_con_otros_familiares like '%".$search_value."%'";
	$sql .= " OR cuantos_viven_o_viajan_con_usted like '%".$search_value."%'";
	$sql .= " OR cuantos_tienen_ingreso_por_trabajo like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id_beneficiario asc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id_beneficiario'];
	$sub_array[] = $row['nombre'];
	$sub_array[] = $row['numero_cedula'];
	$sub_array[] = $row['tiene_los_siguientes_medios_comunicacion'];
	$sub_array[] = $row['celular_basico'];
	$sub_array[] = $row['smartphone'];	
	$sub_array[] = $row['laptop'];
	$sub_array[] = $row['ninguno'];
	$sub_array[] = $row['cual_es_su_numero_whatsapp'];
	$sub_array[] = $row['cual_es_su_numero_recibir_sms'];
	$sub_array[] = $row['cual_numero_usa_con_frecuencia'];
	$sub_array[] = $row['es_telefono_propio'];
	$sub_array[] = $row['como_accede_a_internet'];
	$sub_array[] = $row['cual_es_su_direccion'];
	$sub_array[] = $row['vive_o_viaja_con_otros_familiares'];
	$sub_array[] = $row['cuantos_viven_o_viajan_con_usted'];
	$sub_array[] = $row['cuantos_tienen_ingreso_por_trabajo'];
	
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id_beneficiario'].'" class="btn btn-info btn-sm editbtn" >Edit</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=> $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
