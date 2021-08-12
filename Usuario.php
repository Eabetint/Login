<?php
require_once('Connect.php');
class Usuario{

    private $id;
    public $email;
    public $password;
  

   public function __construct()
   {
    session_start();
   }

   
public function validar($email,$password)
{
  $conexion = new Connect();
        $connectar = $conexion->init();
        $query = $connectar->prepare("SELECT * FROM usuario
        WHERE email = :email AND Contrasena = :password");
        $query->bindParam(":email",$email);
        $query->bindParam(":password",$password);
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        print_r($usuario);
    if ($usuario) {
        // CREAMOS SESION
        $_SESSION['email'] =$usuario['email'];
        $_SESSION['id'] = $usuario['id'];
        header("Location: http://localhost:8888/clases_php/EjercicioPractico/Basesdedatos/inicio.php");
        
      } else {
        $msg = "Las credenciales ingresadas no coinciden";
        
        header("Location: http://localhost:8888/clases_php/EjercicioPractico/Basesdedatos/inicio.php");
      }
}

public function Cerrarsesion()
{
session_unset();
session_destroy();
header("Location: http://localhost:8888/clases_php/EjercicioPractico/Basesdedatos/inicio.php");

}


}
?>