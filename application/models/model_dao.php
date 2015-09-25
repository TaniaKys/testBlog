<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_create
 *
 * @author Tanya
 */
class Model_DAO {


    public function addPost($post) {
        include 'application/database/config.php';
        include 'application/database/connect.php';
        $result_msg = "";
        if (!$this->checkValidation($post)) {
            $result_msg = "Post not added, cause invalid data ";
        } else {
            $date = date('d/m/y');
            $query_add = "INSERT INTO posts (title, text_preview, main_text, date) VALUES ('$post[title]','$post[text_preview]', '$post[main_text]','$date')";
            if (!$mysqli->query($query_add)) {
                $result_msg = "Post not added, cause: " . $mysqli->error;
            } else {
                $query_get = "SELECT id FROM posts ORDER BY id DESC LIMIT 1";
                $result = $mysqli->query($query_get);
                if (!$result) {
                    $result_msg = "Post not added, cause: " . $mysqli->error;
                } else {
                    $result = $result->fetch_assoc();
                    $name = "./post_images/$result[id].png";
                    $this->imageResize($post['image'], 100, 100, $name);
                    $query_udate = "UPDATE posts SET image='$name' WHERE id=$result[id]";
                    if (!$mysqli->query($query_udate)) {
                        $result_msg = "Post not added, cause: " . $mysqli->error;
                    } else {
                        $result_msg = "Post added!";
                    }
                }
            }
        }
        return $result_msg;
    }
    
    public function getAllPosts() {
        include "application/database/config.php";
        include "application/database/connect.php";
        $query = "SELECT * FROM posts ORDER BY id DESC";
        $result = $mysqli->query($query);
        if (!$result) {
           return false;
        }else {
            $posts = array();
            $i = 0;
            while($post = $result->fetch_assoc()){
                $posts[$i] = $post;
                $i++;
            }
            return $posts;
        }
    }
    
    public function getPost($id) {
        include "application/database/config.php";
        include "application/database/connect.php";
        $query = "SELECT * FROM posts WHERE id=$id";
        $result = $mysqli->query($query);
        if (!$result) {
           return false;
        }else {
            $post = $result->fetch_assoc();
            return $post;
        }
    }

    private function imageResize($image, $width, $height, $name) {
        $ifile = $image['tmp_name'];
        $isize = getImageSize($ifile);
        $iw = $isize[0];
        $ih = $isize[1];
        switch ($image['type']) {
            case "image/gif": $img = imageCreateFromGif($ifile);
                break;
            case "image/jpeg": $img = imageCreateFromJpeg($ifile);
                break;
            case "image/png": $img = imageCreateFromPng($ifile);
                break;
            case "image/pjpeg": $img = imageCreateFromJpeg($ifile);
                break;
            case "image/x-png": $img = imageCreateFromPng($ifile);
                break;
        }
        if ($iw > $ih) {
            $new_ih = $ih / ($iw / $width);
            $new_iw = $width;
        } else {
            $new_iw = $iw / ($ih / $height);
            $new_ih = $height;
        }
        $dst = imageCreateTrueColor($new_iw, $new_ih);
        imageCopyResampled($dst, $img, 0, 0, 0, 0, $new_iw, $new_ih, $iw, $ih);
        imagePNG($dst, $name, 0);
        imageDestroy($img);
        imageDestroy($dst);
    }

    private function checkValidation($post) {
        if (strlen($post['title']) > 255 || $post['title'] == "" || strlen($post['text_preview'] > 255) || $post['text_preview'] == "" || $post['main_text'] == "" || $post['image']['size'] > 5242880 || $post['image']['size'] == 0) {
            return false;
        } else {
            if ($post['image']['type'] == "image/gif" || $post['image']['type'] == "image/png" || $post['image']['type'] == "image/x-png" || $post['image']['type'] == "image/pjpeg" || $post['image']['type'] == "image/jpeg") {
                return true;
            } else {
                return true;
            }
        }
    }

}
