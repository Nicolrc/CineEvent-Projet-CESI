<?php
namespace src\Model;

class UserEvent
{
    private ?int $Id = null;
    private ?string $Email;
    private ?string $Password;
    private ?string $Nom;
    private ?string $Prenom;
    private ?array $Roles;

    public function getId(): ?int{
        return $this->Id;
    }
    public function setId(int $id): userEvent{
        $this->Id = $id;
        return $this;
    }
    public function getEmail(): ?string{
        return $this->Email;
    }
    public function setEmail(string $Email): userEvent{
        $this->Email = $Email;
        return $this;
    }
    public function getPassword(): ?string{
        return $this->Password;
    }
    public function setPassword(string $Password): userEvent{
        $this->Password = $Password;
        return $this;
    }
    public function getNom(): ?string{
        return $this->Nom;
    }
    public function setNom(string $Nom): userEvent{
        $this->Nom = $Nom;
        return $this;
    }
    public function getPrenom(): ?string{
        return $this->Prenom;
    }
    public function setPrenom(string $Prenom): userEvent{
        $this->Prenom = $Prenom;
        return $this;
    }
    public function getRoles(): ?array{
        return $this->Roles;
    }
    public function setRoles(array $Roles): userEvent{
        $this->Roles = $Roles;
        return $this;
    }

    public static function sqlGetByMail(string $mail): ?UserEvent{
        $request = BDD::getInstance()->prepare("SELECT * FROM users WHERE Email=:mail");
        $request->execute(["mail" => $mail]);
        $data = $request->fetch(\PDO::FETCH_ASSOC);
        if($data != false){
            $user = new UserEvent();
            $user->setId($data["Id"]);
            $user->setEmail($data["Email"]);
            $user->setPassword($data["Password"]);
            $user->setNom($data["Nom"]);
            $user->setPrenom($data["Prenom"]);
            $user->setRoles(json_decode($data["Roles"]));
            return $user;
        }
        return null;
    }

    public static function sqlAdd(UserEvent $user): int{
        $request = BDD::getInstance()->prepare("INSERT INTO users (Email, Password, Nom, Prenom, Roles) VALUES(:Email, :Password, :Nom, :Prenom, :Roles)");
        $request->execute([
            "Email" => $user->getEmail(),
            "Password" => $user->getPassword(),
            "Nom" => $user->getNom(),
            "Prenom" => $user->getPrenom(),
            "Roles" => json_encode($user->getRoles())
            ]);
        return BDD::getInstance()->lastInsertId();
    }
}