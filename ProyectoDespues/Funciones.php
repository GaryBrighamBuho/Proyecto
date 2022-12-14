<?php
//Separa el codigo y el  nombre del alumno en 3 columnas(Partes)
function AlumnosTresColumnas($dataset) {
    $nuevaLista = array();
    $token = strtok($dataset, "\n\t");
    while($token != false) {
        $P_Parte1 = (string)$token;
        $P_Parte2 = (string)$token;
        $P_Parte3 = (string)$token;

        $S_Parte1 = ProcesarParte1($P_Parte1);
        $S_Parte2 = ProcesarParte2($P_Parte2);
        $S_Parte3 = ProcesarParte3($P_Parte3);

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
/* Separar los datos del docente en tres columnas*/

function DocentesTresColumnas($dataset) {
$nuevaLista = array();
    $token = strtok($dataset, "\n\t");
    while($token != false) {
        $P_Parte1 = (string)$token;
        $P_Parte2 = (string)$token;
        $P_Parte3 = (string)$token;

        $S_Parte1 = ProcesarParte1($P_Parte1);
        $S_Parte2 = ProcesarParte2($P_Parte2);
        $S_Parte3 = ProcesarParte3($P_Parte3);

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

function AlumnosDosColumnas($dataset) {
    $nuevaLista = array();
    $token = strtok($dataset, "\n\t");
    while($token != false) {
        $P_Parte1 = (string)$token;
        $P_Parte2 = (string)$token;

        $S_Parte1 = ProcesarParte1($P_Parte1);
        $S_Parte2 = ProcesarParte3($P_Parte2);

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

        $S_Parte1 = ProcesarParte1($P_Parte1);
        $S_Parte2 = ProcesarParte3($P_Parte2);

        $T_Parte1 = (integer)$S_Parte1;
        $T_Parte2 = (integer)$S_Parte2;

        $nuevaLista[$S_Parte1] = $S_Parte2; 
        $token = strtok("\n\t");
    }
    return $nuevaLista;
}

/* Procesar por Columnas(Partes)*/

function ProcesarParte1($string) {
    $cod = "";
    for ($i = 0; $i < strlen($string); $i++) {
        if($string[$i] == ",") {
            return $cod;
        }
        $cod = $cod.$string[$i];
    }
}

function ProcesarParte2($string) {
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

function ProcesarParte3($string) {
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
    foreach ($ListaTotal as $clave => $valor) {
        if($CodEstudiante == $clave) {
            return true;
        }
    }
    return false;
}

/* =========== Diferencia Listas =========== */
function CompararListas($ListaTutorados,$ListaUniversal)
{
    $ListaAlumnosSinTutor=array();
    foreach ($ListaTutorados as $clave => $valor) {
        $Revision=RevisarCodigo($ListaUniversal,$clave);
        if(!$Revision)
        {
            $ListaAlumnosSinTutor[$clave]=$valor;
        } 
    }
    return $ListaAlumnosSinTutor;
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

        $S_Parte1 = ProcesarParte1($P_Parte1);
        $S_Parte2 = ProcesarParte3($P_Parte2);

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
    foreach ($Docentes as $clave => $valor) {
        $prom = $prom + count($valor);
    }
    $prom = $prom / 36;
    $ListaNuevosAlumnos = array(); 
    foreach ($postAlumnos as $clave => $valor) {
        array_push($ListaNuevosAlumnos,$clave);
    }
    $aux = 0;
    while(count($ListaNuevosAlumnos)>0) {
        foreach ($Docentes as $clave => $valor) {
            if($prom >= count($valor)) {

                array_push($valor,$ListaNuevosAlumnos[$aux]);
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
    foreach ($Docentes as $clave => $valor) {
        $ListaCompleta[$clave] = ": DOCENTE";
        echo "<br>".$cont;
        for ($i = 0; $i < count($valor); $i++) { 
            $ListaCompleta[$cont] = $valor[$i];
            $cont++;
        }
    }
    return $ListaCompleta;
}

?>