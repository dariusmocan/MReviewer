<?php
include 'components/connect.php';

if (isset($_POST['delete_review_id'])) {
   $reviewId = $_POST['delete_review_id'];
   $reviewId = filter_var($reviewId, FILTER_SANITIZE_STRING);

   $verifyRemove = $conn->prepare("SELECT * FROM `reviews` WHERE id = ?");
   $verifyRemove->execute([$reviewId]);

   if ($verifyRemove->rowCount() > 0) {
      $removeFavorite = $conn->prepare("DELETE FROM `reviews` WHERE id = ?");
      $removeSuccess = $removeFavorite->execute([$reviewId]);

      // Check if the removal was successful
      if ($removeSuccess) {
          $successMsg[] = 'Movie removed from favorites!';
          // Add a JavaScript script to reload the page
          echo '<script>window.location.reload();</script>';
      } else {
          $warningMsg[] = 'Failed to remove movie from favorites!';
      }
  } else {
      $warningMsg[] = 'Movie not found in favorites!';
  }

}

// Assuming you have a user_id to identify the user's reviews
// Change $user_id to the actual user_id you want to retrieve reviews for

// Fetch reviews for the specific user
$fetch_reviews = $conn->prepare("SELECT id, movie_title, title, description, rating, date FROM `reviews` WHERE user_id = ?");
$fetch_reviews->execute([$user_id]);
$user_reviews = $fetch_reviews->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Reviews</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="reviewscript.css">
</head>
<body>
<header>
    <?php include 'components/header.php'; ?>
</header>

<section>
    <h2 style="color:white">Your Reviews:</h2> 

    <?php if (!empty($user_reviews)) : ?>
        <ul class="review-list">
            <?php foreach ($user_reviews as $review) : ?>
                <li class="review">
                    <h3><?= $review['movie_title']; ?></h3>
                    <p><strong>Title:</strong> <?= $review['title']; ?></p>
                    <p><strong>Description:</strong> <?= $review['description']; ?></p>
                    <p><strong>Rating:</strong> <?= $review['rating']; ?></p>
                    <p><strong>Date:</strong> <?= $review['date']; ?></p>
                    <form action="" method="post" class="delete-review-form">
                        <input type="hidden" name="delete_review_id" value="<?= $review['id']; ?>">
                        <button type="submit" class="know-more" onclick="return confirm('Delete this review?')">Delete Review</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No reviews found.</p>
    <?php endif; ?>
</section>

<!-- SweetAlert CDN link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Custom JS file link  -->
<script src="js/script.js"></script>

</body>
</html>
