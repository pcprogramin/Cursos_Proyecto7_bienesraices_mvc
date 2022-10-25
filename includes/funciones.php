<?php
    define('TEMPLATES_URL',__DIR__.'\templates\\');
    define('FUNCIONES_URL',__DIR__.'funciones.php');
    define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT']."/imagenes/");
  
    

    function incluirTemplates( string $nombre , bool $inicio = false ){
        include TEMPLATES_URL."${nombre}.php";
    }
    function estarAutenticado (){
        session_start();
        
        if ( !$_SESSION['login']) {
            debuger($_SESSION['login']);
            header('Location:/');
        }
    }

    function debuger ($object){
        echo "<pre>";
        var_dump($object);
        echo "</pre>";
        exit;
    }
    function s($html) : string{
        $s=htmlspecialchars($html);
        return $s;
    }

    function validarTipoContenido($tipo){
        $tipos=['vendedor','propiedad'];
        return in_array($tipo,$tipos);
    }
    function mostrarNotificacion($codigo){
        $mensaje='';
        switch ($codigo){
            case 1:
                $mensaje="Creado correctamente";
                break;
            case 2:
                $mensaje="Actualizado correctamente";
                break;
            case 3:
                $mensaje = "Eliminado Correctamente";
                break;
            default:
                $mensaje=false;
                break;
        }
        return $mensaje;
    }
function validarORedireccionar (string $url){
    $id = $_GET['id'];
    $id = filter_var($id,FILTER_VALIDATE_INT);
    if(!$id){
        header("Location: ${url}");
    }
    return $id;
}