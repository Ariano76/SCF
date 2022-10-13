<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_acciones";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(	
	0 => 'nombre_beneficiario',
	1 => 'numero_cedula',
	2 => 'entidad',
	3 => 'fecha',
	4 => 'id_accion',	
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE nombre_beneficiario like '%".$search_value."%'";
	$sql .= " OR numero_cedula like '%".$search_value."%'";
	$sql .= " OR entidad like '%".$search_value."%'";
	$sql .= " OR fecha like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY fecha desc";
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
	$sub_array[] = $row['fecha'];	
	$sub_array[] = $row['nombre_beneficiario'];
	$sub_array[] = $row['numero_cedula'];
	$sub_array[] = $row['entidad'];
	$sub_array[] = $row['id_accion'];
	//$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id_beneficiario'].'" class="btn btn-info btn-sm editbtn" >Edit</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=> $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
