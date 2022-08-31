
<?php

/* ============ cod y Alumno 3 ============ */

function AlumnosToThree($dataset) {
    $nuevaLista = array();
    $token = strtok($dataset, "\n\t");
    while($token != false) {
        $P_Parte1 = (string)$token;
        $P_Parte2 = (string)$token;
        $P_Parte3 = (string)$token;

        $S_Parte1 = ProcesarP1($P_Parte1);
        $S_Parte2 = ProcesarP2($P_Parte2);
        $S_Parte3 = ProcesarP3($P_Parte3);

        $T_Parte1 = (integer)$S_Parte1;
        $T_Parte2 = (integer)$S_Parte2;
        $T_Parte3 = (integer)$S_Parte3;

        if($T_Parte2 != 0 & $T_Parte3 == 0) {
            $nuevaLista[$S_Parte2] = $S_Parte3;
        }
        $token = strtok("\n\t");
    }
    return $nuevaLista;
}

/* =========== Docentes 3 =========== */

function DocentesToThree($dataset) {
$nuevaLista = array();
    $token = strtok($dataset, "\n\t");
    while($token != false) {
        $P_Parte1 = (string)$token;
        $P_Parte2 = (string)$token;
        $P_Parte3 = (string)$token;

        $S_Parte1 = ProcesarP1($P_Parte1);
        $S_Parte2 = ProcesarP2($P_Parte2);
        $S_Parte3 = ProcesarP3($P_Parte3);

        $T_Parte1 = (integer)$S_Parte1;
        $T_Parte2 = (integer)$S_Parte2;
        $T_Parte3 = (integer)$S_Parte3;

        if($T_Parte2 == 0 & $T_Parte3 == 0 & $T_Parte1 != 0) {
            $nuevaLista[$S_Parte2] = $S_Parte3;
        }
        $token = strtok("\n\t");
    }
    return $nuevaLista;
}

/* =========== Cod y Alumno 2 =========== */

function AlumnosToTwo($dataset) {
    $nuevaLista = array();
    $token = strtok($dataset, "\n\t");
    while($token != false) {
        $P_Parte1 = (string)$token;
        $P_Parte2 = (string)$token;

        $S_Parte1 = ProcesarP1($P_Parte1);
        $S_Parte2 = ProcesarP3($P_Parte2);

        $T_Parte1 = (integer)$S_Parte1;
        $T_Parte2 = (integer)$S_Parte2;

        if($T_Parte1 != 0 & $T_Parte2 == 0) {
            $nuevaLista[$S_Parte1] = $S_Parte2;
        }
        $token = strtok("\n\t");
    }
    return $nuevaLista;
}

/* =========== Datos de Tutorados =========== */

function Tutorados($dataset) {
    $nuevaLista = array();
    $token = strtok($dataset, "\n\t");
    while($token != false) {
        $P_Parte1 = (string)$token;
        $P_Parte2 = (string)$token;

        $S_Parte1 = ProcesarP1($P_Parte1);
        $S_Parte2 = ProcesarP3($P_Parte2);

        $T_Parte1 = (integer)$S_Parte1;
        $T_Parte2 = (integer)$S_Parte2;

        $nuevaLista[$S_Parte1] = $S_Parte2; 
        $token = strtok("\n\t");
    }
    return $nuevaLista;
}

/* =========== Procesar 1ra Parte =========== */

function ProcesarP1($string) {
    $cod = "";
    for ($i = 0; $i < strlen($string); $i++) {
        if($string[$i] == ",") {
            return $cod;
        }
        $cod = $cod.$string[$i];
    }
}

/* =========== Procesar 2da Parte =========== */

function ProcesarP2($string) {
    $aux = 0;
    $cod = "";
    for ($k = 0; $k < strlen($string); $k++)
    {
        if($string[$k] == ",") {
            if($aux == 1) {
                return $cod;
            }
            $cod = "";
            $aux++; 
        } else {
            $cod = $cod.$string[$k];
        }
    }
}

/* =========== Procesar 3ra Parte =========== */

function ProcesarP3($string) {
    $cod = "";
    for ($j = 0; $j < strlen($string); $j++) {
        if($string[$j] == ",") {
            $cod = "";
        } else {
            $cod = $cod.$string[$j];
        }   
    }
    return $cod;
}

/* =========== Revisar Codigo del Alumno =========== */

function RevisarCodigo($ListaTotal, $CodEstudiante) {
    foreach ($ListaTotal as $key => $value) {
        if($CodEstudiante == $key) {
            return true;
        }
    }
    return false;
}

/* =========== Diferencia Listas =========== */

function DiferenciaListas($Tutorados, $ListaGlobal) {
    $AlumnosSinTutor = array();
    foreach ($Tutorados as $key => $value) {
        $valor = RevisarCodigo($ListaGlobal,$key);
        if(!$valor) {
            $AlumnosSinTutor[$key] = $value;
        } 
    }
    return $AlumnosSinTutor;
}

/* =========== Regular Tutorados -> Docentes =========== */

function RegularTutoradosDocentes($Tutorados, $postAlumnos) {
    $Docentes = array();
    $Alumnos = array();
    $token = strtok($Tutorados, "\n\t");
    $cont = 0;
    $sum = 0;
    $docente = "";
    while($token != false) {   
        $P_Parte1 = (string)$token;
        $P_Parte2 = (string)$token;

        $S_Parte1 = ProcesarP1($P_Parte1);
        $S_Parte2 = ProcesarP3($P_Parte2);

        $T_Parte1 = (integer)$S_Parte1;
        $T_Parte2 = (integer)$S_Parte2;

        if($T_Parte1 != 0) {
            array_push($Alumnos, $T_Parte1);
        } else {
            if($cont != 0) {
                $Docentes[$Docente] = $Alumnos;
                $Alumnos = array();
                $sum = 1;
            }
            $Docente = $S_Parte2;
            $cont++;
        }
        $ListaTutoresConDocentes[$S_Parte1] = $S_Parte2; 
        $token = strtok("\n\t");
        $sum++;

    }

    if($cont - 1 == count($Docentes)) {
        $Docentes[$Docente] = $Alumnos;
    }

    $prom = 0;

    foreach ($Docentes as $key => $value) {
        $prom = $prom + count($value);
    }

    $prom = $prom / 36;

    $ListaNuevosAlumnos = array(); 
    foreach ($postAlumnos as $key => $value) {
        array_push($ListaNuevosAlumnos,$key);
    }

    $aux = 0;

    while(count($ListaNuevosAlumnos)>0) {
        foreach ($Docentes as $key => $value) {
            if($prom >= count($value)) {

                array_push($value,$ListaNuevosAlumnos[$aux]);
                unset($ListaNuevosAlumnos[$aux]);
                $aux++;
            }
            if(count($ListaNuevosAlumnos) == 0) {
                break;
            }     
        }
    }

    $ListaCompleta = array();
    $cont = 0;
    foreach ($Docentes as $key => $value) {
        $ListaCompleta[$key] = ": DOCENTE";
        echo "<br>".$cont;
        for ($i = 0; $i < count($value); $i++) { 
            $ListaCompleta[$cont] = $value[$i];
            $cont++;
        }
    }
    return $ListaCompleta;
}

?>
<?php
if(empty($_FILES['Docentes2022']['name'])) {
    $nuevaURL="Main.php";
    header("Location: ".$nuevaURL);
}


# ------------------ ALUMNOS MATRICULADOS ---------------------
$dataset_Matriculados = $_FILES["Matriculados2022"]["name"];
$dataset_auxMatriculados = $_FILES["Matriculados2022"]["tmp_name"];
$dataset_bugMatriculados = $_FILES["Matriculados2022"]["error"];

# --------------------- DOCENTES -----------------------
$dataset_Docentes = $_FILES["Docentes2022"]["name"];
$dataset_auxDocentes = $_FILES["Docentes2022"]["tmp_name"];
$dataset_bugDocentes = $_FILES["Docentes2022"]["error"];

# ------------- TUTORADOS --------------------
$dataset_Tutorados = $_FILES["Tutorados2021"]["name"];
$dataset_auxTutorados = $_FILES["Tutorados2021"]["tmp_name"];
$dataset_bugTutorados = $_FILES["Tutorados2021"]["error"];




if($dataset_bugDocentes == 0 & $dataset_bugMatriculados == 0 & $dataset_bugTutorados == 0)
{
    $dataset_preMatriculados = explode(".",$dataset_Matriculados);
    $dataset_preDocentes = explode(".",$dataset_Docentes);
    $dataset_preTutorados = explode(".",$dataset_Tutorados);

    $dataset_preMatriculados = strtolower(end($dataset_preMatriculados));
    $dataset_preDocentes = strtolower(end($dataset_preDocentes));
    $dataset_preTutorados = strtolower(end($dataset_preTutorados));

    $dataset_postMatriculados = uniqid("",true).".txt";
    $dataset_postDocentes = uniqid("",true).".txt";
    $dataset_postTutorados = uniqid("",true).".txt";
    
    $raiz_archivo = "TempFile/";
    if (!file_exists($raiz_archivo))
    {
        mkdir($raiz_archivo, 0777, true);
    }


    $pathMatriculados = "TempFile/".$dataset_postMatriculados;
    $pathDocentes = "TempFile/".$dataset_postDocentes;
    $pathTutorados = "TempFile/".$dataset_postTutorados;

    move_uploaded_file($dataset_auxMatriculados, $pathMatriculados);
    move_uploaded_file($dataset_auxDocentes, $pathDocentes);
    move_uploaded_file($dataset_auxTutorados, $pathTutorados);     
}

$ListaAlumnos = "";
$ListaDocentes = "";
$ListaTutorados = "";

$archivo_matriculados = fopen($pathMatriculados,"r") or die("Error al abrir");
while(!feof($archivo_matriculados))
{
    $give = fgets($archivo_matriculados);
    $breakline = nl2br($give);
    $palabra = utf8_encode( $breakline);
    $ListaAlumnos = $ListaAlumnos.$palabra;
}
$archivo_docente=fopen($pathDocentes,"r") or die("Error al abrir");
while(!feof($archivo_docente))
{
    $give = fgets($archivo_docente);
    $breakline1 = nl2br($give);
    $palabra = utf8_encode( $breakline1);
    $ListaDocentes = $ListaDocentes.$palabra;
}
$archivo_Tuto=fopen($pathTutorados,"r") or die("Error al abrir");
while(!feof($archivo_Tuto))
{
    $give = fgets($archivo_Tuto);
    $breakline1 = nl2br($give);
    $palabra = utf8_encode( $breakline1);
    $ListaTutorados = $ListaTutorados.$palabra;
}

/* ============ PROGRAMA PRINCIPAL ============ */

$Matriculados = AlumnosToThree($ListaAlumnos);
$Profesores = DocentesToThree($ListaDocentes);
$Tutores = Tutorados($ListaTutorados);
$AlumnosTutores = AlumnosToTwo($ListaTutorados);
$Final = DiferenciaListas($AlumnosTutores,$Matriculados);

/* ============ Alumnos Nuevos ============ */

$NuevosAlumnos = DiferenciaListas($Matriculados,$AlumnosTutores);

$NuevosTutorados = RegularTutoradosDocentes($ListaTutorados,$NuevosAlumnos);
session_start();
$_SESSION["ListaAlumnos"] = $Matriculados;
$_SESSION["ListaDocentes"] = $Profesores;
$_SESSION["ListaTutorados"] = $Tutores;
$_SESSION["listaDeNoConsiderados"] = $Final;
$_SESSION["NuevosTutorados"] = $NuevosTutorados;

$central = "Menu_2.php";
header("Location:".$central);
?>