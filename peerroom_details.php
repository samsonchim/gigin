<?php

session_start(); // Start the session

// Check if a specific session variable exists (e.g., user_id)
if (!isset($_SESSION['id'])) {
    // Redirect the user to getstarted.php
    header("Location: getstarted.php");
    exit(); // Make sure to exit after the header redirect
}

// Rest of your code here...

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

// Retrieve the post ID from the URL parameters
if (isset($_GET['id'])) {
    $postID = intval($_GET['id']);

    // Query the database to fetch the details of the post
   // Query the database to fetch the details of the post including meeting_id
$sql = "SELECT *, meeting_id FROM posts WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$postID]);

// After fetching the post details
if ($stmt->rowCount() > 0) {
  // Post found, display its details
  $post = $stmt->fetch(PDO::FETCH_ASSOC);

  // Convert UTC datetime to West Africa Time (WAT)
$utcDatetime = new DateTime($post['datetime'], new DateTimeZone('UTC'));
$watTimezone = new DateTimeZone('Africa/Lagos'); // Set to Lagos, Nigeria's timezone (WAT)
$watDatetime = $utcDatetime->setTimezone($watTimezone);

// Format the datetime in the desired format
$formattedDatetime = $watDatetime->format('l jS F, g:ia (T)');
$post['datetime'] = $formattedDatetime;

// Now you can access the meeting_id using $post['meeting_id']
$meetingID = $post['meeting_id'];



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home</title>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
</head>
        <body>

        <?php


// Create a PDO database connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Initialize variables
$meetingID = "";
$message = "";

// Retrieve the post ID from the URL parameters
if (isset($_GET['id'])) {
    $postID = intval($_GET['id']);

    // Query the database to fetch the details of the post
    $sql = "SELECT *, meeting_id, people FROM posts WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$postID]);

    if ($stmt->rowCount() > 0) {
        // Post found, display its details
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        $meetingID = $post['meeting_id'];
        $remainingPeople = $post['people'];

      // Convert UTC datetime to West Africa Time (WAT)
$utcDatetime = new DateTime($post['datetime'], new DateTimeZone('UTC'));
$watTimezone = new DateTimeZone('Africa/Lagos'); // Set to Lagos, Nigeria's timezone (WAT)
$watDatetime = $utcDatetime->setTimezone($watTimezone);


        // Format the datetime in the desired format
        $formattedDatetime = $watDatetime->format('l jS F, g:ia (T)');
        $post['datetime'] = $formattedDatetime;
    }}
        // Check if the user has already joined
        if (isset($_SESSION['id'])) {
          $userID = $_SESSION['id']; // Retrieve user ID from session
      
          // Check if the join button was clicked
          if (isset($_POST['join'])) {
              $checkJoinedSQL = "SELECT * FROM peer_members WHERE post_id = ? AND user_id = ?";
              $checkJoinedStmt = $pdo->prepare($checkJoinedSQL);
              $checkJoinedStmt->execute([$postID, $userID]);
      
              if ($checkJoinedStmt->rowCount() > 0) {
                  // User has already joined
                  $message = 'You are already in this room.';
              } else {
                  if ($remainingPeople <= 0) {
                      // Room is full
                      $message = 'Room is full. Why not create a room?';
                  } else {
                      // User can join
                      // Add the user to the room in the room_members table
                      $addUserToPeerSQL = "INSERT INTO peer_members (post_id, user_id, people) VALUES (?, ?, ?)";
                      $addUserToPeerStmt = $pdo->prepare($addUserToPeerSQL);
                      $addUserToPeerStmt->execute([$postID, $userID, $remainingPeople]);
      
                      // Decrease the 'people' count by 1 in the posts table
                      $updatePeopleSQL = "UPDATE posts SET people = people - 1 WHERE id = ?";
                      $updatePeopleStmt = $pdo->prepare($updatePeopleSQL);
                      $updatePeopleStmt->execute([$postID]);
      
                      // Check if 'people' count reached 0
                      if ($remainingPeople - 1 <= 0) {
                          $message = 'Room is full. ' . '<a href="peerroom.php">Why not click here to create a room?</a?';
                      } else {
                          $message = 'You have successfully joined this room. Meeting ID: ' . $meetingID;
                      }
                  }
              }
          }
      } else {
          $message = "User ID not found in session.";
      }
      
// Close the database connection
$pdo = null;

if (isset($_POST['share'])) {
 
  $currentURL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $fullMessage = $message . $currentURL;
  
  $message = "Here is the meeting link:" . $fullMessage;
}
?>


          

			<header class="container ">
        
      <div class="message"><?php echo $message; ?></div>

  <h1 class="title"><?php echo $post['title']; ?></h1>
</header>

<section class="container container--content">
  <div class="split post-lists">
    <div class="post-list">DESCRIPTION:  <a href="#">
	
    </div>
    <div><?php echo $post['description']; ?></a></div>
  </div>

  <div class="split post-lists">
    <div class="post-list"><a href="#">
	TIME NEEDED: </a>
    </div>
    <div><?php echo $post['time_needed']; ?> MINUTES</div>
  </div>

  <div class="split post-lists">
    <div class="post-list"><a href="#">
        CATEGORY: </a>
    </div>
    <div> <?php echo $post['category']; ?> </div>
  </div>

  <div class="split post-lists">
    <div class="post-list"><a href="#">
        LANGUAGE: </a>
    </div>
    <div> <?php echo $post['language']; ?> </div>
  </div>

  <div class="datetime"><a href="#"> 
        DAY & TIME:  <?php echo $post['datetime']; ?> </a>
    </div>

	<hr>
	<div class="btn-container">
        <form method="post">
            <button class="btn-archives" type="submit" name="join"><i class="fa fa-home"></i> Okay Join</button>
            <button class="btn-archives" type="submit" name="share"><i class="fa fa-home"></i> Share Room</button>
        </form>
    </div>

<!-- HTML Output -->


<p>Go back to <a href="home.php">Home &rarr;</a></p>
</section>


        </body>
        </html>
        <?php
    } else {
        echo "Post not found.";
    }
} else {
    echo "Post ID not provided in the URL.";
}

// Close the database connection
$pdo = null;
?>

<style>
	@import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&display=swap');
	*,
:after,
:before {
  box-sizing: border-box;
  font:600 16px/18px 'Inclusive Sans', sans-serif;
}


body {
  font-family: 'Inclusive Sans', sans-serif;
  line-height: 1.333;
  color: var(--color-primary);
  font-size: var(--font-size-base);
  min-height: 100%;
  background-color: var(--color-body-bg);
}
.title{
	font-size: 25px;
}

h1, h2, h3, h4 {
  margin: 1.6rem 0 1.38rem;
  line-height: 60px;
  font-size: 20px;
}

img,
svg,
picture {
  max-width: 50%;
  display: block;
}

.datetime{
	text-align:center;
}
a {
  color: var(--color-primary);
  text-decoration: none;
}

a:hover {
  color: var(--color-accent);
}

.container {
  width: 100%;
  max-width: 40rem;
  margin-inline: auto;
  padding: 0 1.5rem;
}

.container--header {
  padding: 12rem 0 0 0;
}

.container--content {
  margin-bottom: 3rem;
}

.user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin: -20px; /* Adjust the margin for overlapping effect */
            position: relative;
            display: inline-block;
            background-size: cover;
        }

.split {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
}

.post-lists {
  margin-bottom: 1rem;
  text-align: right;

}

.post-list {
  max-width: 85%;
  color: #6f3e37;
}



.btn-archives {
	background-color: #6f3e37;
	color: white;
  padding: 0.615rem 1.455rem;
  border: 0.015em solid var(--color-light);
  border-radius: 0.215em;
  margin: 2.6rem auto;
  cursor: pointer;
  text-align: center;
  box-shadow: 0 0 #ccc;
  transition: box-shadow ease 0.5s, border ease 0.5s, background-color ease 1.5s;
}

.btn-archives:hover {
  box-shadow: 0.15rem 0.15rem #462924;
  border: 0.015em solid var(--color-accent);
  background-color: #462924;
}

.btn-container {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 100%;
}

.message {
    padding: 2vmin 5vmin 2vmin 10vmin;
    border-radius: 0px 50px 50px 0px ;
    border: 5px #6f3e37;
    font-size: 3vmin;
    text-align: left;
    text-align: center;
    line-height: 30px;
}

.about-section {
  background-color: rgba(255, 255, 255, 90%);
  padding: 8rem 0;
  border-top: 2px solid var(--color-light);
  border-bottom: 2px solid var(--color-light);
}

.about-section div h2 {
  margin: 0;
}

.about-section a {
  color: var(--color-primary);
  text-decoration: underline;
}

.about-section a:hover {
  color: var(--color-accent);
  text-decoration: none;
}

.footer {
  text-align: center;
  padding: 1rem 0;
}

.clr-mastodon {
  color: var(--color-mastodon);
}

.clr-twitter {
  color: var(--color-twitter);
}

.clr-github {
  color: var(--color-github);
}

@media screen and (min-width: 485px) {
  body {
    line-height: 1.75;
  }
  h1 {
    font-size: calc(4.209rem + 1.2vmin);
  }
}

</style>