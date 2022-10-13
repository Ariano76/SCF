<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_nutricion";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_beneficiario',
	1 => 'nombre',
	2 => 'numero_cedula',
	3 => 'alguien_de_su_hogar_esta_embarazada',
	4 => 'tiempo_de_gestacion',	
	5 => 'lleva_su_control_en_centro_de_salud',
	6 => 'alguien_de_su_hogar_tiene_siguientes_condiciones',
	7 => 'lactando_con_nn_menor_2_anios',
	8 => 'no_lactando_con_nn_menor_2_anios',
	9 => 'madre_nn_2_a_5_anios',
	10 => 'ninguno',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE nombre like '%".$search_value."%'";
	$sql .= " OR numero_cedula like '%".$search_value."%'";
	$sql .= " OR alguien_de_su_hogar_esta_embarazada like '%".$search_value."%'";
	$sql .= " OR tiempo_de_gestacion like '%".$search_value."%'";
	$sql .= " OR lleva_su_control_en_centro_de_salud like '%".$search_value."%'";
	$sql .= " OR alguien_de_su_hogar_tiene_siguientes_condiciones like '%".$search_value."%'";
	$sql .= " OR lactando_con_nn_menor_2_anios like '%".$search_value."%'";
	$sql .= " OR no_lactando_con_nn_menor_2_anios like '%".$search_value."%'";
	$sql .= " OR madre_nn_2_a_5_anios like '%".$search_value."%'";
	$sql .= " OR ninguno like '%".$search_value."%'";
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
	$sub_array[] = $row['alguien_de_su_hogar_esta_embarazada'];
	$sub_array[] = $row['tiempo_de_gestacion'];	
	$sub_array[] = $row['lleva_su_control_en_centro_de_salud'];
	$sub_array[] = $row['alguien_de_su_hogar_tiene_siguientes_condiciones'];
	$sub_array[] = $row['lactando_con_nn_menor_2_anios'];
	$sub_array[] = $row['no_lactando_con_nn_menor_2_anios'];
	$sub_array[] = $row['madre_nn_2_a_5_anios'];
	$sub_array[] = $row['ninguno'];
	
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
