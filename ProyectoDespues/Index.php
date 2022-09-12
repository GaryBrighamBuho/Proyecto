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
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-body">
                    <h3 class="text-center"><aside> UNIVERSIDAD NACIONAL DE SAN ANTONIO ABAD DEL CUSCO</aside> </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class = "cold-md-12">
                <br>
                <h10> * ES OBLIGATORIO INGRESAR TODOS LOS CAMPOS <h10><br><br>
                <form action="Operaciones.php" method ="POST" enctype="multipart/form-data">
                    <h3>Lista de Alumnos Matriculados</h3>
                    <input type="file" class="form-control mb-3" name="Matriculados" >

                    <br>
                    <h3>Lista de docentes para el presente semestre.</h3>
                    <input type="file" class="form-control mb-3" name="Docentes" >

                    <br>
                    <h3>Distribución de tutorías del anterior semestre.</h3>
                    <input type="file" class="form-control mb-3" name="Tutorados" >
                    <br>
                    <input type="submit" name ="submit"  class="btn btn-primary"  value="Agregar">
                </form>
                
            </div> 
        </div>
    </div>  
    </body>
</html>