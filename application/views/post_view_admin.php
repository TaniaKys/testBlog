<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>My Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="../bootstrap/js/bootstrap-filestyle.min.js"></script>
    <style>
        #lol {
            height: 700px;
        }
        .img_preview {
            float: left;
            margin-right:5px;
        }
    </style>
</head>

<body>
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">

                <a class="brand" href="./">My blog</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li><a href="../">Home</a></li>
                        <li><a href="../create">Create post</a></li>
                    </ul>
                    <form class="navbar-form pull-right" method="POST">
                        <input type="submit" value="Logout" name="exit" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="lol">

            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
                    <?php
                    if (!$data) {
                        echo "There are no posts yet!";
                    } else {
                            echo "<div class='container'>                             
                        &#8592;<a href='./'>back</a><br>
                        <h3>$data[title]</h3>
                        <p>$data[main_text]</p>
                         <p>$data[date]</p>                       
                         </div>";
                        
                    }
                    ?>
                </div>
            </div>


            <hr>

            
        </div> 

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
</body>

