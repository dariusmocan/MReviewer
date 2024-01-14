<?php
include 'components/connect.php';

// Assuming you have a user_id to identify the favorites for a specific user
// Change $user_id to the actual user_id you want to retrieve favorites for

// Fetch favorite movies for the specific user
$fetch_favorites = $conn->prepare("SELECT * FROM `favorite` WHERE user_id = ?");
$fetch_favorites->execute([$user_id]);
$favorite_movies = $fetch_favorites->fetchAll(PDO::FETCH_ASSOC);

    $postId = isset($_GET['id']) ? $_GET['id'] : '';
    $title = isset($_GET['title']) ? urldecode($_GET['title']) : '';
    $overview = isset($_GET['overview']) ? urldecode($_GET['overview']) : '';
    $image = isset($_GET['image']) ? urldecode($_GET['image']) : '';
    $voteAverage = isset($_GET['vote_average']) ? $_GET['vote_average'] : '';




    if (isset($_POST['remove_fav'])) {
        $movieId = $_POST['remove_id'];
        $movieId = filter_var($movieId, FILTER_SANITIZE_STRING);
    
        $verifyRemove = $conn->prepare("SELECT * FROM `favorite` WHERE id = ?");
        $verifyRemove->execute([$movieId]);
    
        $successMsg[] = 'Movie removed from favorites!';

        $removeFavorite = $conn->prepare("DELETE FROM `favorite` WHERE id = ?");
        $removeFavorite->execute([$movieId]);
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>favorites</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="favscript.css">

</head>
<body>
<header>
<?php include 'components/header.php'; ?>
</header>


<!-- Replace your existing HTML with this -->

<section class="favorites-section">
    <h2 style="color:white">Your Favorite Movies:</h2>

    <?php if (!empty($favorite_movies)) : ?>
        <ul class="movie-list">
            <?php foreach ($favorite_movies as $movie) : ?>

                <li class="movie">
                    <img src="<?= $movie['image'] ?>" alt="<?= $movie['title'] ?>" class="image">
                    <div class="movie-details">
                        <a href="view_post.php?id=<?= $movie['id'] ?>&title=<?= urlencode($movie['title']) ?>&overview=<?= urlencode($movie['overview']) ?>&image=<?= urlencode($movie['image']) ?>&vote_average=<?= $voteAverage ?>"><?php echo $movie['title']; ?></a>
                        <p><?php echo $movie['overview']; ?></p>

                        <!-- Add a form and an input button for removal -->
                        <form action="" method="post" class="remove-favorite-form">
                            <input type="hidden" name="remove_id" value="<?= $movie['id'] ?>">
                            <input type="submit" value="Remove" class="inline-delete-btn" name="remove_fav" onclick="return confirm('Remove from favorites?');">
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No favorite movies found.</p>
    <?php endif; ?>
</section>


<!-- SweetAlert CDN link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Custom JS file link  -->
<script src="js/script.js"></script>

</body>
</html>
