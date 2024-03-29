<?php
//session_start();
include 'components/connect.php';
include 'components/header.php';
include 'components/alers.php';

$success_msg = isset($_GET['success']) ? [$_GET['success']] : [];

// Clear the session variable to avoid showing the message on subsequent visits
unset($_GET['success']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MReviewer</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="homescript.css">
   

</head>
<body>
   
<!-- header section starts  -->
<!-- header section ends -->
<header>
<div class="form-center">
        <form  id="form" class="center">
            <input type="text" placeholder="Search" id="search" class="search">
        </form>
</div>
</header>

<div id="tags"></div>
    <div id="myNav" class="overlay">

        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      
        <!-- Overlay content -->
        <div class="overlay-content" id="overlay-content"></div>
        
        <a href="javascript:void(0)" class="arrow left-arrow" id="left-arrow">&#8656;</a> 
        
        <a href="javascript:void(0)" class="arrow right-arrow" id="right-arrow" >&#8658;</a>

      </div>
    <main id="main"></main>
    <div class="pagination">
        <div class="page" id="prev">Previous Page</div>
        <div class="current" id="current">1</div>
        <div class="page" id="next">Next Page</div>

    </div>

   <script src='js/script2.js'></script>

<!-- view all posts section ends -->


<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>
