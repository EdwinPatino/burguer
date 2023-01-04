<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use Resources\web\Contacto;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class ControladorWebContacto extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.contacto", compact('aSucursales'));
    }
    public function enviar(Request $request){
        $nombre = $request->input('txtNombre');
        $celular = $request->input('txtTelefono');
        $correo = $request->input('txtCorreo');
        $mensaje = $request->input('txtMensaje');

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSmtp();
        $mail->Host = env('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
        $mail->Port = env('MAIL_PORT');

        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress(env('MAIL_FROM_ADDRESS'));
        $mail->addReplyTo(env('MAIL_FROM_ADDRESS'));

        $mail ->isHTML(true);
        $mail->Subject = "Contacto desde la página web";
        $mail->Body = "Nombre: $nombre<br>
        Correo: $correo<br>
        Celular: $celular<br>
        Mensaje:<br>$mensaje";
        //$mail->send(); 

        return redirect("/confirmacion-envio");


}

}

