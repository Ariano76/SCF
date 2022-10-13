<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_encuesta";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_beneficiario',
	1 => 'nombre',
	2 => 'numero_cedula',
	3 => 'fecha_encuesta',
	4 => 'id_encuestador',
	5 => 'nombre_encuestador',
	6 => 'region_encuestador',
	7 => 'como_realizo_encuesta',
	8 => 'esta_de_acuerdo',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE nombre like '%".$search_value."%'";
	$sql .= " OR numero_cedula like '%".$search_value."%'";
	$sql .= " OR fecha_encuesta like '%".$search_value."%'";
	$sql .= " OR id_encuestador like '%".$search_value."%'";
	$sql .= " OR nombre_encuestador like '%".$search_value."%'";
	$sql .= " OR region_encuestador like '%".$search_value."%'";
	$sql .= " OR como_realizo_encuesta like '%".$search_value."%'";
	$sql .= " OR esta_de_acuerdo like '%".$search_value."%'";
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
	$sub_array[] = $row['fecha_encuesta'];
	$sub_array[] = $row['id_encuestador'];
	$sub_array[] = $row['nombre_encuestador'];
	$sub_array[] = $row['region_encuestador'];
	$sub_array[] = $row['como_realizo_encuesta'];
	$sub_array[] = $row['esta_de_acuerdo'];
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
