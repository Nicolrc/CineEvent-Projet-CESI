<?php
namespace src\Controller;

use Mpdf\Output\Destination;
use src\Model\CineEvent;

class EventController extends AbstractController{

    public function index(){
        $events = CineEvent::SqlGetAll();
        return $this->twig->render('event/index.html.twig', [
            'events' => $events
        ]);
    }
    public function showEvent(int $id){
        $events = CineEvent::SqlGetById($id);
        return $this->twig->render("event/show.html.twig",[
            "event" => $events
        ]);
    }

    public function pdf($id){
        $event = CineEvent::SqlGetById($id);
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => $_SERVER['DOCUMENT_ROOT'] . '/../var/cache/pdf',
        ]);
        $mpdf->writeHTML($this->twig->render("event/pdfEvent.html.twig", [
            "event" => $event
        ]));
        $nomPdf = $event->getNom() . '.pdf';
        $mpdf->Output(name: $nomPdf, dest: Destination::DOWNLOAD);
    }
}