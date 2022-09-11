<!DOCTYPE html>
<html lang="en">
    <head>
        <title> PAGINA DOCENTE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        
</head>

<body>
<div class="container mt-5">
    <form action = "Alumnos.php">
        <h3>DISTRIBUCION BALANCEADA DE TUTORANDOS</h3>
        <a href="MenuOperaciones.php"  class="btn btn-danger btn-lg btn-block">Regresar</a>
    </form>
    <table class="table table-sm table-bordered table-dark" >
        <thead class="table-success table-dark table-bordered " >
            <tr>
                <th>Codigo</th>
                <th>NOMBRE</th>
            </tr>
        </thead>
        <tbody>
            <?php echo "<br><br>";
                    session_start();
                    $ListaAlumnosNuevos=$_SESSION["NuevosTutorados"];
                    $ListaAlumnosAnteriores=$_SESSION["ListaAlumnos"];
                    include("Funciones.php");
                    foreach ($ListaAlumnosNuevos as $clave => $valor) {
                        if($valor==": DOCENTE"){
                            ?>
                            <tr>
                                <th><?php  echo $clave;   ?></th>
                                <th><?php  echo $valor;  ?></th>
                            </tr>
                            <?php
                        }
                        foreach($ListaAlumnosAnteriores as $clave2 =>$valor2){
                            if($valor==$clave2){ 
            ?>
            <tr>
                <th><?php  echo $valor;  ?></th>
                <th><?php  echo $valor2;  ?></th>
            </tr>
            <?php } } }?>
        </tbody>
    </table>
</div>  
</body>
</html>