<?php

include 'components/connect.php';

if(isset($_POST['add_to_fav'])){

   /*$product_name = $_POST['product_name'];
   $product_image = $_POST['product_image'];

   $insert_product = mysqli_query($conn, "INSERT INTO `favorite`(name, image) VALUES('$product_name', '$product_image')");
   */
   $message[] = 'added to favorites succesfully';
   

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MReviewer</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<!-- view all posts section starts  -->

<section class="all-posts">

   <div class="heading"><h1>all movies:</h1></div>

   <div class="box-container">

   <?php
      $select_posts = $conn->prepare("SELECT * FROM `posts`");
      $select_posts->execute();
      if($select_posts->rowCount() > 0){
         while($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)){

         $post_id = $fetch_post['id'];

         $count_reviews = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
         $count_reviews->execute([$post_id]);
         $total_reviews = $count_reviews->rowCount();
         $total_ratings = 0;
        $rating_1 = 0;
        $rating_2 = 0;
        $rating_3 = 0;
        $rating_4 = 0;
        $rating_5 = 0;

        $select_ratings = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
        $select_ratings->execute([$fetch_post['id']]);
        $total_reivews = $select_ratings->rowCount();
        while($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)){
            $total_ratings += $fetch_rating['rating'];
            if($fetch_rating['rating'] == 1){
               $rating_1 += $fetch_rating['rating'];
            }
            if($fetch_rating['rating'] == 2){
               $rating_2 += $fetch_rating['rating'];
            }
            if($fetch_rating['rating'] == 3){
               $rating_3 += $fetch_rating['rating'];
            }
            if($fetch_rating['rating'] == 4){
               $rating_4 += $fetch_rating['rating'];
            }
            if($fetch_rating['rating'] == 5){
               $rating_5 += $fetch_rating['rating'];
            }
        }

        if($total_reivews != 0){
            $average = round($total_ratings / $total_reivews, 1);
        }else{
            $average = 0;
        }
      


      
   ?>
   <div class="box">
   <form action="" method="post">
      <img src="uploaded_files/<?= $fetch_post['image']; ?>" alt="" class="image">
      <h3 class="title"><?= $fetch_post['title']; ?></h3>
      <p class="total-reviews"><i class="fas fa-star"></i> <span><?= $average; ?> </span></p>
      <a href="view_post.php?get_id=<?= $post_id; ?>" class="inline-btn">view post </a>

      <input type="hidden" name="product_title" value="<?php echo $fetch_product['title']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <input type="submit" value="add to fav" name="add_to_fav" class="btn">
   </form>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no posts added yet!</p>';
   }
   ?>

   </div>

</section>

<!-- view all posts section ends -->















<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>