<?php
session_start();
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

    if ($verify_fav->rowCount() > 0) {
        $response['success'] = false;
        $response['message'] = 'The movie is already added to your favorites';
    } else {
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
                $response['success'] = true;
                $response['message'] = 'Movie added to favorites';
            } else {
                $response['success'] = false;
                $response['message'] = 'Please login first!';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Please login first!';
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Please login first!';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
