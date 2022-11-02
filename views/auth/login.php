<main class="contenedor seccion  contenido-centrado">
    <h1>Iniciar Sesión</h1>
    <?php 
        foreach ($errores as $error):
    ?>
    <div class="alerta error">
            <?php echo $error; ?>
    </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Passord</legend>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="Tu mail" require>
            <label for="password">Password:</label>
            <input type="password" name= "password" id="password" placeholder="Tu contraseña" require>
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>