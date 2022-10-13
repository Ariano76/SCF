<?php 
include('../administrador/config/connection.php');
$nom_subtema = $_POST['nom_subtema'];
$id_tema = $_POST['id_tema'];

/*echo "<script>console.log('nom_subtema: " . $nom_subtema . "' );</script>";
echo "<script>console.log('id_tema: " . $id_tema . "' );</script>";
*/

$sql = "INSERT INTO `subtema` (`nom_subtema`,`id_tema`) values ('$nom_subtema','$id_tema')";

$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
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