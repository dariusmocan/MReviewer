<?php

include 'components/connect.php';

if(isset($_POST['delete_review'])){

   $delete_id = $_POST['delete_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $conn->prepare("SELECT * FROM `reviews` WHERE id = ?");
   $verify_delete->execute([$delete_id]);
   
   if($verify_delete->rowCount() > 0){
      $delete_review = $conn->prepare("DELETE FROM `reviews` WHERE id = ?");
      $delete_review->execute([$delete_id]);
      $success_msg[] = 'Review deleted!';
   }else{  
      $warning_msg[] = 'Review already deleted!';
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>view post</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<!-- view posts section starts  -->
<?php
    // Retrieve parameters from the URL
    $postId = isset($_GET['id']) ? $_GET['id'] : '';
    $title = isset($_GET['title']) ? urldecode($_GET['title']) : '';
    $overview = isset($_GET['overview']) ? urldecode($_GET['overview']) : '';
    $image = isset($_GET['image']) ? urldecode($_GET['image']) : '';
    $voteAverage = isset($_GET['vote_average']) ? $_GET['vote_average'] : '';

?>

<section class="view-post">


   <div class="row">
      <div class="col">
         <h3 class="title"><?= $title ?></h3>
         <img src= '<?= $image ?>' alt="" class="image">
      </div>
      <div class="col">
         <div class="flex">
         <h3 class="title"><?= $voteAverage ?></h3>
         <h3 class="title"><?= $overview ?></h3>
</div>
</div>

</section>

<!-- view posts section ends -->

<!-- reviews section starts  -->

<section class="reviews-container">

   <div class="heading"><h1>user's reviews</h1> <a href="add_review.php?id=<?= $postId ?>&title=<?= urlencode($title) ?>&overview=<?= urlencode($overview) ?>&image=<?= urlencode($image) ?>&vote_average=<?= $voteAverage ?>" class="inline-option-btn" style="margin-top: 0;">add review</a></div>

   <div class="box-container">
   <?php
      $select_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
      $select_reviews->execute([$postId]);
      if($select_reviews->rowCount() > 0){
         while($fetch_review = $select_reviews->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" <?php if($fetch_review['user_id'] == $user_id){echo 'style="order: -1;"';}; ?>>
      <?php
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_user->execute([$fetch_review['user_id']]);
         while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="user">
         <?php if($fetch_user['image'] != ''){ ?>
            <img src="uploaded_files/<?= $fetch_user['image']; ?>" alt="">
         <?php }else{ ?>   
            <h3><?= substr($fetch_user['name'], 0, 1); ?></h3>
         <?php }; ?>   
         <div>
            <p><?= $fetch_user['name']; ?></p>
            <span><?= $fetch_review['date']; ?></span>
         </div>
      </div>
      <?php }; ?>
      
      <h3 class="title"><?= $fetch_review['title']; ?></h3>
      <?php if($fetch_review['description'] != ''){ ?>
         <p class="description"><?= $fetch_review['description']; ?></p>
      <?php }; ?>  
      <?php if($fetch_review['user_id'] == $user_id){ ?>
         <form action="" method="post" class="flex-btn" style="justify-content: flex-end;">
            <input type="hidden" name="delete_id" value="<?= $fetch_review['id']; ?>">
            <!--<a href="update_review.php?get_id= <?= $fetch_review['id']; ?>" class="inline-option-btn">edit review</a>-->
            <input type="submit" value="delete review" class="inline-delete-btn" name="delete_review" onclick="return confirm('delete this review?');">
</form>
      <?php }; ?>   
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no reviews added yet!</p>';
      }
   ?>

   </div>
   

</section>

<!-- reviews section ends -->













<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>
