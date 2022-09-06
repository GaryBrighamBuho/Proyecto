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
                <h3>ALUMNOS NO CONSIDERADOS EN TUTORIA 2022-I</h3>
                <a href="Menu_2.php"  class="btn btn-danger btn-lg btn-block">Regresar</a>
                
            </form>
            <table class="table table-sm table-bordered table-dark" >
                <thead class="table-success table-dark table-bordered " >
                    <tr>
                        <th>#</th>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php echo "<br><br>";
                            session_start();
                            $ListaAlumnos=$_SESSION["listaDeNoConsiderados"];

        
                            $i=1;
                            foreach ($ListaAlumnos as $key => $value) {

                    ?>
                    <tr>
                        <th><?php  echo $i;  ?> </th>
                        <th><?php  echo $key;   ?></th>
                        <th><?php  echo $value;  ?></th>
                    </tr>
                    <?php $i++;} ?>
                </tbody>
            </table>

</div>  
</body>
</html>