<?php include("../template/cabecera.php"); 

//include("../administrador/config/connection.php");
//require_once ('../config/bdPDObenef.php');
require_once ('../administrador/config/bdPDObenef.php');
$db_1 = new TransactionSCI();

?>

<h1 class="display-8">CONSULTA DATOS DEL BENEFICIARIO </h1>     

<form method="POST" action="resumen.php" >
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-3 form-control-label">Ingrese número de cédula</label>
    <div class="col-sm-2">
      <!--input type="number" ondrop="return false;" onpaste="return false;" onkeypress="return event.charCode>=48 && event.charCode<=57" required placeholder="ingrese cédula"/-->
        <!--input type="number" name="cedula" cédula"/-->
        <input type="text" name="doc" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" maxlength=25 />
      </div>
      <div class="col-sm-4">
        <label>&nbsp;
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success" name="btn1">Buscar</button>
        </div>
      </div>
    </form>

<?php

  if(isset($_POST['btn1'])) 
  {
  $doc = $_POST['doc'];
  if($doc=="") //VERIFICO QUE AGREGEN UN DOCUMENTO OBLIGATORIAMENTE.
  { echo "
    <div class='col-sm-4'>
    <label>&nbsp;
    </div>
    <h2 class='display-8'>RESULTADOS</h2>
    <div class='col-sm-6'>
    <label>Digita un número de documento por favor. (Ejemplo: 123)
    </div>
    ";
  }
  else
  {  
    $usuarios = $db_1->buscar_beneficiario("SP_resumen",$doc);
    if (empty($usuarios)) 
    {
      echo "
      <div class='col-sm-4'>
      <label>&nbsp;
      </div>
      <h2 class='display-8'>RESULTADOS</h2>
      <div class='col-sm-6'>
      <label>No existen datos para el documento ingresado.
      </div>
      ";
    } else 
    {
      foreach($usuarios as $consulta)
      {
      echo 
      "
      <div class='col-sm-4'>
      <label>&nbsp;
      </div>
      <h2 class='display-8'>RESULTADOS</h2>

      <div class='row'>
      <div class='col-sm-12 col-md-6 form-group'>
      <label for='disabledTextInput'>Nombre del Beneficiario</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[1]' disabled>
      </div>            
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>Género</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[2]' disabled>
      </div>  
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>Fecha de nacimiento</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[3]' disabled>
      </div>
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>Estado</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[4]' disabled>
      </div>
      </div>  
      <div class='row'>
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Número cédula</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[5]' disabled>
      </div>            
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Tipo identificación #2</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[6]' disabled>
      </div>  
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>Número cédula #2</label>
      <input type='text' class='form-control' placeholder='cedula_2' value='$consulta[7]' disabled>
      </div>
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>Celular #1</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[8]' disabled>
      </div>
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>Celular #2</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[9]' disabled>
      </div>    
      </div>  
      <div class='row'>
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Región</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[10]' disabled>
      </div>            
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Distrito</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[11]' disabled>
      </div>  
      <div class='col-sm-12 col-md-6 form-group'>
      <label for='disabledTextInput'>Dirección</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[12]' disabled>
      </div>
      </div>  
      <div class='row'>
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>¿Cuántos miembros viven o viajan con usted?</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[13]' disabled>
      </div>            
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>¿Está usted o alguien de su hogar con quien viaja o vive embarazada?</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[14]' disabled>
      </div>  
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>¿Cuánto tiempo de gestación tiene?</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[15]' disabled>
      </div>
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>Condición: Lactando con NN <2 años</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[16]' disabled>
      </div>    
      <div class='col-sm-12 col-md-2 form-group'>
      <label for='disabledTextInput'>Cond: No lactando con NN <2 años</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[17]' disabled>
      </div>      
      </div> 
      <div class='row'>
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Condición: <br>Madre de NN 2-5 años</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[18]' disabled>
      </div>            
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>¿Usted viaja o vive con niños de 5 a 17 años?</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[19]' disabled>
      </div>  
      <div class='col-sm-12 col-md-6 form-group'>
      <label for='disabledTextInput'>¿Usted o un miembro del hogar tiene alguna discapacidad o una enfermedad que no le permite trabajar?</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[20]' disabled>
      </div>        
      </div> 
      <div class='row'>
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Contamos con el programa de Nutrición, ¿Desea participar?</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[21]' disabled>
      </div>            
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Contamos con el programa de Salud, ¿Desea participar?</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[22]' disabled>
      </div>  
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Contamos con el programa Medios de vida, ¿Desea participar?</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[23]' disabled>
      </div>
      <div class='col-sm-12 col-md-3 form-group'>
      <label for='disabledTextInput'>Estado <br>Beneficiario</label>
      <input type='text' class='form-control' placeholder='' value='$consulta[24]' disabled>
      </div> 
      </div>   
      <div class='col-sm-4'>
      <label>&nbsp;
      <br><br>
      </div>            
      ";
      }
    }
  }
}
?>


<?php include("../template/pie.php"); ?>