<?php include("../administrador/config/connection.php");

$output= array();
$sql = "SELECT * FROM vista_educacion";

$totalQuery = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id_beneficiario',
	1 => 'nombre',
	2 => 'numero_cedula',
	3 => 'viaja_con_menores_de_17_anios',
	4 => 'todos_los_nna_estan_matriculados',
	5 => 'que_dispositvo_utilizan_en_clases_virtuales',
	6 => 'celular_basico',	
	7 => 'smartphone',
	8 => 'laptop',
	9 => 'ninguno',
	10 => 'que_dificultades_tuvo_al_matricular_nna',
	11 => 'no_conocia_procedimiento_matricula',
	12 => 'no_cuento_con_los_documentos',
	13 => 'no_habia_vacantes',
	14 => 'otro',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE nombre like '%".$search_value."%'";
	$sql .= " OR numero_cedula like '%".$search_value."%'";
	$sql .= " OR viaja_con_menores_de_17_anios like '%".$search_value."%'";
	$sql .= " OR todos_los_nna_estan_matriculados like '%".$search_value."%'";
	$sql .= " OR que_dispositvo_utilizan_en_clases_virtuales like '%".$search_value."%'";
	$sql .= " OR celular_basico like '%".$search_value."%'";
	$sql .= " OR smartphone like '%".$search_value."%'";
	$sql .= " OR laptop like '%".$search_value."%'";
	$sql .= " OR ninguno like '%".$search_value."%'";
	$sql .= " OR que_dificultades_tuvo_al_matricular_nna like '%".$search_value."%'";
	$sql .= " OR no_conocia_procedimiento_matricula like '%".$search_value."%'";
	$sql .= " OR no_cuento_con_los_documentos like '%".$search_value."%'";
	$sql .= " OR no_habia_vacantes like '%".$search_value."%'";
	$sql .= " OR otro like '%".$search_value."%'";
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
	$sub_array[] = $row['viaja_con_menores_de_17_anios'];
	$sub_array[] = $row['todos_los_nna_estan_matriculados'];
	$sub_array[] = $row['que_dispositvo_utilizan_en_clases_virtuales'];	
	$sub_array[] = $row['celular_basico'];
	$sub_array[] = $row['smartphone'];
	$sub_array[] = $row['laptop'];
	$sub_array[] = $row['ninguno'];
	$sub_array[] = $row['que_dificultades_tuvo_al_matricular_nna'];
	$sub_array[] = $row['no_conocia_procedimiento_matricula'];
	$sub_array[] = $row['no_cuento_con_los_documentos'];
	$sub_array[] = $row['no_habia_vacantes'];
	$sub_array[] = $row['otro'];
	
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
