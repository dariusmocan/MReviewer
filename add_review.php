<?php

include 'components/connect.php';

    // Retrieve parameters from the URL
    $postId = isset($_GET['id']) ? $_GET['id'] : '';
    $titlu = isset($_GET['title']) ? urldecode($_GET['title']) : '';
    $overview = isset($_GET['overview']) ? urldecode($_GET['overview']) : '';
    $image = isset($_GET['image']) ? urldecode($_GET['image']) : '';
    $voteAverage = isset($_GET['vote_average']) ? $_GET['vote_average'] : '';

    /*
    echo "<p>Post ID: $postId</p>";
    echo "<p>Title: $title</p>";
echo "<p>Overview: $overview</p>";
echo "<p>Vote Average: $voteAverage</p>";
echo "<img src='$image' alt='Movie Poster'>";*/


if(isset($_POST['submit'])){

   if($user_id != ''){

      $id = create_unique_id();
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $description = $_POST['description'];
      $description = filter_var($description, FILTER_SANITIZE_STRING);
      $rating = $_POST['rating'];
      $rating = filter_var($rating, FILTER_SANITIZE_STRING);

      $verify_review = $conn->prepare("SELECT * FROM `reviews` WHERE post_id = ? AND user_id = ?");
      $verify_review->execute([$postId, $user_id]);

      if($verify_review->rowCount() > 0){
         $warning_msg[] = 'Your review already added!';
      }else{
         $add_review = $conn->prepare("INSERT INTO `reviews`(id, post_id, user_id, rating, title, description) VALUES(?,?,?,?,?,?)");
         $add_review->execute([$id, $postId, $user_id, $rating, $title, $description]);
         $success_msg[] = 'Review added!';
      }

   }else{
      $warning_msg[] = 'Please login first!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add review</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<!-- add review section starts  -->

<section class="account-form">

   <form action="" method="post">
      <h3>post your review</h3>
      <p class="placeholder">review title <span>*</span></p>
      <input type="text" name="title" required maxlength="50" placeholder="enter review title" class="box">
      <p class="placeholder">review description</p>
      <textarea name="description" class="box" placeholder="enter review description" maxlength="1000" cols="30" rows="10"></textarea>
      <p class="placeholder">review rating <span>*</span></p>
      <select name="rating" class="box" required>
         <option value="1">1</option>
         <option value="2">2</option>
         <option value="3">3</option>
         <option value="4">4</option>
         <option value="5">5</option>
         <option value="6">6</option>
         <option value="7">7</option>
         <option value="8">8</option>
         <option value="9">9</option>
         <option value="10">10</option>
      </select>
      <input type="submit" value="submit review" name="submit" class="btn">
      <a href="view_post.php?get_id= <?=$postId?>&title=<?= urlencode($titlu) ?>&overview=<?= urlencode($overview) ?>&image=<?= urlencode($image) ?>&vote_average=<?= $voteAverage ?>" class="inline-option-btn" style="margin-top: 0;">go back</a>
   </form>

</section>

<!-- add review section ends -->














<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>
