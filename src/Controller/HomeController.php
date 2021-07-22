<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\HomeManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */


    public function index(): string
    {
        $email = '';
        $postalcode = '';
        // $postalCodePattern = '/^([0-9]{5})$/';

        // if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //     if (isset($_POST['submit'])) {
        //         $this->handlePostEmail($_POST['email']);
        //     }

        //     if (isset($_POST['postcode'])) {
        //         $this->handlePostPostalCode($_POST['postcode'], $postalCodePattern);
        //     }

        //     if (!($this->isEmpty($_POST))) {
        //         $this->errors = "Tous les champs doivent être remplis";
        //     }
        // }

        return $this->customRender('Home/index.html.twig', [
            'email' => $email,
            // 'errors' => $this->errors,
            // 'success' => $this->success,
            // 'postalcode' => $postalcode
        ]);
    }
}
