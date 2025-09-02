<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <title>Victima</title>
</head>

<body class="bg-warning bg-opacity-75">
    <div class="container mt-5 bg-light rounded p-5 col-lg-6">
        <!-- Boton de Login -->
        <button class="btn btn-lg btn-warning text-dark mx-auto mb-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            Login
        </button>
        <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
            </svg>
            Sitio web vulnerable
        </h1>
        <p>
            Este sitio contiene una sección de comentarios y una vulnerabilidad crítica: no depura los datos ingresados.
            <br>
            Esto permite a los atacantes inyectar código javascript malicioso en un comentario que luego será ejecutado por el sitio al mostrarlo.
        </p>
        <h3>Deja un comentario</h3>
        <form action="index.php" method="POST">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" class="form-control mt-2" required>
            <label for="comentario">Comentario: </label>
            <textarea name="comentario" id="comentario" class="form-control mt-2" required></textarea>
            <button class="btn btn-warning mt-2" type="submit">Enviar</button>
        </form>

        <?php
        if (isset($_POST["comentario"])) {
            try {
                $usr_name = $_POST["nombre"];
                $comentario = $_POST["comentario"];
                $file = fopen("archivo.txt", "a");
                fwrite($file, $usr_name . "/separador/" . $comentario . PHP_EOL);
                fclose($file);
            } catch (mysqli_sql_exception $e) {
                echo "Error en la base de datos: " . $e->getMessage();
            }
        ?>
            <h1>Nuevo comentario</h1>
            <div id="comentarios">
                <p><?php echo "<pre>" . print_r($_POST) . "</pre>"; ?></p>
            </div>
        <?php
        }
        ?>

        <hr>
        <h2>Comentarios</h2>
        <div id="nuevo-comentario">
            <?php
            $file = fopen("archivo.txt", "r");
            while (!feof($file)) {
                $line = fgets($file);
                if ($line) {
                    // divido la linea por "/separador/"
                    list($nombre, $comentario) = explode("/separador/", $line);
                    echo "<strong>" . $nombre . ":</strong>";
                    echo "<p>" . $comentario . "</p>";
                }
            }
            fclose($file);
            ?>
        </div>
    </div>
        <!-- Modal Login -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form>
                            <h3>Inicio de sesión</h3>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Recordarme</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>