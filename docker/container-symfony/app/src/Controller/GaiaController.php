<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/**
 * TODO: better mix with Gaia
 * catchall routes are easier than error handling
 * https://symfony.com/doc/current/controller/error_pages.html#custom-error-controller
 */
class GaiaController extends AbstractController
{
    #[Route('/{slug1}', methods: ['GET', 'POST'], name: 'catch_all_1')]
    #[Route('/{slug1}/{slug2}', methods: ['GET', 'POST'], name: 'catch_all_12')]
    #[Route('/{slug1}/{slug2}/{slug3}', methods: ['GET', 'POST'], name: 'catch_all_123')]
    #[Route('/{slug1}/{slug2}/{slug3}/{slug4}', methods: ['GET', 'POST'], name: 'catch_all_1234')]
    public function catchall ($slug1="", $slug2="", $slug3="", $slug4=""): Response
    {        
        $html = '<html><body>Lucky number: ' . rand(0, 100) . '</body></html>';
        $env_gaia_path = getenv('GAIA_PATH');
        // GAIA_PATH=../../container-php/app/public/index.php
        $env_gaia_path = '../../container-php/app/public/index.php';

        // get symfony rootDir
        $framwork_root = $this->getParameter('kernel.project_dir');
        $path_gaia = realpath("$framwork_root/$env_gaia_path");
    
        ob_start();
        include $path_gaia;
        $mime_type = \xpa_router::$mime_type;
        $code = ob_get_clean();

        return new Response($code, 200, [
            'Content-Type' => $mime_type,
        ]);
    }

    public function show (Throwable $exception): Response
    {
        // to activate: add parameter in config/packages/framework.yaml
        // https://symfony.com/doc/current/controller/error_pages.html#custom-error-controller

        // return html directly
        $html = '<html><body>Lucky number: ' . rand(0, 100) . '</body></html>';

        $env_gaia_path = getenv('GAIA_PATH');
        // GAIA_PATH=../../container-php/app/public/index.php
        $env_gaia_path = '../../container-php/app/public/index.php';

        // get symfony rootDir
        $framwork_root = $this->getParameter('kernel.project_dir');
        $path_gaia = realpath("$framwork_root/$env_gaia_path");
    
        ob_start();
        include $path_gaia;
        $mime_type = \xpa_router::$mime_type;

        $code = ob_get_clean();
        // $html = $path_gaia;

        // FIXME: not working
        // http_response_code(200);

        // FIXME: 200 is not working
        return new Response($code, 200, [
            'Content-Type' => $mime_type,
        ]);

        // return $this->render('gaia/index.html.twig', [
        //     'controller_name' => 'GaiaController',
        // ]);
    }
}
