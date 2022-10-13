<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_inconsistencia_fecha_nacimiento";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_beneficiario',
	1 => 'cedula_beneficiario_principal',
	2 => 'nombre',
	3 => 'genero',
	4 => 'fecha_nacimiento',
	5 => 'edad',
	6 => 'relacion',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE cedula_beneficiario_principal like '%".$search_value."%'";
	$sql .= " OR nombre like '%".$search_value."%'";
	$sql .= " OR genero like '%".$search_value."%'";
	$sql .= " OR fecha_nacimiento like '%".$search_value."%'";
	$sql .= " OR edad like '%".$search_value."%'";
	$sql .= " OR relacion like '%".$search_value."%'";
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
	$sub_array[] = $row['cedula_beneficiario_principal'];
	$sub_array[] = $row['nombre'];
	$sub_array[] = $row['genero'];
	$sub_array[] = $row['fecha_nacimiento'];
	$sub_array[] = $row['edad'];
	$sub_array[] = $row['relacion'];
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
