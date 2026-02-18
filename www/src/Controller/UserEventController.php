<?php
namespace src\Controller;

use src\Model\UserEvent;
use src\Services\JwtService;

class UserEventController extends AbstractController
{
    public function loginEvent(){
        if(isset($_POST["email"]) && isset($_POST["password"])){
            $user = UserEvent::sqlGetByMail($_POST["email"]);
            if($user != null){
                if(password_verify($_POST["password"], $user->getPassword())){
                    $token = bin2hex(random_bytes(16));
                    $_SESSION['token'] = $token;
                    $_SESSION["login"] = [
                        "Email" => $user->getEmail(),
                        "Roles" => $user->getRoles(),
                    ];
                    header("Location:/AdminEvent/listEvents");
                }
                else{
                    throw new \Exception("Mot de passe incorrect pour {$_POST["mail"]}");
                }
            }
            else{
                throw new \Exception("Aucun user avec ce mail en base");
            }
        }
        return $this->twig->render("user/loginEvent.html.twig");
    }

    public static function haveGoodRole(array $goodRole)
    {
        if(!isset($_SESSION["login"])){
            throw new \Exception("Vous devez vous authentifier pour accéder à cette page");
        }

        $roleFound = false;
        foreach ($_SESSION["login"]["Roles"] as $role){
            if(in_array($role, $goodRole)){
                $roleFound = true;
                break;
            }
        }
        if(!$roleFound){
            throw new \Exception("Vous n'avez pas le bon role pour accéder à cette page");
        }
    }

    public function logoutEvent(){
        unset($_SESSION["login"]);
        header("Location:/AdminEvent/listEvents");
        exit();
    }

    public function createAccount(){
        if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["roles"])){
            $user = new UserEvent();
            $hash = password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost"=>12]);
            $user->setEmail($_POST["email"])
                ->setPassword($hash)
                ->setNom($_POST["nom"])
                ->setPrenom($_POST["prenom"])
                ->setRoles($_POST["roles"]);
            $id = UserEvent::SqlAdd($user);
            header("Location:/UserEvent/loginEvent");
            exit();
        }
        else{
            return $this->twig->render("user/createAccount.html.twig");
        }
    }

    public function loginjwt()
    {
        header("Content-Type: application/json; charset=utf-8");

        if($_SERVER["REQUEST_METHOD"] != "POST"){
            header("HTTP/1.1 405 Method Not Allowed");
            return json_encode([
                "code" => 1,
                "Message" => "POST Attendu"
            ]);
        }

        //Récupération du body en String
        $data = file_get_contents("php://input");
        //Conversion du string en JSON
        $json = json_decode($data);

        if(empty($json)){
            header("HTTP/1.1 403 Forbiden");
            return json_encode([
                "code" => 1,
                "Message" => "Il faut des données"
            ]);
        }

        if(!isset($json->email) || !isset($json->password)){
            header("HTTP/1.1 403 Forbiden");
            return json_encode([
                "code" => 1,
                "Message" => "Il manque le mail ou le password"
            ]);
        }
        // Récupérer les info de l'utilisateur par son mail
        $user = UserEvent::SqlGetByMail($json->email);
        if($user == null){
            header("HTTP/1.1 403 Forbiden");
            return json_encode([
                "code" => 1,
                "Message" => "User inexistant"
            ]);
        }

        // Comparer le mot de pase avec celui hashé en bdd
        if(!password_verify($json->password, $user->getPassword())){
            header("HTTP/1.1 403 Forbiden");
            return json_encode([
                "code" => 1,
                "Message" => "Mot de passe invalide"
            ]);
        }

        // Retourne JWT
        $token = JwtService::createToken([
            "email" => $user->getEmail(),
            "roles" => $user->getRoles()
        ]);

        // On affiche le JSON et on STOPPE tout le reste
        echo json_encode([
            "success" => true,
            "data" => [
                "token" => $token
            ]
        ]);
        exit;
    }
}
