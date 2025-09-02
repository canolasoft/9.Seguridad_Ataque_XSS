<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Victima</title>
</head>

<body class="bg-warning bg-opacity-75">
    <div class="container mt-5 bg-light rounded p-5 col-lg-6">
        <h1>Sitio web vulnerable</h1>
        <p id="msg"></p>
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
</body>

</html>