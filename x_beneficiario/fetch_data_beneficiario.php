<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_beneficiario";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_beneficiario',
	1 => 'primer_nombre',
	2 => 'segundo_nombre',
	3 => 'primer_apellido',
	4 => 'segundo_apellido',	
	5 => 'region_beneficiario',
	6 => 'otra_region',
	7 => 'se_instalara_en_esta_region',
	8 => 'en_que_provincia',
	9 => 'transit_settle',
	10 => 'en_que_otro_caso_1',
	11 => 'en_que_distrito',
	12 => 'en_que_otro_caso_2',
	13 => 'en_que_otro_caso_3',	
	14 => 'genero',
	15 => 'fecha_nacimiento',
	16 => 'tiene_carne_extranjeria',
	17 => 'numero_cedula',
	18 => 'fecha_caducidad_cedula',
	19 => 'tipo_identificacion',
	20 => 'numero_identificacion',
	21 => 'fecha_caducidad_identificacion',
	22 => 'documentos_fisico_original',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE region_beneficiario like '%".$search_value."%'";
	$sql .= " OR otra_region like '%".$search_value."%'";
	$sql .= " OR se_instalara_en_esta_region like '%".$search_value."%'";
	$sql .= " OR en_que_provincia like '%".$search_value."%'";
	$sql .= " OR transit_settle like '%".$search_value."%'";
	$sql .= " OR en_que_otro_caso_1 like '%".$search_value."%'";
	$sql .= " OR en_que_distrito like '%".$search_value."%'";
	$sql .= " OR en_que_otro_caso_2 like '%".$search_value."%'";
	$sql .= " OR en_que_otro_caso_3 like '%".$search_value."%'";
	$sql .= " OR primer_nombre like '%".$search_value."%'";
	$sql .= " OR segundo_nombre like '%".$search_value."%'";
	$sql .= " OR primer_apellido like '%".$search_value."%'";
	$sql .= " OR segundo_apellido like '%".$search_value."%'";
	$sql .= " OR genero like '%".$search_value."%'";
	$sql .= " OR fecha_nacimiento like '%".$search_value."%'";
	$sql .= " OR tiene_carne_extranjeria like '%".$search_value."%'";
	$sql .= " OR numero_cedula like '%".$search_value."%'";
	$sql .= " OR fecha_caducidad_cedula like '%".$search_value."%'";
	$sql .= " OR tipo_identificacion like '%".$search_value."%'";
	$sql .= " OR numero_identificacion like '%".$search_value."%'";
	$sql .= " OR fecha_caducidad_identificacion like '%".$search_value."%'";
	$sql .= " OR documentos_fisico_original like '%".$search_value."%'";
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
	$sub_array[] = $row['primer_nombre'];
	$sub_array[] = $row['segundo_nombre'];
	$sub_array[] = $row['primer_apellido'];
	$sub_array[] = $row['segundo_apellido'];	
	$sub_array[] = $row['region_beneficiario'];
	$sub_array[] = $row['otra_region'];
	$sub_array[] = $row['se_instalara_en_esta_region'];
	$sub_array[] = $row['en_que_provincia'];
	$sub_array[] = $row['transit_settle'];
	$sub_array[] = $row['en_que_otro_caso_1'];
	$sub_array[] = $row['en_que_distrito'];
	$sub_array[] = $row['en_que_otro_caso_2'];
	$sub_array[] = $row['en_que_otro_caso_3'];
	$sub_array[] = $row['genero'];
	$sub_array[] = $row['fecha_nacimiento'];
	$sub_array[] = $row['tiene_carne_extranjeria'];
	$sub_array[] = $row['numero_cedula'];
	$sub_array[] = $row['fecha_caducidad_cedula'];
	$sub_array[] = $row['tipo_identificacion'];
	$sub_array[] = $row['numero_identificacion'];
	$sub_array[] = $row['fecha_caducidad_identificacion'];
	$sub_array[] = $row['documentos_fisico_original'];
	
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
