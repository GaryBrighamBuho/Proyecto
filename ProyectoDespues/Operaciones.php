<?php
if(empty($_FILES['Docentes']['name'])) {
    $nuevaURL="Main.php";
    header("Location: ".$nuevaURL);
}

include("MovimientoMetodos.php");
# ------------------ ALUMNOS MATRICULADOS ---------------------
$dataset_Matriculados = $_FILES["Matriculados"]["name"];
$dataset_auxMatriculados = $_FILES["Matriculados"]["tmp_name"];
$dataset_bugMatriculados = $_FILES["Matriculados"]["error"];

# --------------------- DOCENTES -----------------------
$dataset_Docentes = $_FILES["Docentes"]["name"];
$dataset_auxDocentes = $_FILES["Docentes"]["tmp_name"];
$dataset_bugDocentes = $_FILES["Docentes"]["error"];

# ------------- TUTORADOS --------------------
$dataset_Tutorados = $_FILES["Tutorados"]["name"];
$dataset_auxTutorados = $_FILES["Tutorados"]["tmp_name"];
$dataset_bugTutorados = $_FILES["Tutorados"]["error"];
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

$central = "MenuOp.php";
header("Location:".$central);
?>