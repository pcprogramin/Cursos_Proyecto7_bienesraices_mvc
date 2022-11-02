<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index (Router $router) {
        $propiedades = Propiedad::get(3);
        
        $router->render('paginas/index',[
            'propiedades'=> $propiedades,
            'inicio'=>true
        ]);
    }
    public static function nosotros (Router $router) {
        $router->render('paginas/nosotros');
    }
    public static function propiedades (Router $router) {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades',[
            'propiedades'=> $propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);
        incluirTemplates('header');
        $router->render('paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog');
    }
    public static function entrada (Router $router){
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router){
        $mensaje = null;
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $respuestas = $_POST['contacto'];

            $mail = new PHPMailer();

            //Configurar SMTP
            $mail -> isSMTP();
            $mail ->Host = "smtp.mailtrap.io";
            $mail ->SMTPAuth = true;
            $mail ->Username ='42ecb99068a6e3';
            $mail ->Password ='007708b06995f7';
            $mail ->SMTPSecure ='tls';
            $mail ->Port=2525;

            //Configurar Contenido de mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('pchaparrog55@gmail.com','BienesRaices.com');
            $mail->Subject = "Tienes un nuevo mensaje";

            $mail->isHTML(true);
            $mail->CharSet='UTF-8';

            $contenido  ="<html>";
            $contenido .="<p>Tienes un nuevo mensaje</p>";
            $contenido .="<p>Nombre:".$respuestas['nombre']." </p>";
            $contenido .="<p>Mensaje:".$respuestas['mensaje']." </p>";
            

            if($respuestas['contacto']== "telefono"){
                $contenido .="<p>Eligo ser contactado por telefono: </p>";
                $contenido .="<p>Telefono:".$respuestas['telefono']." </p>";
                $contenido .="<p>Fecha de Conctato :".$respuestas['fecha']." </p>";
                $contenido .="<p>Hora de Conctato :".$respuestas['hora']." </p>";
            }else{
                $contenido .="<p>Eligo ser contactado por email: </p>";
                $contenido .="<p>Email:".$respuestas['email']." </p>";
            }
            $contenido .="<p>Vende o Compra:".$respuestas['tipo']." </p>";
            $contenido .="<p>Precio o Presupuesto:".$respuestas['precio']."€ </p>";
            $contenido .="<p>Prefiere ser contactado por:".$respuestas['contacto']." </p>";
            $contenido .="</html>";
            $mail->Body = $contenido;
            $mail->AllBody = "Texto alternativo sin configurar";
            if($mail->send()){
                $mensaje = "Mensaje enviado correctamente";
            }else{
                $mensaje = "El mensaje no se pudo enviar";
            }
        }
        $router->render('paginas/contacto',[
            'mensaje'=> $mensaje,
        ]);
    }
}