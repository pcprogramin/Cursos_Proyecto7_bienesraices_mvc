<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null; 
        $router->render('propiedades/admin',[
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado'=>$resultado
        ]);
    }
    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){
            $propiedad->sincronizar($_POST['propiedad']);
            $nombreImagen = md5(uniqid(rand(),true)).".jpg";
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $image =Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad ->setImagen($nombreImagen);
                $image->save(CARPETA_IMAGENES.$nombreImagen);
            }
            $errores = $propiedad->validar();
            //Insertar en la Base de Datos
            if(empty($errores)){
                $resultado = $propiedad->guardar();
            }
        }            
                                       
        $router->render('/propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores'=> $vendedores,
            'errores'=> $errores,

        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){

            $propiedad->sincronizar($_POST['propiedad']);
            $errores = $propiedad->validar();
            $nombreImagen = md5(uniqid(rand(),true)).".jpg";
            
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                
                $image =Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad ->setImagen($nombreImagen);
                $image->save(CARPETA_IMAGENES.$nombreImagen);
            }
            //Insertar en la Base de Datos
            if(empty($errores)){
                
                $resultado = $propiedad->guardar();
            }
        }
        $router ->render('/propiedades/actualizar',[
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);

    }   
    public static function eliminar (){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id){
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}