<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_post
 *
 * @author Tanya
 */
class controller_post extends Controller {

    function actionIndex($arg) {
        session_start();
        $data = $this->model->getPost($arg);
        if (!$data) {
            header('Location: ' . "../");
        } else {
            if (isset($_SESSION["root"]) && $_SESSION["root"] == "root") {
                if (isset($_POST['exit']) && $_POST['exit'] == "Logout") {
                    session_destroy();
                    $this->view->generate('post_view.php', $data);
                } else {
                    $this->view->generate('post_view_admin.php', $data);
                }
            } else {
                if (isset($_POST["login"]) && isset($_POST["password"]) && $_POST["login"] == "root" && $_POST["password"] == "root") {
                    $_SESSION["root"] = "root";
                    $this->view->generate('post_view_admin.php', $data);
                } else {
                    $this->view->generate('post_view.php', $data);
                }
            }
        }
    }

}
