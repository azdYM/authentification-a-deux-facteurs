<?php

namespace App\Controller;

use App;
use Otp\GoogleAuthenticator;
use Otp\Otp;
use ParagonIE\ConstantTime\Encoding;

class SecurityController extends AppController {

    /**
     * permet de connecter un utilisateur
     * 
     */
    public function login() {
        $table = 'user';
        $errors = [];
        $instance = 'App\\Entity\\' . ucfirst($table) . 'Entity';
        
        if (!empty($_POST)) {
            if ($this->valid()) {
                $user = App::getInstance()->getRepository($table)->findOneBy(["email" => $_POST["email"]]);
                if ($user instanceof $instance) {
                    if ($_POST['password'] === $user->password) {
                        unset($_SESSION["errors"]);
                        if ($user->totp_key != "") {
                            $_SESSION['user_id'][$table] = (int)$user->id;
                            header('Location: /login-totp');
                            exit();
                        } else {
                            $_SESSION['auth'][$table] = (int)$user->id;
                            header('Location: /');
                            exit();
                        }
                    }
                } 

                $_SESSION["errors"]["user_incorrect"] = "Identifiant ou mot de passe incorrect";
            }

            $errors = $_SESSION["errors"];
        }
        
        $this->render("auth/login", ["who" => $table, "errors" => $errors]);
        unset($_SESSION["errors"]);
    }

    /**
     * Inscrire un utilisateur
     * @param string type d'utilisateur (patient ou medecin)
     */
    public function register() {
        $errors = [];

        if (!empty($_POST)) {
            if ($this->valid()) {
                App::getInstance()->getRepository('user')->insert('user', $_POST);
                header('Location: /');
            }

            $errors = $_SESSION["errors"];
        } 


        $this->render("auth/register", ["errors" => $errors]);
        unset($_SESSION["errors"]);
    }

    /**
     * Verifier si les informations saisit sont valides
     */
    private function valid() {
        foreach($_POST as $key => $post) {
            if (empty($post)) {
                $_SESSION["errors"][$key] = "le champ $key ne doit pas etre vide";
            }
        }

        return empty($_SESSION["errors"]);
    }

    public function logout() {
        session_destroy();
        header('Location: /');
        exit();
    }

    public function loginTotp() {
        $table = key($_SESSION['user_id']);
        
        if (!$table) {
            header('Location: /');
            exit();
        }
        
        if (!empty($_POST)) {            
            if ($this->valid()) {
                $otp = new Otp();
                $user = App::getInstance()->getRepository($table)->find($_SESSION['user_id'][$table]);
                var_dump($user);

                if ($otp->checkTotp(Encoding::base32DecodeUpper($user->totp_key), $_POST['code'])) {
                    unset($_SESSION["errors_code"]);
                    $_SESSION['auth'][$table] = (int)$user->id;
                    header('Location: /');
                    exit();
                }else {
                    $_SESSION['error_code'] = 'ce code ne correspond pas';
                }
            }
        }

        $this->render('auth/login_totp');
    }

    /**
     * Active l'authentification a deux facteurs
     * @param array $userId 
     * 
     */
    public function activeTotp(array $userId) {
        $errors = [];

        if (!empty($_POST)) {
            $table = key($userId);
            
            if ($this->valid()) {
                $otp = new Otp();

                if ($otp->checkTotp(Encoding::base32DecodeUpper($_SESSION['secret']), $_POST['code'])) {
                    App::getInstance()->getRepository($table)->update($table, ["totp_key" => $_SESSION['secret']], $userId[$table]);
                    unset($_SESSION["error_code"]);
                    unset($_SESSION["secret"]);

                    header('location: /');
                }else {
                    $_SESSION['error_code'] = 'ce code ne correspond pas';
                }
            }
        }

        $secret = GoogleAuthenticator::generateRandom();
        $key = key($_SESSION['auth']);
        $req = App::getInstance()->getRepository($key)->find($_SESSION['auth'][$key]);
        $user = $req->nom . ' ' . $req->prenom;

        $qrcode = GoogleAuthenticator::getQrCodeUrl('totp', "login: $user", $secret);
        $_SESSION["secret"] = $secret;
        
        $this->render('auth/totp', ["qrcode" => $qrcode, 'errors' => $errors]);
        unset($_SESSION["errors"]);

    }

    public function removeTotp() {
        if ($_SESSION['auth']) {
            $table = key($_SESSION['auth']);
            APP::getInstance()->getRepository($table)->update($table, ["totp_key" => ''], $_SESSION['auth'][$table]);
            header('Location: /');
        }
    }
}