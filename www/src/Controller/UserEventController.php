<?php
namespace src\Controller;

use src\Model\UserEvent;

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
}
