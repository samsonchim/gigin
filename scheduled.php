<?php
session_start(); // Start the session

// Check if a specific session variable exists (e.g., user_id)
if (!isset($_SESSION['id'])) {
    // Redirect the user to the login page or handle unauthorized access
    header("Location: getstarted.php");
    exit(); // Make sure to exit after the header redirect
}

$servername = 'localhost';
$username = 'giginetn_user';
$password = 'Iamthatiam1!';
$dbname = 'giginetn_gigi';

// Create a PDO database connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Retrieve the active user's ID from the session
$activeUserID = $_SESSION['id'];

// Query the peer_members table to fetch post IDs for the active user
$getPostIDsSQL = "SELECT post_id FROM peer_members WHERE user_id = ?";
$getPostIDsStmt = $pdo->prepare($getPostIDsSQL);
$getPostIDsStmt->execute([$activeUserID]);

// Initialize an array to store post details
$scheduledPosts = [];

// Fetch post details for each post ID
// Fetch post details for each post ID
while ($row = $getPostIDsStmt->fetch(PDO::FETCH_ASSOC)) {
    $postID = $row['post_id'];

    // Query the posts table to fetch post details
    // Query the posts table to fetch post details, including 'post_id'
$getPostDetailsSQL = "SELECT id, title, datetime, meeting_id FROM posts WHERE id = ?";
    $getPostDetailsStmt = $pdo->prepare($getPostDetailsSQL);
    $getPostDetailsStmt->execute([$postID]);

    // Fetch and store post details in the array
    if ($postDetails = $getPostDetailsStmt->fetch(PDO::FETCH_ASSOC)) {

        // Convert UTC datetime to Eastern Daylight Time (EDT)
        $utcDatetime = new DateTime($postDetails['datetime'], new DateTimeZone('UTC'));
        $watTimezone = new DateTimeZone('Africa/Lagos');
        $watDatetime = $utcDatetime->setTimezone($watTimezone);

        // Format the datetime in the desired format
        $formattedDatetime = $watDatetime->format('l jS F, g:ia (T)');

        $postDetails['datetime'] = $formattedDatetime;
        $scheduledPosts[] = $postDetails;
    }
}

// Close the database connection
$pdo = null;

// Now, $scheduledPosts contains details of scheduled posts for the active user
?>

<!-- Display scheduled posts -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduled Posts</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&display=swap');
body{
	color:#0b0b0c;
	font:600 16px/18px 'Inclusive Sans', sans-serif;
    margin: 0;
    padding: 0;
    align-items: center;
    background: #EEE; 
    line-height: 30px;
    
}


        h1 {
            color: #0b0b0c;
            text-align: center;
            padding: 20px 0;
            margin: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ccc;
            margin: 10px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin: 0;
            color: #333;
        }

        p {
            margin: 5px 0;
            color: #666;
        }

        .go-to-room-button {
            background-color: #6f3e37;
      color: white;
      width: 90px!important;
      padding: 10px 18px !important;
      border-radius: 3px!important;
      text-align: center;
      text-decoration: none;
      display: block!important;
      margin-top: 20px!important;
      margin-left: 30px!important;
      margin-right: 70px!important;
      font-size: 12px!important;
      cursor: pointer!important;
        }

     
        .go-to-room-button:hover {
            background-color: #462924;
    border-radius: 30px;
    transform: translate(5px, 5px);
        }

        .rooms {
  width: 40%;
  margin: 0 auto; /* Center horizontally */
}

/* For responsiveness, you can add a media query for smaller screens */
@media (max-width: 768px) {
  .rooms {
    width: 90%; /* Adjust width for smaller screens */
  }
}

a{
    text-decoration:none;
}
    </style>
</head>

<body>
    <h1>Scheduled Room</h1>
    <div class="rooms">
    <ul>
    <?php foreach ($scheduledPosts as $post): ?>
    <li>
        <h2><?php echo $post['title']; ?></h2>
        <p>Date & Time: <?php echo $post['datetime']; ?><br><i>Please convert WAT to your local time.</i></p>
        <p>Meeting ID: <?php echo $post['meeting_id']; ?></p><hr>
        <a href="https://call-production-5542.up.railway.app/<?php echo $post['meeting_id']; ?>"><div class="go-to-room-button">Enter Room</div></a>

    </li>
<?php endforeach; ?>


    </ul>
    </div>
</body>
</html>

