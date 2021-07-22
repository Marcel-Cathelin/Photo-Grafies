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
    public function handlePostEmail($value): void
    {
        $email = trim($value);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == $email && !empty($email)) {
            $this->success = "Votre adresse e-mail a été bien enregistré.";
        }

        if (empty($email)) {
            $this->errors = "Le champ email ne peut pas être vide.";
        } else {
            $this->errors = "Adresse e-mail incorrect. Veuillez la re-saisir. ";
        }
    }

    public function handlePostPostalCode($value, $pCode): void
    {
        $postalcode = trim($value);
        if (preg_match($pCode, $postalcode)) {
            $this->success = "Un instant, nous recherchons nos cuisiniers les plus proche de chez vous";

            // if validation is ok, insert and redirection
            $homeManager = new HomeManager();
            $homeManager->insert($postalcode);
        }
        if (empty($postalcode)) {
            $this->errors = "Le champ code postal ne peut pas être vide.";
        }
        if (strlen($postalcode) > 5 || strlen($postalcode) < 5) {
            $this->errors = "Code postal invalide. Veuillez entrer 5 chiffres. ";
        } else {
            $this->errors = "Une erreur est survenue. Contactez l'admin à cet email : admin@metiscooking.fr ";
        }
    }


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
        $postalCodePattern = '/^([0-9]{5})$/';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['submit'])) {
                $this->handlePostEmail($_POST['email']);
            }

            if (isset($_POST['postcode'])) {
                $this->handlePostPostalCode($_POST['postcode'], $postalCodePattern);
            }

            if (!($this->isEmpty($_POST))) {
                $this->errors = "Tous les champs doivent être remplis";
            }
        }

        return $this->customRender('Home/index.html.twig', [
            'email' => $email,
            // 'errors' => $this->errors,
            // 'success' => $this->success,
            // 'postalcode' => $postalcode
        ]);
    }
}
