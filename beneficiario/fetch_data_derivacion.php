<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_derivacion_sectores";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_beneficiario',
	1 => 'nombre',
	2 => 'numero_cedula',
	3 => 'interesado_participar_nutricion',
	4 => 'interesado_participar_salud',
	5 => 'interesado_participar_medios_vida',
	6 => 'actividades_interesado_participar',	
	7 => 'interesado_entrenamiento_vocacional',
	8 => 'interesado_emprendimiento',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE nombre like '%".$search_value."%'";
	$sql .= " OR numero_cedula like '%".$search_value."%'";
	$sql .= " OR interesado_participar_nutricion like '%".$search_value."%'";
	$sql .= " OR interesado_participar_salud like '%".$search_value."%'";
	$sql .= " OR interesado_participar_medios_vida like '%".$search_value."%'";
	$sql .= " OR actividades_interesado_participar like '%".$search_value."%'";
	$sql .= " OR interesado_entrenamiento_vocacional like '%".$search_value."%'";
	$sql .= " OR interesado_emprendimiento like '%".$search_value."%'";
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
	$sub_array[] = $row['interesado_participar_nutricion'];
	$sub_array[] = $row['interesado_participar_salud'];
	$sub_array[] = $row['interesado_participar_medios_vida'];	
	$sub_array[] = $row['actividades_interesado_participar'];
	$sub_array[] = $row['interesado_entrenamiento_vocacional'];
	$sub_array[] = $row['interesado_emprendimiento'];
	
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
