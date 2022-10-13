<?php



class TransactionSCI 
{

private $DB_HOST = 'localhost'; //localhost server 
private $DB_NAME = 'bd_bha_sci'; //database name
private $DB_USER = 'root'; //database username
private $DB_PASSWORD = ''; //database password 

	/**
     * PDO instance
     * @var PDO 
     */
	private $pdo;
	//private $conn;

  	/**
     * Open the database connection
     */
  	public function __construct() {
  		$this->Connect();  	 

  	}

  	public function Connect() {
  	    // open database connection
  		$dsn = 'mysql:host=' . $this->DB_HOST . ';dbname=' . $this->DB_NAME;
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');            
  		//echo "Connected successfully";  		

        try {
           $this->pdo = new PDO($dsn, $this->DB_USER, $this->DB_PASSWORD, $opciones);
       } catch (PDOException $e) {
           die($e->getMessage());
       }
   }

    /**
     * Transfer money between two accounts
     * @param int $from
     * @param int $to
     * @param float $amount
     * @return true on success or false on failure.
     */
    public function transfer($from, $to, $amount) {

    	try {
    		$this->pdo->beginTransaction();

            // get available amount of the transferer account
    		$sql = 'SELECT amount FROM accounts WHERE id=:from';
    		$stmt = $this->pdo->prepare($sql);
    		$stmt->execute(array(":from" => $from));
    		$availableAmount = (int) $stmt->fetchColumn();
    		$stmt->closeCursor();

    		if ($availableAmount < $amount) {
    			echo 'Insufficient amount to transfer';
    			return false;
    		}
            // deduct from the transferred account
    		$sql_update_from = 'UPDATE accounts
    		SET amount = amount - :amount
    		WHERE id = :from';
    		$stmt = $this->pdo->prepare($sql_update_from);
    		$stmt->execute(array(":from" => $from, ":amount" => $amount));
    		$stmt->closeCursor();

            // add to the receiving account
    		$sql_update_to = 'UPDATE accounts
    		SET amount = amount + :amount
    		WHERE id = :to';
    		$stmt = $this->pdo->prepare($sql_update_to);
    		$stmt->execute(array(":to" => $to, ":amount" => $amount));

            // commit the transaction
    		$this->pdo->commit();

    		echo 'The amount has been transferred successfully';

    		return true;
    	} catch (PDOException $e) {
    		$this->pdo->rollBack();
    		die($e->getMessage());
    	}
    }

    public function prueba(){
    	if (!$pdo) {
    		die("Connection failed: " . mysqli_connect_error());
    	}
    	echo "Connected successfully....";
    }


    public function limpiarStage($sp,$usuario) {
    	try {
            // calling stored procedure command
    		$sql = "CALL " . $sp . "('".$usuario."',@total)";
    		// prepare for execution of the stored procedure
    		$stmt = $this->pdo->prepare($sql);
    		// execute the stored procedure
    		$stmt->execute();
    		$stmt->closeCursor();
        	 // execute the second query to get customer's level
    		$row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
    		if ($row) {
    			return $row !== false ? $row['resultado'] : null;
    		}
    		//echo 'La operación se realizo satisfactoriamente';
    		return true;
    	} catch (PDOException $e) {    		
    		die("Error ocurrido:" . $e->getMessage());
    	}
    	return null;
    }

    public function limpiarStageDataProyecto($sp) {
        try {
            // calling stored procedure command
            $sql = "CALL " . $sp . "(@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            }
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function limpiarDataKobo($sp,$usuario) {
        try {               
            // calling stored procedure command
            $sql = "CALL " . $sp . "('".$usuario."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function validarDataGerencia($sp, $campo) {
        try {               
            // calling stored procedure command
            $sql = "CALL " . $sp . "('".$campo."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row['resultado'] == 0 ? 0 : $row['resultado'];
            } 
            //return $row ;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function select_repo($sp,$usuario) {
        try {               
            // calling stored procedure command
            //$sql = 'CALL SP_SelectDocIdentConIncidencias()';
            $sql = "CALL " . $sp . "('".$usuario."')";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();            
            $stmt->closeCursor();
            return $data;
            
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function select_repo_all($sp, $depa) {
        try {               
            // calling stored procedure command
            //$sql = 'CALL SP_SelectDocIdentConIncidencias()';
            $sql = "CALL " . $sp . "('".$depa."')";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();            
            $stmt->closeCursor();
            return $data;
            
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }    

    public function select_repo_gerencia($sp) {
        try {               
            // calling stored procedure command
            $sql = "CALL " . $sp . "()";
            //$sql = "select * from " .$vista. ";";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();
            $stmt->closeCursor();
            return $data;
            
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function select_repo_gerencia_gestante($sp, $gestante) {
        try {               
            // calling stored procedure command
            //$sql = "CALL " . $sp . "()";
            $sql = "CALL " . $sp . "(".$gestante.")";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();
            $stmt->closeCursor();
            return $data;
            
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }    

    public function select_periodos_data_gerencia() {
        try {               
            //$sql = "select * from vista_periodos_data_proyectos;";
            $sql = "select * from vista_periodo_y_proyecto_migracion_stage_data_proyecto;";
            $stmt = $this->pdo->prepare($sql);                  
            $stmt->execute();
            $data=$stmt->fetchAll();
            $stmt->closeCursor();
            return $data;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function incidencia_Nombres($sp,$usuario) {
        try {               
            // calling stored procedure command
            //$sql = 'CALL SP_SelectNombresConDigitos()';
            $sql = "CALL " . $sp . "('".$usuario."')";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();            
            $stmt->closeCursor();
            return $data;
            
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

// STORED PARA ACTUALIZAR LA INFORMACION DEL STAGE DATA HISTORICA

    public function limpiar_DH($sp,$usuario) {
        try {               
            // calling stored procedure command
            $sql = "CALL " . $sp . "('".$usuario."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row['resultado'] == 1 ? 1 : 0;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            //die("Error ocurrido: " . $e->getMessage());
            return false;
        }
        return null;
    }

// FUNCION PARA MIGRAR LOS DATOS A PARA ACTUALIZAR LA INFORMACION DEL STAGE DATA HISTORICA
    public function cotejo($idBusqueda,$usuario) {
        $cadena=null;
        $tipo='';
        $cod_origen=0;
        try {
            $array = array();
            $contPrinc = 1;
            $contSecund = 1;

            $sql = "CALL SP_SelectCotejo('".$usuario."')";
            // call the stored procedure
            $q = $this->pdo->prepare($sql);            
            $q->execute();
            //$q->setFetchMode(PDO::FETCH_ASSOC); 
            $lista = $q->fetchAll();
            $q->closeCursor();

            foreach($lista as $usuario) {
                for ($i = 0; $i < 4; $i++) {
                    if ($i!=1) {
                        if ($usuario[$i]!=null) {
                            $cadena .= "+" . $usuario[$i] . "* ";

                        }
                    }
                }
                // GUARDANDO EL CASO DE BUSQUEDA
                $nulo = "Dato Fuente";
                $tipo = "Nombre";
                $sql1 = 'CALL SP_InsertResultadoCotejo(:id_busqueda, :id_caso, :id_result, :id_tipo, :nomb_1, :nomb_2, :ape_1, :ape_2, :tipo_doc, :numero_doc, :proyecto, :cod_familia )';
                // prepare for execution of the stored procedure
                $stmt = $this->pdo->prepare($sql1);
                // pass value to the command
                $stmt->bindParam(':id_busqueda', $idBusqueda, PDO::PARAM_INT);
                $stmt->bindParam(':id_caso', $contPrinc, PDO::PARAM_INT);
                $stmt->bindParam(':id_result', $cod_origen, PDO::PARAM_INT);
                $stmt->bindParam(':id_tipo', $nulo, PDO::PARAM_STR);
                $stmt->bindParam(':nomb_1', $usuario[0], PDO::PARAM_STR);
                $stmt->bindParam(':nomb_2', $usuario[1], PDO::PARAM_STR);
                $stmt->bindParam(':ape_1', $usuario[2], PDO::PARAM_STR);
                $stmt->bindParam(':ape_2', $usuario[3], PDO::PARAM_STR);
                $stmt->bindParam(':tipo_doc', $usuario[4], PDO::PARAM_STR);
                $stmt->bindParam(':numero_doc', $usuario[5], PDO::PARAM_STR);
                $stmt->bindParam(':proyecto', $nulo, PDO::PARAM_STR);
                $stmt->bindParam(':cod_familia', $usuario[7], PDO::PARAM_STR);
                // execute the stored procedure
                $stmt->execute();
                $stmt->closeCursor();
                // REALIZANDO LA BUSQUEDA FULLTEXT POR NOMBRE
                $sql = "SELECT id_dh, nombre_1, nombre_2, apellido_1, apellido_2, tipo_documento, numero_documento, proyecto, cod_familia, MATCH(beneficiario, numero_documento) AGAINST('".$cadena."') as relevancia FROM data_historica WHERE MATCH(beneficiario, numero_documento) AGAINST('" . $cadena . "' IN BOOLEAN MODE)";
                // call the stored procedure
                $q = $this->pdo->prepare($sql);            
                $q->execute();                
                $resultado = $q->fetchAll();
                $q->closeCursor();
                // GUARDANDO EL RESULTADO DE LA BUSQUEDA
                foreach($resultado as $usu) {
                    $sql1 = 'CALL SP_InsertResultadoCotejo(:id_busqueda, :id_caso, :id_result, :id_tipo, :nomb_1, :nomb_2, :ape_1, :ape_2, :tipo_doc, :numero_doc, :proyecto, :cod_familia )';
                    // prepare for execution of the stored procedure
                    $stmt = $this->pdo->prepare($sql1);
                    // pass value to the command
                    $stmt->bindParam(':id_busqueda', $idBusqueda, PDO::PARAM_INT);
                    $stmt->bindParam(':id_caso', $contPrinc, PDO::PARAM_INT);
                    $stmt->bindParam(':id_result', $contSecund, PDO::PARAM_INT);
                    $stmt->bindParam(':id_tipo', $tipo, PDO::PARAM_STR);
                    $stmt->bindParam(':nomb_1', $usu[1], PDO::PARAM_STR);
                    $stmt->bindParam(':nomb_2', $usu[2], PDO::PARAM_STR);
                    $stmt->bindParam(':ape_1', $usu[3], PDO::PARAM_STR);
                    $stmt->bindParam(':ape_2', $usu[4], PDO::PARAM_STR);
                    $stmt->bindParam(':tipo_doc', $usu[5], PDO::PARAM_STR);
                    $stmt->bindParam(':numero_doc', $usu[6], PDO::PARAM_STR);
                    $stmt->bindParam(':proyecto', $usu[7], PDO::PARAM_STR);
                    $stmt->bindParam(':cod_familia', $usu[8], PDO::PARAM_STR);
                    // execute the stored procedure
                    $stmt->execute();
                    $stmt->closeCursor();                        
                    $contSecund++;
                }
                $cadena = "";
                $sql = "";
                $contPrinc++;
                $contSecund=1;
            }

            // BUSQUEDA FULLTEXT UTILIZANDO EL NUMERO DE DOCUMENTO
            $contPrinc = 1;
            $contSecund = 1000;
            $tipo = "Numero";
            foreach($lista as $usuario){                    
                // RECUPERANDO EL NUMERO DE DOCUMENTO
                //$cadena .= "+" . $usuario[5] . "* ";
                $cadena = $usuario[5];
                // REALIZANDO LA BUSQUEDA FULLTEXT POR NUMERO DOCUMENTO
                $sql = "SELECT id_dh, nombre_1, nombre_2, apellido_1, apellido_2, tipo_documento, numero_documento, proyecto, cod_familia, MATCH(beneficiario, numero_documento) AGAINST('".$cadena."') as relevancia FROM data_historica WHERE MATCH(beneficiario, numero_documento) AGAINST('" . $cadena . "' IN BOOLEAN MODE)";
                    // call the stored procedure
                $q = $this->pdo->prepare($sql);            
                $q->execute();
                    //$q->setFetchMode(PDO::FETCH_ASSOC); 
                $resultado = $q->fetchAll();
                $q->closeCursor();
                    // GUARDANDO EL RESULTADO DE LA BUSQUEDA
                foreach($resultado as $usu) {
                    $sql1 = 'CALL SP_InsertResultadoCotejo(:id_busqueda, :id_caso, :id_result, :id_tipo, :nomb_1, :nomb_2, :ape_1, :ape_2, :tipo_doc, :numero_doc, :proyecto, :cod_familia )';
                        // prepare for execution of the stored procedure
                    $stmt = $this->pdo->prepare($sql1);
                    // pass value to the command
                    $stmt->bindParam(':id_busqueda', $idBusqueda, PDO::PARAM_INT);
                    $stmt->bindParam(':id_caso', $contPrinc, PDO::PARAM_INT);
                    $stmt->bindParam(':id_result', $contSecund, PDO::PARAM_INT);
                    $stmt->bindParam(':id_tipo', $tipo, PDO::PARAM_STR);
                    $stmt->bindParam(':nomb_1', $usu[1], PDO::PARAM_STR);
                    $stmt->bindParam(':nomb_2', $usu[2], PDO::PARAM_STR);
                    $stmt->bindParam(':ape_1', $usu[3], PDO::PARAM_STR);
                    $stmt->bindParam(':ape_2', $usu[4], PDO::PARAM_STR);
                    $stmt->bindParam(':tipo_doc', $usu[5], PDO::PARAM_STR);
                    $stmt->bindParam(':numero_doc', $usu[6], PDO::PARAM_STR);
                    $stmt->bindParam(':proyecto', $usu[7], PDO::PARAM_STR);
                    $stmt->bindParam(':cod_familia', $usu[8], PDO::PARAM_STR);
                    // execute the stored procedure
                    $stmt->execute();
                    $stmt->closeCursor();
                    $contSecund++;
                }
                $cadena = "";
                $sql = "";
                $contPrinc++;
                $contSecund=1000;
            }
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }

    public function cotejoNuevoBeneficiario($idBusqueda,$usuario) {
        $cadena=null;
        $tipo='';
        $cod_origen=0;
        try {
            $array = array();
            $contPrinc = 1;
            $contSecund = 1;

            // $sql = "CALL SP_SelectCotejoNuevoBeneficiario('".$usuario."')"; solo INTEG.principal
            $sql = "CALL SP_SelectCotejoNuevoBeneficiario_mas_integranteshogar('".$usuario."')";
            // call the stored procedure
            $q = $this->pdo->prepare($sql);            
            $q->execute();
            //$q->setFetchMode(PDO::FETCH_ASSOC); 
            $lista = $q->fetchAll();
            $q->closeCursor();

            foreach($lista as $usu) {
                for ($i = 0; $i < 4; $i++) {
                    if ($i!=1) {
                        if ($usu[$i]!=null) {
                            $cadena .= "+" . $usu[$i] . "* ";
                        }
                    }
                }
                // GUARDANDO EL CASO DE BUSQUEDA
                $nulo = "Dato Fuente";
                $tipo = "Nombre";
                $vacio = "-";
                $codigofila = $usu[6];
                $sql1 = 'CALL SP_InsertResultadoCotejoNuevoBeneficiario(:id_busqueda, :id_caso, :id_result, :id_tipo, :nomb_1, :nomb_2, :ape_1, :ape_2, :tipo_doc, :numero_doc, :proyecto, :cod_familia, :id_stage_00 )';
                // prepare for execution of the stored procedure
                $stmt = $this->pdo->prepare($sql1);
                // pass value to the command
                $stmt->bindParam(':id_busqueda', $idBusqueda, PDO::PARAM_INT);
                $stmt->bindParam(':id_caso', $contPrinc, PDO::PARAM_INT);
                $stmt->bindParam(':id_result', $cod_origen, PDO::PARAM_INT);
                $stmt->bindParam(':id_tipo', $nulo, PDO::PARAM_STR);
                $stmt->bindParam(':nomb_1', $usu[0], PDO::PARAM_STR);
                $stmt->bindParam(':nomb_2', $usu[1], PDO::PARAM_STR);
                $stmt->bindParam(':ape_1', $usu[2], PDO::PARAM_STR);
                $stmt->bindParam(':ape_2', $usu[3], PDO::PARAM_STR);
                $stmt->bindParam(':tipo_doc', $usu[4], PDO::PARAM_STR);
                $stmt->bindParam(':numero_doc', $usu[5], PDO::PARAM_STR);
                $stmt->bindParam(':proyecto', $vacio, PDO::PARAM_STR);
                $stmt->bindParam(':cod_familia', $vacio, PDO::PARAM_STR);                
                $stmt->bindParam(':id_stage_00', $codigofila, PDO::PARAM_INT);
                // execute the stored procedure
                $stmt->execute();
                $stmt->closeCursor();

                // REALIZANDO LA BUSQUEDA FULLTEXT POR NOMBRE
                $sql = "SELECT id_dh, nombre_1, nombre_2, apellido_1, apellido_2, tipo_documento, numero_documento, proyecto, cod_familia, MATCH(beneficiario, numero_documento) AGAINST('".$cadena."') as relevancia FROM data_historica WHERE MATCH(beneficiario, numero_documento) AGAINST('" . $cadena . "' IN BOOLEAN MODE)";
                // call the stored procedure
                $q = $this->pdo->prepare($sql);            
                $q->execute();                
                $resultado = $q->fetchAll();
                $q->closeCursor();
                // GUARDANDO EL RESULTADO DE LA BUSQUEDA
                foreach($resultado as $usu_a) {
                    $sql1 = 'CALL SP_InsertResultadoCotejoNuevoBeneficiario(:id_busqueda, :id_caso, :id_result, :id_tipo, :nomb_1, :nomb_2, :ape_1, :ape_2, :tipo_doc, :numero_doc, :proyecto, :cod_familia, :id_stage_00 )';
                    // prepare for execution of the stored procedure
                    $stmt = $this->pdo->prepare($sql1);
                    // pass value to the command
                    $stmt->bindParam(':id_busqueda', $idBusqueda, PDO::PARAM_INT);
                    $stmt->bindParam(':id_caso', $contPrinc, PDO::PARAM_INT);
                    $stmt->bindParam(':id_result', $contSecund, PDO::PARAM_INT);
                    $stmt->bindParam(':id_tipo', $tipo, PDO::PARAM_STR);
                    $stmt->bindParam(':nomb_1', $usu_a[1], PDO::PARAM_STR);
                    $stmt->bindParam(':nomb_2', $usu_a[2], PDO::PARAM_STR);
                    $stmt->bindParam(':ape_1', $usu_a[3], PDO::PARAM_STR);
                    $stmt->bindParam(':ape_2', $usu_a[4], PDO::PARAM_STR);
                    $stmt->bindParam(':tipo_doc', $usu_a[5], PDO::PARAM_STR);
                    $stmt->bindParam(':numero_doc', $usu_a[6], PDO::PARAM_STR);
                    $stmt->bindParam(':proyecto', $usu_a[7], PDO::PARAM_STR);
                    $stmt->bindParam(':cod_familia', $usu_a[8], PDO::PARAM_STR);
                    $stmt->bindParam(':id_stage_00', $codigofila, PDO::PARAM_INT);
                    // execute the stored procedure
                    $stmt->execute();
                    $stmt->closeCursor();                        
                    $contSecund++;
                }
                $cadena = "";
                $sql = "";
                $contPrinc++;
                $contSecund=1;
            }

            // BUSQUEDA FULLTEXT UTILIZANDO EL NUMERO DE DOCUMENTO
            $contPrinc = 1;
            $contSecund = 1000;
            $tipo = "Numero";
            foreach($lista as $usu){                    
                // RECUPERANDO EL NUMERO DE DOCUMENTO
                //$cadena .= "+" . $usuario[5] . "* ";
                $cadena = $usu[5];
                $codigofila = $usu[6];
                // REALIZANDO LA BUSQUEDA FULLTEXT POR NUMERO DOCUMENTO
                $sql = "SELECT id_dh, nombre_1, nombre_2, apellido_1, apellido_2, tipo_documento, numero_documento, proyecto, cod_familia, MATCH(beneficiario, numero_documento) AGAINST('".$cadena."') as relevancia FROM data_historica WHERE MATCH(beneficiario, numero_documento) AGAINST('" . $cadena . "' IN BOOLEAN MODE)";
                    // call the stored procedure
                $q = $this->pdo->prepare($sql);            
                $q->execute();
                    //$q->setFetchMode(PDO::FETCH_ASSOC); 
                $resultado = $q->fetchAll();
                $q->closeCursor();
                    // GUARDANDO EL RESULTADO DE LA BUSQUEDA
                foreach($resultado as $usu_b) {
                    $sql1 = 'CALL SP_InsertResultadoCotejoNuevoBeneficiario(:id_busqueda, :id_caso, :id_result, :id_tipo, :nomb_1, :nomb_2, :ape_1, :ape_2, :tipo_doc, :numero_doc, :proyecto, :cod_familia, :id_stage_00 )';
                        // prepare for execution of the stored procedure
                    $stmt = $this->pdo->prepare($sql1);
                    // pass value to the command
                    $stmt->bindParam(':id_busqueda', $idBusqueda, PDO::PARAM_INT);
                    $stmt->bindParam(':id_caso', $contPrinc, PDO::PARAM_INT);
                    $stmt->bindParam(':id_result', $contSecund, PDO::PARAM_INT);
                    $stmt->bindParam(':id_tipo', $tipo, PDO::PARAM_STR);
                    $stmt->bindParam(':nomb_1', $usu_b[1], PDO::PARAM_STR);
                    $stmt->bindParam(':nomb_2', $usu_b[2], PDO::PARAM_STR);
                    $stmt->bindParam(':ape_1', $usu_b[3], PDO::PARAM_STR);
                    $stmt->bindParam(':ape_2', $usu_b[4], PDO::PARAM_STR);
                    $stmt->bindParam(':tipo_doc', $usu_b[5], PDO::PARAM_STR);
                    $stmt->bindParam(':numero_doc', $usu_b[6], PDO::PARAM_STR);
                    $stmt->bindParam(':proyecto', $usu_b[7], PDO::PARAM_STR);
                    $stmt->bindParam(':cod_familia', $usu_b[8], PDO::PARAM_STR);
                    $stmt->bindParam(':id_stage_00', $codigofila, PDO::PARAM_INT);
                    // execute the stored procedure
                    $stmt->execute();
                    $stmt->closeCursor();
                    $contSecund++;
                }
                $cadena = "";
                $sql = "";
                $contPrinc++;
                $contSecund=1000;
            }
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }

    public function resultado_cotejo($codigo) {
        try {               
            // calling stored procedure command
            //$sql = 'CALL SP_SelectNombresConDigitos()';
            $sql = "CALL SP_SelectResultadoCotejo(" . $codigo . ")";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();            
            $stmt->closeCursor();
            return $data;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
    }

    public function delete_resultado_cotejo($id) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_DeleteResultadoCotejo(".$id.")";
                // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
                // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
                // execute the second query to get customer's level
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
    }

    public function cotejoIncial($idBusqueda,$usuario) {
        $cadena=null;
        $tipo='';
        $cod_origen=0;
        try {
            $array = array();
            $contPrinc = 1;
            $contSecund = 1;

            $sql = "CALL SP_SelectCotejoInicial('".$usuario."')";
            // call the stored procedure
            $q = $this->pdo->prepare($sql);            
            $q->execute();
            $q->closeCursor();

        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
    }

    public function resultado_cotejoInicial($codigo) {
        try {               
            // calling stored procedure command
            //$sql = 'CALL SP_SelectNombresConDigitos()';
            $sql = "CALL SP_SelectResultadoCotejoInicial('".$codigo."')";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();            
            $stmt->closeCursor();
            return $data;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
    }

    public function delete_resultado_cotejoInicial($codigo) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_DeleteResultadoCotejoInicial('".$codigo."')";
                // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
                // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
                // execute the second query to get customer's level
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
    }

    public function login($usuario, $pass) {
        try {               
            $sql = "CALL SP_Login_validar('".$usuario."','".$pass."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());            
        }
        return $data;
    }

    public function select_rol($usuario) {
        try {               
            $sql = "CALL SP_user_rol('".$usuario."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());            
        }
        return $data;
    }

    public function update_observaciones($cod, $comentario) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_update_observaciones(".$cod.",'".$comentario."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            //echo 'La operación se realizo satisfactoriamente';
            return $row;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
    }

    public function select_usuarios() {
        try {               
            // calling stored procedure command
            //$sql = 'CALL SP_SelectNombresConDigitos()';
            $sql = "CALL SP_Usuarios_Select()";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();            
            $stmt->closeCursor();
            return $data;        
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
        }

    public function select_usuario($codigo) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_Usuario_Select(" . $codigo. ")";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $data=$stmt->fetchAll();            
            $stmt->closeCursor();
            return $data;        
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }    

    public function update_usuario($cod, $nombre, $correo, $idrol, $idestado) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_Usuario_Update(".$cod.",'".$nombre."','".$correo."',".$idrol.",".$idestado.",@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
    }

    public function insert_usuario($nombre, $correo, $idrol, $idestado) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_Usuario_Insert('".$nombre."','".$correo."','123456',".$idrol.",".$idestado.",@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
             // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            //return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
        }

    public function delete_usuario($id) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_Usuario_Delete(".$id.",@total)";
                // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
                // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
                // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            }             
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
            return null;
    }

    public function update_password($id,$clave) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_Usuario_Update_Password(".$id.",".$clave.",@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
            // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function reset_password($usu,$clave) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_Usuario_Reset_Password('".$usu."','".$clave."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
            // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }    

    public function migrar_data_historica($usuario) {
        try {               
            // calling stored procedure command
            $sql = "CALL SP_Migrar_Data_Historica('".$usuario."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
            // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row !== false ? $row['resultado'] : null;
            } 
            //echo 'La operación se realizo satisfactoriamente';
            return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function migrar_data_gerencia($accion, $anios) {
        try {               
            // calling stored procedure command
            //$sql = "CALL SP_Migrar_Data_Gerencia(@total)";
            $sql = "CALL SP_Migrar_Data_Gerencia(".$accion.",'".$anios."',@total)";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);                  
            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();
            // execute the second query to get customer's level
            $row = $this->pdo->query("SELECT @total AS resultado")->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                //return $row !== false ? $row['resultado'] : null;
                return $row !== 0 ? $row['resultado'] : 0;
            } 
                    //echo 'La operación se realizo satisfactoriamente';
            //return true;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return 0;
    }

    public function validar_fecha_espanol($fecha){
        $valores = explode('-', $fecha);
        if(count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])){
            return true;
        }
            return false;
    }

/*****************
 *  MODULO GERENCIA
 * ***************/
    public function traer_tema() {
        try {               
            // calling stored procedure command
            $sql = "call SP_list_tema();";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $arreglo;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

/*****************
 *  REPORTES
 * ***************/
    public function poblar_combobox($sp) {
        try {               
            // calling stored procedure command
            $sql = "CALL " .$sp. "();";
            //$sql = "call SP_reporte_regiones();";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $arreglo;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function traer_regiones() {
        try {               
            // calling stored procedure command
            $sql = "call SP_reporte_regiones();";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $arreglo;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function traer_datos_reporte() {
        try {               
            // calling stored procedure command
            //$arreglo = array();
            $sql = "call SP_reporte_00()";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);
            // execute the stored procedure
            $stmt->execute();
            //$stmt->closeCursor();
            //if ($sql){
            //if ($result = $stmt->execute()){
                //while($rows = $result->fetchAll(\PDO::FETCH_ASSOC)){
                $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //}
               return $arreglo;
           //}
            //}
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function traer_datos_reporte_sin_parametro($SP, $situacion) {
        try {               
            // calling stored procedure command
            //$arreglo = array();
            $sql = "CALL " .$SP. "('".$situacion."')";
            //$sql = "call SP_reporte_01_beneficiario_x_region_01('".$region."')";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);
            // execute the stored procedure
            $stmt->execute();
            $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $arreglo;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }

    public function traer_datos_reporte_parametro($SP, $region, $situacion) {
        try {               
            // calling stored procedure command
            //$arreglo = array();
            $sql = "CALL " .$SP. "('".$region."','".$situacion."')";
            //$sql = "call SP_reporte_01_beneficiario_x_region_01('".$region."')";
            // prepare for execution of the stored procedure
            $stmt = $this->pdo->prepare($sql);
            // execute the stored procedure
            $stmt->execute();
            $arreglo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $arreglo;
        } catch (PDOException $e) {         
            die("Error ocurrido:" . $e->getMessage());
        }
        return null;
    }



	/**
     * close the database connection
     */
	public function __destruct() {
        // close the database connection
		$this->pdo = null;
	}

}


?>