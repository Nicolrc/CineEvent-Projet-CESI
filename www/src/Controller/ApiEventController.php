<?php
namespace src\Controller;

use src\Model\CineEvent;
use src\Services\JwtService;

class ApiEventController{
    public function __construct(){
        header("Content-type: application/json; charset=utf-8");
    }

    public function getAll(){
        if(!$_SERVER["REQUEST_METHOD"] == "GET"){
            header("HTTP/1.1 405 Method Not Allowed");
            return json_encode([
                'status' => false,
                'message' => 'Method Not Allowed'
            ]);
        }
        $jwtresult = JwtService::checkToken();
        if (!$jwtresult['success']) {
            // 1. On définit le code d'erreur HTTP (401 = Non autorisé)
            header("HTTP/1.1 401 Unauthorized");

            // 2. On retourne le message d'erreur du service
            return json_encode([
                'status' => false,
                'message' => $jwtresult['body']
            ]);
        }
        $event = CineEvent::SqlGetAll();
        return json_encode($event);
    }

    public function add()
    {
        if (!$_SERVER["REQUEST_METHOD"] == "POST") {
            header("HTTP/1.1 405 Method Not Allowed");
            return json_encode([
                'success' => false,
                'message' => 'Method Not Allowed'
            ]);
        }

        $jwtresult = JwtService::checkToken();
        if (!$jwtresult['success']) {
            // 1. On définit le code d'erreur HTTP (401 = Non autorisé)
            header("HTTP/1.1 401 Unauthorized");

            // 2. On retourne le message d'erreur du service
            return json_encode([
                'status' => false,
                'message' => $jwtresult['body']
            ]);
        }

        $data = json_decode(file_get_contents("php://input"));
        $sqlRepository = null;
        $nomImage = null;
        if(isset($data->Image)){
            $nomImage = uniqid().'.jpg';
            $dateNow = new \DateTime();
            $sqlRepository = $dateNow->format('Y/m');
            $repository = "{$_SERVER['DOCUMENT_ROOT']}/uploads/images/{$sqlRepository}";
            if(!is_dir($repository)){
                mkdir($repository, 0777, true);
            }
            $file = fopen("{$repository}/{$nomImage}", "wb");
            fwrite($file, base64_decode($data->Image));
            fclose($file);
        }
        if(empty($data->nom) || empty($data->description) || empty($data->prix)){
            header("HTTP/1.1 400 Bad Request");
            return json_encode([
                'success' => false,
                'message' => 'Il manque des données obligatoire'
            ]);
        }
        $event = new CineEvent();
        $event->setNom($data->nom);
        $event->setDescription($data->description);
        $event->setPrix($data->prix);
        $event->setDateEvenement(new \DateTime($data->dateEvenement));
        $event->setLongitude($data->longitude);
        $event->setLatitude($data->latitude);
        $event->setContactNom($data->contactNom);
        $event->setContactEmail($data->contactEmail);
        $event->setImageFileName($nomImage);
        $event->setImageRepository($sqlRepository);

        $id = CineEvent::SqlAdd($event);
        return json_encode([
            'success' => true,
            'id' => $id,
            'message' => 'Article ajouté avec success'
        ]);
    }
    public function update($id){
        if(!$_SERVER["REQUEST_METHOD"] == "PUT"){
            header("HTTP/1.1 405 Method Not Allowed");
            return json_encode([
                'success' => false,
                'message' => 'Method Not Allowed'
            ]);
        }

        $jwtresult = JwtService::checkToken();
        if (!$jwtresult['success']) {
            // 1. On définit le code d'erreur HTTP (401 = Non autorisé)
            header("HTTP/1.1 401 Unauthorized");

            // 2. On retourne le message d'erreur du service
            return json_encode([
                'status' => false,
                'message' => $jwtresult['body']
            ]);
        }

        $data = json_decode(file_get_contents("php://input"));

        if(empty($data->id)|| empty($data->nom) || empty($data->description) || empty($data->prix)){
            header("HTTP/1.1 400 Bad Request");
            return json_encode([
                'success' => false,
                'message' => 'Données manquantes ou ID invalide'
            ]);
        }
        $event = CineEvent::SqlGetById($data->id);
        if(!$event){
            header("HTTP/1.1 404 Not Found");
            return json_encode([
                'success' => false,
                'message' => "event {$id} introuvable"
            ]);
        }

        // Gestion de l'Image
        // Si une NOUVELLE image est envoyée, on supprime l'ancienne et on crée la nouvelle.
        // Sinon, on conserve l'image actuelle.
        $sqlRepository = null;
        $nomImage = null;
        if(isset($data->Image) && !empty($data->Image)) {

            // Suppression de l'ancienne image physique
            $oldRepo = $event->getImageRepository();
            $oldName = $event->getImageFileName();

            if ($oldRepo && $oldName) {
                $oldPath = "{$_SERVER['DOCUMENT_ROOT']}/uploads/images/{$oldRepo}/{$oldName}";
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Création de la nouvelle image
            $nomImage = uniqid().'.jpg';
            $dateNow = new \DateTime();
            $sqlRepository = $dateNow->format('Y/m');
            $repository = "{$_SERVER['DOCUMENT_ROOT']}/uploads/images/{$sqlRepository}";

            if(!is_dir($repository)){
                mkdir($repository, 0777, true);
            }

            $file = fopen("{$repository}/{$nomImage}", "wb");
            fwrite($file, base64_decode($data->Image));
            fclose($file);
        }

        $event->setNom($data->nom);
        $event->setDescription($data->description);
        $event->setPrix($data->prix);
        $event->setDateEvenement(new \DateTime($data->dateEvenement));
        $event->setLongitude($data->longitude);
        $event->setLatitude($data->latitude);
        $event->setContactNom($data->contactNom);
        $event->setContactEmail($data->contactEmail);

        CineEvent::SqlUpdate($event);
        return json_encode([
            'success' => true,
            'message' => "Article {$id} mis à jour avec succès"
        ]);
    }

    public function delete($id){
        if($_SERVER["REQUEST_METHOD"] != "DELETE"){
            header("HTTP/1.1 405 Method Not Allowed");
            return json_encode([
                'success' => false,
                'message' => 'Method Not Allowed'
            ]);
        }

        $jwtresult = JwtService::checkToken();
        if (!$jwtresult['success']) {
            // 1. On définit le code d'erreur HTTP (401 = Non autorisé)
            header("HTTP/1.1 401 Unauthorized");

            // 2. On retourne le message d'erreur du service
            return json_encode([
                'status' => false,
                'message' => $jwtresult['body']
            ]);
        }

        if(empty($id)){
            header("HTTP/1.1 404 Not Found");
            return json_encode([
                'success' => false,
                'message' => "ID invalide ou manquant"
            ]);
        }
        $event = CineEvent::SqlGetById($id);
        if(!$event){
            header("HTTP/1.1 404 Not Found");
            return json_encode([
                'success' => false,
                'message' => "event {$id} introuvable"
            ]);
        }
        $imageRepo = $event->getImageRepository();
        $imageName = $event->getImageFileName();

        if($imageRepo && $imageName) {
            $fullPath = "{$_SERVER['DOCUMENT_ROOT']}/uploads/images/{$imageRepo}/{$imageName}";
            if(file_exists($fullPath)){
                unlink($fullPath); // Suppression du fichier
            }
        }
        CineEvent::SqlDelete($id);
        return json_encode([
            'success' => true,
            'message' => "Suppression article {$id}"
        ]);
    }

    public function getByPage(): string|false
    {
        try {
            $page = (int)($_GET['page'] ?? 0);
            $limit = (int)($_GET['limit'] ?? 10);

            $event = CineEvent::SqlFindPaginated($page, $limit);

            return json_encode($event);
        } catch (PDOException $e) {
            error_log("DB Error in getAll: " . $e->getMessage());
            return json_encode([]);
        }
    }
}