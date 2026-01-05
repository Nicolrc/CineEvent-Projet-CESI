<?php
namespace src\Controller;

use src\Model\Article;
use src\Model\BDD;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class AdminArticleController extends AbstractController{
    public function list(){
        $articles = article::SqlGetAll();
        $token = bin2hex(random_bytes(16));
        $_SESSION['token'] = $token;
        return $this->twig->render(
            'admin/article/list.html.twig',
            [
                'articles' => $articles,
                'token' => $token
            ]);
    }
    public function add(){
        if(isset($_POST['Titre'])){
            //1. Upload Fichier
            $sqlRepository = null; // On ne fera pas X requetes SQL différentes donc on déclare les variables dès le début pour les utiliser dans la requete SQL
            $nomImage = null;

            //1. Upload Fichier
            $sqlRepository = null; // On ne fera pas X requetes SQL différentes donc on déclare les variables dès le début pour les utiliser dans la requete SQL
            $nomImage = null;

            if(!empty($_FILES['Image']['name']) ) {
                //Type MIME
                $fileMimeType = mime_content_type($_FILES['Image']['tmp_name']);
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                //Extension
                $extension = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'gif', 'png', 'jpeg', 'webp'];
                // strtolower = on compare ce qui est comparage (JPEG =! jpeg)
                if (in_array(strtolower($extension), $allowedExtensions) && in_array($fileMimeType, $allowedMimeTypes)) {
                    // Fabrication du répertoire d'accueil façon "Wordpress" (YYYY/MM)
                    $dateNow = new \DateTime();
                    $sqlRepository = $dateNow->format('Y/m');
                    $repository = './uploads/images/' . $dateNow->format('Y/m');
                    if (!is_dir($repository)) {
                        mkdir($repository, 0777, true);
                    }
                    // Renommage du fichier (d'où l'intéret d'avoir isolé l'extension
                    $nomImage = md5(uniqid()) . '.' . $extension;

                    //Upload du fichier, voilà c'est fini !
                    move_uploaded_file($_FILES['Image']['tmp_name'], $repository . '/' . $nomImage);
                }
            }
            $article = new Article();
            $article->setTitre($_POST['Titre']);
            $article->setAuteur($_POST['Auteur']);
            $article->setDescription($_POST['Description']);
            $article->setDatePublication(new \DateTime($_POST['DatePublication']));
            $article->setImageFileName($nomImage);
            $article->setImageRepository($sqlRepository);
            $id = $article::SqlAdd($article);

            //Création Email
            $article->setId($id);
            $trspt = Transport::fromDsn("smtp://8ac99290b8a4e8:54b4714bdcc5b5@sandbox.smtp.mailtrap.io:2525");
            $mailer = new Mailer($trspt);
            //Création Email
            $email = (new Email())
                ->from("admin@cesi.local")
                ->to("admin@cesi.local")
                ->subject("Nouvel Article posté")
                ->html($this->twig->render('mail/article.add.html.twig',["article" => $article]));
            $mailer->send($email);


            header("location: /AdminArticle/show/{$id}");
        }

        return $this->twig->render('admin/article/add.html.twig');
    }

    public function fixtures(){
        UserController::haveGoodRole(["Administrateur","Fixtures"]);
        $requete = BDD::getInstance()->prepare("TRUNCATE TABLE articles")->execute();
        $arrayAuteur = ["Godrik", "Greg", "Guillaume", "Goliath", "George"];
        $arrayTitre = ["Les poules savent t-il voler", "La vie pour les nuls", "Press citron la rubrique acide", "Passion ornithorynque", "Pierre Paul et Jacque la fraterie improbable", "l'histoire vrai d'un homme loup"];
        $dateAjout = new \DateTime();

        for($i=1;$i<=200;$i++) {
            $dateAjout->modify("+1 day");
            shuffle($arrayAuteur);
            shuffle($arrayTitre);
            $article = new Article();
            $article->setTitre($arrayTitre[0])
                ->setDescription("Zypher est un langage de programmation moderne conçu pour offrir une expérience de développement puissante et flexible. Avec une syntaxe claire et concise, Zypher permet aux développeurs de créer des applications robustes et efficaces dans divers domaines, allant de l'informatique embarquée à la programmation web")
                ->setAuteur($arrayAuteur[0])
                ->setDatePublication($dateAjout);
            $id = Article::SqlAdd($article);
        }
        header('location: /AdminArticle/list ');
    }

    public function show($id)
    {
        $article = Article::SqlGetById($id);
        if($article == null){
            header('location: /AdminArticle/list');
        }
        return $this->twig->render("admin/article/show.html.twig",
            [
                'article' => $article,
            ]);
    }

    public function edit(int $id)
    {
        $article = Article::SqlGetById($id);
        if(isset($_POST["Titre"])){
            //1. Upload Fichier
            $sqlRepository = ($article->getImageRepository() != "") ? $article->getImageRepository() : null;
            $nomImage = ($article->getImageFileName() != "") ? $article->getImageFileName() : null;

            if(!empty($_FILES['Image']['name']) ) {
                //Type MIME
                $fileMimeType = mime_content_type($_FILES['Image']['tmp_name']);
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                //Extension
                $extension = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'gif', 'png', 'jpeg'];
                // strtolower = on compare ce qui est comparage (JPEG =! jpeg)
                if (in_array(strtolower($extension), $allowedExtensions) && in_array($fileMimeType, $allowedMimeTypes)) {
                    //Si image déjà existante alors on supprime
                    if($sqlRepository!=null and $nomImage!=null){
                        unlink('./uploads/images/'.$sqlRepository.'/'.$nomImage);
                    }

                    // Fabrication du répertoire d'accueil façon "Wordpress" (YYYY/MM)
                    $dateNow = new \DateTime();
                    $sqlRepository = $dateNow->format('Y/m');
                    $repository = './uploads/images/' . $dateNow->format('Y/m');
                    if (!is_dir($repository)) {
                        mkdir($repository, 0777, true);
                    }
                    // Renommage du fichier (d'où l'intéret d'avoir isolé l'extension
                    $nomImage = md5(uniqid()) . '.' . $extension;

                    //Upload du fichier, voilà c'est fini !
                    move_uploaded_file($_FILES['Image']['tmp_name'], $repository . '/' . $nomImage);
                }
            }

            //Créer un objet Article
            $article->setTitre($_POST['Titre']);
            $article->setDescription($_POST['Description']);
            $article->setAuteur($_POST['Auteur']);
            $article->setDatePublication(new \DateTime($_POST['DatePublication']));
            $article->setImageFileName($nomImage);
            $article->setImageRepository($sqlRepository);

            //Exécuter la requete SQL d'ajout (model)
            Article::SqlUpdate($article);

            //Rédiriger l'internaute sur la page liste
            header("location:/AdminArticle/list");

        }
        return $this->twig->render('admin/article/edit.html.twig', [
            'article' => $article,
        ]);
    }
    public function delete($id)
    {
        $token = $_GET["token"];
        UserController::haveGoodRole(["Administrateur"]);
        if($token != $_SESSION["token"]){
            header("location: /AdminArticle/list");
            return;
        }
        $article = Article::SqlGetById($id);
        $sqlRepository = ($article->getImageRepository() != "") ? $article->getImageRepository() : null;
        $nomImage = ($article->getImageFileName() != "") ? $article->getImageFileName() : null;
        if($sqlRepository!=null and $nomImage!=null){
            unlink('./uploads/images/'.$sqlRepository.'/'.$nomImage);
        }
        Article::SqlDelete($id);
        header("location:/AdminArticle/list");
    }
}