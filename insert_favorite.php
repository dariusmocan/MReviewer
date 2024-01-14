<?php

include 'components/connect.php';

$response = array();

// Retrieve data from the POST request
if ($user_id != '') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    $overview = isset($_POST['overview']) ? $_POST['overview'] : '';
    $voteAverage = isset($_POST['vote_average']) ? $_POST['vote_average'] : '';


    $verify_fav = $conn->prepare("SELECT * FROM `favorite` WHERE id = ? AND user_id = ?");
    $verify_fav->execute([$id, $user_id]);


    if($verify_fav->rowCount() > 0){
        $warning_msg[] = 'The movie is already added to your favorites';

     }else{
    // Insert data into the 'favorite' table
    $sql = "INSERT INTO `favorite` (id, title, image, overview, voteAverage, user_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $title);
        $stmt->bindParam(3, $image);
        $stmt->bindParam(4, $overview);
        $stmt->bindParam(5, $voteAverage);
        $stmt->bindParam(6, $user_id);

        if ($stmt->execute()) {
            // Redirect to the desired page
            //header('Location: all_posts.php');
            //exit();
            $success_msg[] = 'Movie added to favorites';
            
        } else {
            $warning_msg[] = 'Please login first!';
        }
    } else {
        $warning_msg[] = 'Please login first!';
    }
}
} else {
    $warning_msg[] = 'Please login first!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
    
<script src="js/script2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<?php include 'components/alers.php'; ?>
</body>
</html>
