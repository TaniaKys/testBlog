<?php

class View {

    function generate($content_view, $data) {
       
        include 'application/views/' . $content_view;
    }

}
?>