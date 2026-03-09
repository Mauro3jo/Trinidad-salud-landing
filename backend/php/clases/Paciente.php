<?php
require_once "Usuario.php"; // Importar la clase base

class Paciente extends Usuario
{
  protected $id;
  private $id_historia;
  private $obraSocial;
  private $codigo;
  private $afiliado;
  private $parentesco;
  private $observaciones;
  private $sexo;
  private $fechaNacimiento;
  //private $primeraConsulta;
  private $atencionMedica;
  private $cirugia;
  private $fiebre;
  private $afCardiacas;
  private $presionAlta;
  private $infecciones;
  private $alergias;
  private $asma;
  private $diabetes;
  private $sida;
  private $hepatitis;
  private $artritis;
  private $ulcera;
  private $renales;
  private $tuberculosis;
  private $venereas;
  private $hemofilia;
  private $tumores;
  private $epilepsia;
  private $sinusitis;
  private $hemorragia;
  private $otras;
  private $aspirinas;
  private $embarazo;
  private $problemasDentales;
  private $fuma;
  private $medicamento;
  private $medicDetalle;
  private $enfermedad;
  private $enfermedadDetalle;

  // Constructor
  public function __construct($id_historia)
  {
    // Llamada al constructor de la clase base (Usuario)
    parent::__construct($id_historia);

    // Conexión a la base de datos (asumiendo una conexión PDO)
    // require("../../../backend/bd/conexion.php");

    $dir2 = str_repeat("../", $_SESSION['dir2']);
    require("$dir2/backend/bd/conexion.php");

    // Consulta a la base de datos
    $stmt = $connect->prepare("SELECT * FROM historia_clinica WHERE id_historia = :id_usuario");
    $stmt->bindParam(':id_usuario', $id_historia, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener los datos de la base de datos
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Asignar los valores a los atributos de la clase
    if ($data) {
      $this->id = $data['id'];
      $this->id_historia = $data['id_historia'];
      $this->obraSocial = $data['obraSocial'];
      $this->codigo = $data['codigo'];
      $this->afiliado = $data['afiliado'];
      $this->parentesco = $data['parentesco'];
      $this->sexo = $data['sexo'];
      $this->fechaNacimiento = $data['fechaNacimiento'];
      //$this->primeraConsulta = $data['primeraConsulta'];
      $this->observaciones = $data['observaciones'];
      //Aquí comienzan los checklist
      $this->atencionMedica = $data['atencionMedica'];
      $this->cirugia = $data['cirugia'];
      $this->fiebre = $data['fiebre'];
      $this->afCardiacas = $data['afCardiacas'];
      $this->presionAlta = $data['presionAlta'];
      $this->infecciones = $data['infecciones'];
      $this->alergias = $data['alergias'];
      $this->asma = $data['asma'];
      $this->diabetes = $data['diabetes'];
      $this->sida = $data['sida'];
      $this->hepatitis = $data['hepatitis'];
      $this->artritis = $data['artritis'];
      $this->ulcera = $data['ulcera'];
      $this->renales = $data['renales'];
      $this->tuberculosis = $data['tuberculosis'];
      $this->venereas = $data['venereas'];
      $this->hemofilia = $data['hemofilia'];
      $this->tumores = $data['tumores'];
      $this->epilepsia = $data['epilepsia'];
      $this->sinusitis = $data['sinusitis'];
      $this->hemorragia = $data['hemorragia'];
      $this->otras = $data['otras'];
      $this->aspirinas = $data['aspirinas'];
      $this->embarazo = $data['embarazo'];
      $this->problemasDentales = $data['problemasDentales'];
      $this->fuma = $data['fuma'];
      $this->medicamento = $data['medicamento'];
      $this->medicDetalle = $data['medicDetalle'];
      $this->enfermedad = $data['enfermedad'];
      $this->enfermedadDetalle = $data['enfermedadDetalle'];
    }
  }

  // Getters
  public function getId()
  {
    return $this->id;
  }
  public function getId_Historia()
  {
    return $this->id_historia;
  }
  public function getObraSocial()
  {
    return $this->obraSocial;
  }
  public function getCodigo()
  {
    return $this->codigo;
  }
  public function getAfiliado()
  {
    return $this->afiliado;
  }
  public function getParentesco()
  {
    return $this->parentesco;
  }
  public function getSexo()
  {
    return $this->sexo;
  }
  public function getFechaNacimiento()
  {
    return $this->fechaNacimiento;
  }
  // public function getPrimeraConsulta()
  // {
  //   return $this->primeraConsulta;
  // }
  public function getObservaciones()
  {
    return $this->observaciones;
  }
  public function getAtencionMedica()
  {
    return $this->atencionMedica;
  }
  public function getCirugia()
  {
    return $this->cirugia;
  }
  public function getFiebre()
  {
    return $this->fiebre;
  }
  public function getAfCardiacas()
  {
    return $this->afCardiacas;
  }
  public function getPresionAlta()
  {
    return $this->presionAlta;
  }
  public function getInfecciones()
  {
    return $this->infecciones;
  }
  public function getAlergias()
  {
    return $this->alergias;
  }
  public function getAsma()
  {
    return $this->asma;
  }
  public function getDiabetes()
  {
    return $this->diabetes;
  }
  public function getSida()
  {
    return $this->sida;
  }
  public function getHepatitis()
  {
    return $this->hepatitis;
  }
  public function getArtritis()
  {
    return $this->artritis;
  }
  public function getUlcera()
  {
    return $this->ulcera;
  }
  public function getRenales()
  {
    return $this->renales;
  }
  public function getTuberculosis()
  {
    return $this->tuberculosis;
  }
  public function getVenereas()
  {
    return $this->venereas;
  }
  public function getHemofilia()
  {
    return $this->hemofilia;
  }
  public function getTumores()
  {
    return $this->tumores;
  }
  public function getEpilepsia()
  {
    return $this->epilepsia;
  }
  public function getSinusitis()
  {
    return $this->sinusitis;
  }
  public function getHemorragia()
  {
    return $this->hemorragia;
  }
  public function getOtras()
  {
    return $this->otras;
  }
  public function getMedicamento()
  {
    return $this->medicamento;
  }
  public function getMedicDetalle()
  {
    return $this->medicDetalle;
  }
  public function getAspirinas()
  {
    return $this->aspirinas;
  }
  public function getEmbarazo()
  {
    return $this->embarazo;
  }
  public function getProblemasDentales()
  {
    return $this->problemasDentales;
  }
  public function getFuma()
  {
    return $this->fuma;
  }
  public function getEnfermedad()
  {
    return $this->enfermedad;
  }
  public function getEnfermedadDetalle()
  {
    return $this->enfermedadDetalle;
  }

  // Setters
  public function setId_Historia($id_historia)
  {
    $this->id_historia = $id_historia;
  }
  public function setObraSocial($obraSocial)
  {
    $this->obraSocial = $obraSocial;
  }
  public function setCodigo($codigo)
  {
    $this->codigo = $codigo;
  }
  public function setAfiliado($afiliado)
  {
    $this->afiliado = $afiliado;
  }
  public function setParentesco($parentesco)
  {
    $this->parentesco = $parentesco;
  }
  public function setSexo($sexo)
  {
    $this->sexo = $sexo;
  }
  public function setFechaNacimiento($fechaNacimiento)
  {
    $this->fechaNacimiento = $fechaNacimiento;
  }
  // public function setPrimeraConsulta($primeraConsulta)
  // {
  //   $this->primeraConsulta = $primeraConsulta;
  // }
  public function setObservaciones($observaciones)
  {
    $this->observaciones = $observaciones;
  }
  public function setAtencionMedica($atencionMedica)
  {
    $this->atencionMedica = $atencionMedica;
  }
  public function setCirugia($cirugia)
  {
    $this->cirugia = $cirugia;
  }
  public function setFiebre($fiebre)
  {
    $this->fiebre = $fiebre;
  }
  public function setAfCardiacas($afCardiacas)
  {
    $this->afCardiacas = $afCardiacas;
  }
  public function setPresionAlta($presionAlta)
  {
    $this->presionAlta = $presionAlta;
  }
  public function setInfecciones($infecciones)
  {
    $this->infecciones = $infecciones;
  }
  public function setAlergias($alergias)
  {
    $this->alergias = $alergias;
  }
  public function setAsma($asma)
  {
    $this->asma = $asma;
  }
  public function setDiabetes($diabetes)
  {
    $this->diabetes = $diabetes;
  }
  public function setSida($sida)
  {
    $this->sida = $sida;
  }
  public function setHepatitis($hepatitis)
  {
    $this->hepatitis = $hepatitis;
  }
  public function setArtritis($artritis)
  {
    $this->artritis = $artritis;
  }
  public function setUlcera($ulcera)
  {
    $this->ulcera = $ulcera;
  }
  public function setRenales($renales)
  {
    $this->renales = $renales;
  }
  public function setTuberculosis($tuberculosis)
  {
    $this->tuberculosis = $tuberculosis;
  }
  public function setVenereas($venereas)
  {
    $this->venereas = $venereas;
  }
  public function setHemofilia($hemofilia)
  {
    $this->hemofilia = $hemofilia;
  }
  public function setTumores($tumores)
  {
    $this->tumores = $tumores;
  }
  public function setEpilepsia($epilepsia)
  {
    $this->epilepsia = $epilepsia;
  }
  public function setSinusitis($sinusitis)
  {
    $this->sinusitis = $sinusitis;
  }
  public function setHemorragia($hemorragia)
  {
    $this->hemorragia = $hemorragia;
  }
  public function setOtras($otras)
  {
    $this->otras = $otras;
  }
  public function setMedicamento($medicamento)
  {
    $this->medicamento = $medicamento;
  }
  public function setMedicDetalle($medicDetalle)
  {
    $this->medicDetalle = $medicDetalle;
  }
  public function setAspirinas($aspirinas)
  {
    $this->aspirinas = $aspirinas;
  }
  public function setEmbarazo($embarazo)
  {
    $this->embarazo = $embarazo;
  }
  public function setProblemasDentales($problemasDentales)
  {
    $this->problemasDentales = $problemasDentales;
  }
  public function setFuma($fuma)
  {
    $this->fuma = $fuma;
  }
  public function setEnfermedad($enfermedad)
  {
    $this->enfermedad = $enfermedad;
  }
  public function setEnfermedadDetalle($enfermedadDetalle)
  {
    $this->enfermedadDetalle = $enfermedadDetalle;
  }

  // METODOS FUNCIONALES

  // Guardar los datos de la historia clínica en la base de datos
  public function guardarHistoria()
  {
    // Conexión a la base de datos (asumiendo una conexión PDO)
    require("../../../backend/bd/conexion.php");

    try {
      // Preparar la consulta SQL para insertar o actualizar los datos
      $stmt = $connect->prepare(
        "INSERT INTO historia_clinica (
                id_historia, obraSocial, codigo, afiliado, parentesco, sexo, fechaNacimiento, 
                observaciones, atencionMedica, fiebre, afCardiacas, 
                presionAlta, infecciones, alergias, asma, diabetes, sida, hepatitis, 
                artritis, ulcera, renales, tuberculosis, venereas, hemofilia, tumores, 
                epilepsia, sinusitis, hemorragia, otras, medicamento, medicDetalle, 
                aspirinas, embarazo, problemasDentales, fuma, enfermedad, enfermedadDetalle
            ) VALUES (
                :id_historia, :obraSocial, :codigo, :afiliado, :parentesco, :sexo, :fechaNacimiento, 
                :observaciones, :atencionMedica, :fiebre, :afCardiacas, 
                :presionAlta, :infecciones, :alergias, :asma, :diabetes, :sida, :hepatitis, 
                :artritis, :ulcera, :renales, :tuberculosis, :venereas, :hemofilia, :tumores, 
                :epilepsia, :sinusitis, :hemorragia, :otras, :medicamento, :medicDetalle, 
                :aspirinas, :embarazo, :problemasDentales, :fuma, :enfermedad, :enfermedadDetalle
            ) "
      );

      // Asignar los valores de los atributos a los parámetros de la consulta
      //$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
      $stmt->bindParam(':id_historia', $this->id_historia);
      $stmt->bindParam(':obraSocial', $this->obraSocial);
      $stmt->bindParam(':codigo', $this->codigo);
      $stmt->bindParam(':afiliado', $this->afiliado);
      $stmt->bindParam(':parentesco', $this->parentesco);
      $stmt->bindParam(':sexo', $this->sexo);
      $stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
      $stmt->bindParam(':observaciones', $this->observaciones);
      $stmt->bindParam(':atencionMedica', $this->atencionMedica);
      $stmt->bindParam(':fiebre', $this->fiebre);
      $stmt->bindParam(':afCardiacas', $this->afCardiacas);
      $stmt->bindParam(':presionAlta', $this->presionAlta);
      $stmt->bindParam(':infecciones', $this->infecciones);
      $stmt->bindParam(':alergias', $this->alergias);
      $stmt->bindParam(':asma', $this->asma);
      $stmt->bindParam(':diabetes', $this->diabetes);
      $stmt->bindParam(':sida', $this->sida);
      $stmt->bindParam(':hepatitis', $this->hepatitis);
      $stmt->bindParam(':artritis', $this->artritis);
      $stmt->bindParam(':ulcera', $this->ulcera);
      $stmt->bindParam(':renales', $this->renales);
      $stmt->bindParam(':tuberculosis', $this->tuberculosis);
      $stmt->bindParam(':venereas', $this->venereas);
      $stmt->bindParam(':hemofilia', $this->hemofilia);
      $stmt->bindParam(':tumores', $this->tumores);
      $stmt->bindParam(':epilepsia', $this->epilepsia);
      $stmt->bindParam(':sinusitis', $this->sinusitis);
      $stmt->bindParam(':hemorragia', $this->hemorragia);
      $stmt->bindParam(':otras', $this->otras);
      $stmt->bindParam(':medicamento', $this->medicamento);
      $stmt->bindParam(':medicDetalle', $this->medicDetalle);
      $stmt->bindParam(':aspirinas', $this->aspirinas);
      $stmt->bindParam(':embarazo', $this->embarazo);
      $stmt->bindParam(':problemasDentales', $this->problemasDentales);
      $stmt->bindParam(':fuma', $this->fuma);
      $stmt->bindParam(':enfermedad', $this->enfermedad);
      $stmt->bindParam(':enfermedadDetalle', $this->enfermedadDetalle);

      // Ejecutar la consulta
      $stmt->execute();
      echo "Datos guardados exitosamente.";
    } catch (PDOException $e) {
      echo "Error al guardar los datos: " . $e->getMessage();
    }
  }

  //Actualizar los datos de la historia clínica en la base de datos
  public function actualizarHistoria()
  {
    // Conexión a la base de datos (asumiendo una conexión PDO)
    require("../../../backend/bd/conexion.php");

    try {
      // Preparar la consulta SQL para actualizar los datos
      $stmt = $connect->prepare(
        "UPDATE historia_clinica SET
                obraSocial = :obraSocial,
                codigo = :codigo,
                afiliado = :afiliado,
                parentesco = :parentesco,
                sexo = :sexo,
                fechaNacimiento = :fechaNacimiento,
                observaciones = :observaciones,
                atencionMedica = :atencionMedica,
                fiebre = :fiebre,
                afCardiacas = :afCardiacas,
                presionAlta = :presionAlta,
                infecciones = :infecciones,
                alergias = :alergias,
                asma = :asma,
                diabetes = :diabetes,
                sida = :sida,
                hepatitis = :hepatitis,
                artritis = :artritis,
                ulcera = :ulcera,
                renales = :renales,
                tuberculosis = :tuberculosis,
                venereas = :venereas,
                hemofilia = :hemofilia,
                tumores = :tumores,
                epilepsia = :epilepsia,
                sinusitis = :sinusitis,
                hemorragia = :hemorragia,
                otras = :otras,
                medicamento = :medicamento,
                medicDetalle = :medicDetalle,
                aspirinas = :aspirinas,
                embarazo = :embarazo,
                problemasDentales = :problemasDentales,
                fuma = :fuma,
                enfermedad = :enfermedad,
                enfermedadDetalle = :enfermedadDetalle
            WHERE id_historia = :id_historia"
      );

      // Asignar los valores de los atributos a los parámetros de la consulta
      $stmt->bindParam(':id_historia', $this->id_historia);
      $stmt->bindParam(':obraSocial', $this->obraSocial);
      $stmt->bindParam(':codigo', $this->codigo);
      $stmt->bindParam(':afiliado', $this->afiliado);
      $stmt->bindParam(':parentesco', $this->parentesco);
      $stmt->bindParam(':sexo', $this->sexo);
      $stmt->bindParam(':fechaNacimiento', $this->fechaNacimiento);
      $stmt->bindParam(':observaciones', $this->observaciones);
      $stmt->bindParam(':atencionMedica', $this->atencionMedica);
      $stmt->bindParam(':fiebre', $this->fiebre);
      $stmt->bindParam(':afCardiacas', $this->afCardiacas);
      $stmt->bindParam(':presionAlta', $this->presionAlta);
      $stmt->bindParam(':infecciones', $this->infecciones);
      $stmt->bindParam(':alergias', $this->alergias);
      $stmt->bindParam(':asma', $this->asma);
      $stmt->bindParam(':diabetes', $this->diabetes);
      $stmt->bindParam(':sida', $this->sida);
      $stmt->bindParam(':hepatitis', $this->hepatitis);
      $stmt->bindParam(':artritis', $this->artritis);
      $stmt->bindParam(':ulcera', $this->ulcera);
      $stmt->bindParam(':renales', $this->renales);
      $stmt->bindParam(':tuberculosis', $this->tuberculosis);
      $stmt->bindParam(':venereas', $this->venereas);
      $stmt->bindParam(':hemofilia', $this->hemofilia);
      $stmt->bindParam(':tumores', $this->tumores);
      $stmt->bindParam(':epilepsia', $this->epilepsia);
      $stmt->bindParam(':sinusitis', $this->sinusitis);
      $stmt->bindParam(':hemorragia', $this->hemorragia);
      $stmt->bindParam(':otras', $this->otras);
      $stmt->bindParam(':medicamento', $this->medicamento);
      $stmt->bindParam(':medicDetalle', $this->medicDetalle);
      $stmt->bindParam(':aspirinas', $this->aspirinas);
      $stmt->bindParam(':embarazo', $this->embarazo);
      $stmt->bindParam(':problemasDentales', $this->problemasDentales);
      $stmt->bindParam(':fuma', $this->fuma);
      $stmt->bindParam(':enfermedad', $this->enfermedad);
      $stmt->bindParam(':enfermedadDetalle', $this->enfermedadDetalle);

      // Ejecutar la consulta
      $stmt->execute();
      echo "Datos actualizados exitosamente.";
    } catch (PDOException $e) {
      echo "Error al actualizar los datos: " . $e->getMessage();
    }
  }

  public function crearOdontograma($id_usuario){
    
    // Conexión a la base de datos (asumiendo una conexión PDO)
    require("../../../backend/bd/conexion.php");

    try {
      // Verificar si ya existe un odontograma para este usuario
      $checkSql = "SELECT COUNT(*) FROM odontogramas WHERE id_usuario = :id_usuario";
      $checkStmt = $connect->prepare($checkSql);
      $checkStmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
      $checkStmt->execute();
      $exists = $checkStmt->fetchColumn(); // Obtiene el número de registros que coinciden

      if ($exists > 0) {
        // Si ya existe, no se realiza el INSERT
        $_SESSION['msg'] = "Ya existe un odontograma registrado para el usuario con ID: $id_usuario";
        $_SESSION['color'] = "danger";
      } else {
        // Si no existe, se realiza el INSERT
        $sql = "INSERT INTO odontogramas (id_usuario) VALUES (:id_usuario)";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();        
      }
      
      $_SESSION['msg'] = "Odontograma creado exitosamente para el usuario con ID: $id_usuario";
      $_SESSION['color'] = "success";

    } catch (PDOException $e) {
      // Manejo de errores
      echo "Error en la operación: " . $e->getMessage();
    }



  }

}
