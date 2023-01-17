<?php include("../administrador/template/cabecera.php"); ?>

<?php

//require_once './administrador/config/bd.php';
require_once ('../administrador/config/bdPDO.php');

$db_1 = new TransactionSCI();
//$conn_1 = $db_1->Connect();
//echo $insertId;

//require_once ('../vendor/autoload.php');

?>

<div class="col-md-12">
  <div class="card text-dark bg-light">
    <div class="card-header">
      Reportes de Control - Número de infantes menores de 18 años por genero, rango de edad y regiones
    </div>
    <div class="card-body">
      <!--form method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data"-->
      <div class="row">
        <div class="col-md-3">
          <select name="selecttam" id="departamento" class="form-control-lg">
            <option value="" disabled selected>Seleccione región</option>
            <?php 
            $datos = $db_1->traer_regiones();
            foreach($datos as $value) { ?>
              <option value="<?php echo $value['region']; ?>"><?php echo $value['region'];?></option>
            <?php } ?>
          </select>                
        </div>
        <div class="col-md-3">
          <select name="selectsit" id="situacion" class="form-control-lg">
            <option value="" disabled selected>Seleccione situación</option>
            <option value="Transito">Tránsito</option>
            <option value="Estadia">Estadía</option>
          </select>                
        </div>        
        <div class="col-md-3" aria-label="Basic example">
          <button class="btn btn-success btn-lg" onclick="CargarDatosGraficoBarParametro('SP_reporte_08_cantidad_menores')">Graficar datos</button>
        </div>
        <div class="col-md-3" aria-label="Basic example">
          <button class="btn btn-success btn-lg" onclick="CargarDatosTabla('SP_reporte_08_cantidad_menores_00')">Datos en Tabla</button>
        </div>                
      </div>
      <br>
      <div class="row">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-6">
          <canvas id="myCharBarParam" width="100" height="75"></canvas>
        </div>
        <div class="col-md-3">&nbsp;</div>
      </div>
      <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10" id="myDataTable">
          <div class="col-md-1">&nbsp;</div>
        </div>        
      </div>
      <div class="row">
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-10" id="myTableData">
          <div class="col-md-1">&nbsp;</div>
        </div>        
      </div>
      <!--/form-->
    </div>
    <br>
  </div>

</div>
</div>

<script>

  let myChart;
  let numSpan = 0;
  let numSpan1 = 0;
  let numSpan2 = 0;
  
  function CargarDatosGraficoBarParametro(storedprocedure){
    var region = $("#departamento").val();
    var situacion = $("#situacion").val();
    $.ajax({
      url:'controlador_grafico_parametro.php',
      type:'POST',
      data:{
        dato_region:region,
        dato_situacion:situacion,
        dato_sp:storedprocedure
      }
    }).done(function(resp){
      var titulo = [];
      var cantidad_1 = [];
      var cantidad_2 = [];
      var cantidad_3 = [];
      var cantidad_4 = [];
      var cantidad_5 = [];
      var colores = [];
      var data = JSON.parse(resp);
      for (var i = 0; i < data.length; i++) {
        titulo.push(data[i]['genero']);
        cantidad_1.push(data[i]['0-6 meses']);
        cantidad_2.push(data[i]['7-24 meses']);
        cantidad_3.push(data[i]['25-48 meses']);
        cantidad_4.push(data[i]['5-12 años']);
        cantidad_5.push(data[i]['13-17 años']);
        colores.push(colorRGB());
      }
      document.getElementById("myDataTable").style.display = 'none';
      document.getElementById("myTableData").style.display = 'none';                  
      pintarGrafico('bar',titulo,cantidad_1,cantidad_2,cantidad_3,cantidad_4,cantidad_5,colores,'x','# de beneficiarios por regiones','myCharBarParam')
    })
  }

  function CargarDatosTabla(storedprocedure){ 
    var situacion = $("#situacion").val();       
    //var region = $("#departamento").val();
    $.ajax({
      url:'controlador_grafico_sin_parametro.php',
      type:'POST',
      data:{
        dato_situacion:situacion,
        dato_sp:storedprocedure
      }
    }).done(function(resp){
      var col = [];
      var data = JSON.parse(resp);
      //var tableBody = document.getElementById("myDataTable");
      for (var i = 0; i < data.length; i++) {
        for (var key in data[i]) {
          if (col.indexOf(key) === -1) {
            col.push(key);
          }
        }
      }
       // CREATE DYNAMIC TABLE.
       var table = document.createElement("table");
       table.className = 'table table-striped table-bordered table-condensed';

      // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.
      var tr = table.insertRow(-1);                   // TABLE ROW.
      for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
          }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < data.length; i++) {
          tr = table.insertRow(-1);
          for (var j = 0; j < col.length; j++) {
            var tabCell = tr.insertCell(-1);
            tabCell.innerHTML = data[i][col[j]];
          }
        }
        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        //var divContainer = document.getElementById("myDataTable");
        if (typeof situacion !== 'undefined') {
          if (situacion=="Transito") {
            var divContainer = document.getElementById("myTableData");
            if( numSpan1 == 0 ){
              divContainer.append(table);
              numSpan1 += 1;
            }
            document.getElementById("myTableData").style.display = 'block';
            document.getElementById("myDataTable").style.display = 'none';
          } else if (situacion=="Estadia"){
            var divContainer = document.getElementById("myDataTable");
            if( numSpan2 == 0 ){
              divContainer.append(table);
              numSpan2 += 1;
            }
            document.getElementById("myDataTable").style.display = 'block';
            document.getElementById("myTableData").style.display = 'none';
          }
        }        
        //ctx = divContainer.getContext('2d');

        //divContainer.innerHTML = "";
        //divContainer.appendChild(table);
        /*if( numSpan == 0 ){
          divContainer.append(table);
          numSpan += 1;
        }*/
        //console.log(numSpan)
      })
  }  

  function pintarGrafico(tipo,titulo,c1,c2,c3,c4,c5,colores,tipoAxis,encabezado,id){
    const ctx = document.getElementById(id);
    /* El bloque if solo se utilizara si queremos pintar varios graficos en la misma pagina. antes de dibujar un nuevo grafico, se valida si existe previamente, si es asi se elimina y se dibija el nuevo grafico.*/

    if (myChart) {
      myChart.destroy();
    }
    myChart = new Chart(ctx, {
      type: tipo,      
      data: {
        labels: titulo,
        datasets: [
        {
          axis: tipoAxis,
          label: '0-6 meses',
          data: c1,
          backgroundColor: ['rgba(54, 162, 235, 0.2)'],
          borderColor: ['rgba(54, 162, 235, 1)'],
          borderWidth: 1,
          stack: 'Stack 0',
        },
        {
          axis: tipoAxis,
          label: '7-24 meses',
          data: c2,
          backgroundColor: ['rgba(255, 99, 132, 0.2)'],
          borderColor: ['rgba(255, 99, 132, 1)'],
          borderWidth: 1,
          stack: 'Stack 1',
        },
        {
          axis: tipoAxis,
          label: '25-48 meses',
          data: c3,
          backgroundColor: ['rgba(75, 192, 192, 0.2)'],
          borderColor: ['rgba(75, 192, 192, 1)'],
          borderWidth: 1,
          stack: 'Stack 2'
        },
        {
          axis: tipoAxis,
          label: '5-12 años',
          data: c4,
          backgroundColor: ['rgba(255, 205, 86, 0.2)'],
          borderColor: ['rgba(255, 205, 86, 1)'],
          borderWidth: 1,
          stack: 'Stack 3'
        },
        {
          axis: tipoAxis,
          label: '13-17 años',
          data: c5,
          backgroundColor: ['rgba(255, 159, 64, 0.2)'],
          borderColor: ['rgba(255, 159, 64, 1)'],
          borderWidth: 1,
          stack: 'Stack 4'
        }        
        ]
      },
      plugins: [ChartDataLabels],
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Número de NNA por Genero y Rango de Edad'
          },
        },

        indexAxis: tipoAxis,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

  function generarNumero(numero){
    return (Math.random()*numero).toFixed(0);
  }

  function colorRGB(){
    var coolor = "("+generarNumero(255)+"," + generarNumero(255) + "," + generarNumero(255) +")";
    return "rgb" + coolor;
  }   
</script>

<?php include("../administrador/template/pie.php"); ?>