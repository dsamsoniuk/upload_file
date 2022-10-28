<?php


namespace App\Controller;

use App\Service\AudiEngineService;
use DOMDocument;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MainController {

    #[Route('/', name: 'main_index')]
    public function index() {

        $res = '';

        // $xml = new DOMDocument( "1.0", "ISO-8859-15" );
        // $car = $xml->createElement('mark', 'audi');
        // $capacity = $xml->createElement('capacity', '1.6');
        // $xml->appendChild($car);
        // $xml->appendChild($capacity);

        // $res = $xml->saveXML();

        // $distance = $audiEngineService->countDistance(1.6);

        $daneCar = ['Audi', 'benzyna', 1.6];






        return new JsonResponse([
            'test' => $res
        ]);
    }
}