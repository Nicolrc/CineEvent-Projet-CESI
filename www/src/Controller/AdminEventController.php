<?php
namespace src\Controller;

use src\Model\Article;
use src\Model\CineEvent;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class AdminEventController extends AbstractController
{
    public function listEvents(){
        $events = CineEvent::SqlGetAll();
        return $this->twig->render(
            'admin/event/listEvent.html.twig',
            [
                'events' => $events,
                'token'  => $_SESSION['token'] ?? ''
            ]);
    }

    public function add(){
        UserEventController::haveGoodRole(["Administrateur"]);
        if(isset($_POST['nom'])){
            $token = $_GET["token"] ?? "";
            if($token != $_SESSION["token"]){
                header("location: /AdminEvent/listEvents");
                return;
            }
            //On met les variable qui vont contenir les image a null dans le cas ou l'utilisateur n'entre pas de d'image
            $sqlRepository = null;
            $nomImage = null;

            if(!empty($_FILES['Image']['name']) ) {
                //Type MIME
                $fileMimeType = mime_content_type($_FILES['Image']['tmp_name']);
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                //Extension
                $extension = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'gif', 'png', 'jpeg', 'webp'];
                // strtolower = on compare ce qui est comparable (JPEG =! jpeg)
                if (in_array(strtolower($extension), $allowedExtensions) && in_array($fileMimeType, $allowedMimeTypes)) {
                    // Fabrication du répertoire d'accueil façon "Wordpress" (YYYY/MM)
                    $dateNow = new \DateTime();
                    $sqlRepository = $dateNow->format('Y/m');
                    $repository = './uploads/images/' . $dateNow->format('Y/m');
                    if (!is_dir($repository)) {
                        mkdir($repository, 0777, true);
                    }
                    // Renommage du fichier pour ne pas écraser ceux qui auront le même nom
                    $nomImage = md5(uniqid()) . '.' . $extension;

                    //Upload du fichier, voilà c'est fini !
                    move_uploaded_file($_FILES['Image']['tmp_name'], $repository . '/' . $nomImage);
                }
            }
            $event = new CineEvent();
            $event->setNom($_POST['nom']);
            $event->setDescription($_POST['description']);
            $event->setDateEvenement(new \DateTime($_POST['date_evenement']));
            $event->setPrix((int)$_POST['prix']);
            $event->setLatitude((float)$_POST['latitude']);
            $event->setLongitude((float)$_POST['longitude']);
            $event->setContactNom($_POST['contact_nom']);
            $event->setContactEmail($_POST['contact_email']);
            $event->setImageFileName($nomImage);
            $event->setImageRepository($sqlRepository);

            try {
                $id = CineEvent::SqlAdd($event);

                //Création Email --> a faire une fois que tout foncitonnera correctement
                $event->setId($id);
                $trspt = Transport::fromDsn("smtp://8ac99290b8a4e8:54b4714bdcc5b5@sandbox.smtp.mailtrap.io:2525");
                $mailer = new Mailer($trspt);
                //Création Email
                $email = (new Email())
                    ->from("admin@cesi.local")
                    ->to("admin@cesi.local")
                    ->subject("Nouvel événement posté")
                    ->html($this->twig->render('mail/event.mail.html.twig',[
                        "event" => $event,
                        "session" => ["token" => $_SESSION["token"]]
                    ]));
                $mailer->send($email);

                $_SESSION['flash_messages'][] = [
                    'type' => 'success', // Pour la classe Bootstrap text-bg-success
                    'texte' => 'L\'événement a été ajouté avec succès et le mail envoyé !'
                ];

                header("location: /AdminEvent/showEvent/{$id}");
                exit();

            }catch(\Exception $e){
                $_SESSION['flash_messages'][] = [
                    'type' => 'danger', // Pour la classe Bootstrap text-bg-danger (rouge)
                    'texte' => 'Une erreur est survenue lors de l\'ajout : ' . $e->getMessage()
                ];

                header("location: /AdminEvent/add");
                exit();
            }
        }

        return $this->twig->render('admin/event/addEvent.html.twig');
    }
    public function editEvent(int $id)
    {
        UserEventController::haveGoodRole(["Administrateur"]);

        $event = CineEvent::SqlGetById($id);
        if(isset($_POST["nom"])){

            $token = $_GET["token"] ?? "";
            if($token != $_SESSION["token"]){
                header("location: /AdminEvent/listEvents");
                return;
            }

            //1. Upload Fichier
            $sqlRepository = ($event->getImageRepository() != "") ? $event->getImageRepository() : null;
            $nomImage = ($event->getImageFileName() != "") ? $event->getImageFileName() : null;

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

            //Créer un objet event
            $event->setNom($_POST['nom']);
            $event->setDescription($_POST['description']);
            $event->setDateEvenement(new \DateTime($_POST['date_evenement']));
            $event->setPrix((int)$_POST['prix']);
            $event->setLatitude((float)$_POST['latitude']);
            $event->setLongitude((float)$_POST['longitude']);
            $event->setContactNom($_POST['contact_nom']);
            $event->setContactEmail($_POST['contact_email']);
            $event->setImageFileName($nomImage);
            $event->setImageRepository($sqlRepository);

            try{
                $_SESSION['flash_messages'][] = [
                    'type' => 'success',
                    'texte' => 'L\'événement a été modifié!'
                ];
                CineEvent::SqlUpdate($event);
                header("location:/AdminEvent/listEvents");
            }catch (\Exception $e){
                $_SESSION['flash_messages'][] = [
                    'type' => 'danger',
                    'texte' => 'Une erreur est survenue lors de la modification : ' . $e->getMessage()
                ];
            }
        }
        return $this->twig->render('admin/event/updateEvent.html.twig', [
            'event' => $event,
        ]);
    }

    public function delete($id)
    {
        $token = $_GET["token"];
        UserEventController::haveGoodRole(["Administrateur"]);
        if($token != $_SESSION["token"]){
            header("location: /AdminEvent/listEvent");
            return;
        }
        $event = CineEvent::SqlGetById($id);
        $sqlRepository = ($event->getImageRepository() != "") ? $event->getImageRepository() : null;
        $nomImage = ($event->getImageFileName() != "") ? $event->getImageFileName() : null;
        if($sqlRepository!=null and $nomImage!=null){
            unlink('./uploads/images/'.$sqlRepository.'/'.$nomImage);
        }
        try {
            $_SESSION['flash_messages'][] = [
                'type' => 'success', // Pour la classe Bootstrap text-bg-success
                'texte' => 'L\'événement a été supprimé avec succès'
            ];
            CineEvent::SqlDelete($id);
            header("location:/AdminEvent/listEvents");
        }catch (\Exception $e){
            $_SESSION['flash_messages'][] = [
                'type' => 'danger', // Pour la classe Bootstrap text-bg-danger (rouge)
                'texte' => 'Une erreur est survenue lors de la suppression : ' . $e->getMessage()
            ];

            header("location: /AdminEvent/listEvents");
            exit();
        }
    }

    public function showEvent($id)
    {
        $event = CineEvent::SqlGetById($id);
        if($event == null){
            header('location: /AdminEvent/listEvents');
        }
        return $this->twig->render("admin/event/showEvent.html.twig",
            [
                'event' => $event,
            ]);
    }

}