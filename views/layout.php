<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;
if (!isset($inicio)) {
    $inicio = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bines Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="/build/img/logo.svg">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncio</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php
            echo $inicio ? "<h1>Ventas de Casas y Departamentos Exclusivos de Lujos</h1>" : "";
            ?>
        </div>
    </header>
    <?php
    echo $contenido;
    ?>
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncio</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
            <p class="copyright">Todos los dercho reservado <?php date('Y') ?> &copy;</p>
        </div>
    </footer>
    <script src="../build/js/bundle.min.js"></script>
</body>

</html>