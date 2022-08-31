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
                <h3>DISTRIBUCION BALANCEADA DE TUTORANDOS 2022-I</h3>
                <a href="Menu_2.php"  class="btn btn-danger btn-lg btn-block">Regresar</a>
                
            </form>
            <table class="table table-sm table-bordered table-dark" >
                <thead class="table-success table-dark table-bordered " >
                    <tr>
                        <th>DOCENTE</th>
                        <th>ALUMNO</th>
                        <th>NOMBRE</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php echo "<br><br>";
                            session_start();
                            $ListaAlumnos=$_SESSION["NuevosTutorados"];
                            $ListaAlumnos2=$_SESSION["ListaAlumnos"];

                            foreach ($ListaAlumnos as $key => $value) {
                                if($value==": DOCENTE"){
                                    ?>
                                    <tr>
                                        <th><?php  echo $key;   ?></th>
                                        <th><?php  echo $value;  ?></th>
                                        <th><?php  echo $value;  ?></th>
                                    </tr>
                                    <?php
                                }
                                foreach($ListaAlumnos2 as $key2 =>$value2){
                                    if($value==$key2){

                                
                    ?>
                    <tr>
                        <th><?php  echo $key;   ?></th>
                        <th><?php  echo $value;  ?></th>
                        <th><?php  echo $value2;  ?></th>
                    </tr>
                    <?php } } }?>
                </tbody>
            </table>
        

</div>  
</body>
</html>