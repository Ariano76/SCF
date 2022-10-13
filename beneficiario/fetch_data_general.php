<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_general";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_beneficiario',
	1 => 'nombre_beneficiario',
	2 => 'primer_nombre',
	3 => 'segundo_nombre',
	4 => 'primer_apellido',
	5 => 'segundo_apellido',
	6 => 'numero_cedula',
	7 => 'tipo_identificacion',
	8 => 'numero_identificacion',
	9 => 'cual_es_su_numero_whatsapp',
	10 => 'cual_es_su_numero_recibir_sms',
	11 => 'fecha_nacimiento',
	12 => 'observaciones',
	13 => 'id_estado',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE nombre_beneficiario like '%".$search_value."%'";
	$sql .= " OR numero_cedula like '%".$search_value."%'";
	$sql .= " OR tipo_identificacion like '%".$search_value."%'";
	$sql .= " OR numero_identificacion like '%".$search_value."%'";
	$sql .= " OR cual_es_su_numero_whatsapp like '%".$search_value."%'";
	$sql .= " OR cual_es_su_numero_recibir_sms like '%".$search_value."%'";
	$sql .= " OR fecha_nacimiento like '%".$search_value."%'";
	$sql .= " OR observaciones like '%".$search_value."%'";
	$sql .= " OR id_estado like '%".$search_value."%'";
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
	$sub_array[] = $row['nombre_beneficiario'];
	$sub_array[] = $row['primer_nombre'];
	$sub_array[] = $row['segundo_nombre'];
	$sub_array[] = $row['primer_apellido'];
	$sub_array[] = $row['segundo_apellido'];
	$sub_array[] = $row['numero_cedula'];
	$sub_array[] = $row['tipo_identificacion'];
	$sub_array[] = $row['numero_identificacion'];
	$sub_array[] = $row['cual_es_su_numero_whatsapp'];
	$sub_array[] = $row['cual_es_su_numero_recibir_sms'];
	$sub_array[] = $row['fecha_nacimiento'];	
	$sub_array[] = $row['observaciones'];
	$sub_array[] = $row['id_estado'];
	
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
