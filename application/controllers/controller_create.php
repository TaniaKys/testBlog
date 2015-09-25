<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller_admin
 *
 * @author Tanya
 */
class Controller_create extends Controller {

    public function actionIndex($arg) {
        session_start();
        if (isset($_SESSION["root"]) && $_SESSION["root"] == "root") {
            if (isset($_POST['exit']) && $_POST['exit'] == "Logout") {
                session_destroy();
                header('Location: ' . "./");
            } else {
                if (isset($_POST['title']) && isset($_POST['text_preview']) && isset($_POST['main_text']) && isset($_FILES['image'])) {
                    $post = array(
                        'title' => $_POST["title"],
                        'text_preview' => $_POST['text_preview'],
                        'main_text' => $_POST['main_text'],
                        'image' => $_FILES['image']
                    );
                    $data = $this->model->addPost($post);
                } else {
                    $data = "All fields must be filled.";
                }

                $this->view->generate('create_view.php', $data);
            }
        } else {
            header('Location: ' . "./");
        }
    }

}
