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
        $token = bin2hex(random_bytes(16));
        $_SESSION['token'] = $token;
        return $this->twig->render(
            'admin/event/listEvent.html.twig',
            [
                'events' => $events,
                'token' => $token
            ]);
    }

    public function add(){
        if(isset($_POST['nom'])){
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

            $id = CineEvent::SqlAdd($event);

            //Création Email --> a faire une fois que tout foncitonnera correctement
            //$event->setId($id);
            //$trspt = Transport::fromDsn("smtp://8ac99290b8a4e8:54b4714bdcc5b5@sandbox.smtp.mailtrap.io:2525");
            //$mailer = new Mailer($trspt);
            //Création Email
            //$email = (new Email())
            //    ->from("admin@cesi.local")
            //    ->to("admin@cesi.local")
            //    ->subject("Nouvel Article posté")
            //    ->html($this->twig->render('mail/article.add.html.twig',["envent" => $event]));
            //$mailer->send($email);

            //header("location: /AdminEvent/show/{$id}");
            header("Location: /AdminEvent/listEvents");;
            exit();
        }

        return $this->twig->render('admin/event/addEvent.html.twig');
    }
}