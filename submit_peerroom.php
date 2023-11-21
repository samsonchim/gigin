<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gigi';

// Create a PDO database connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Process the Form Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and sanitize form data
    $title = htmlspecialchars($_POST["title"]);
    $description = htmlspecialchars($_POST["description"]);
    $time_needed = intval($_POST["time_needed"]);
    $people = intval($_POST["people"]);
    $category = htmlspecialchars($_POST["category"]);
    $language = htmlspecialchars($_POST["language"]);
    
   // Convert Date and Time to West Africa Time (WAT)
$datetime_str = $_POST["datetime"];
$user_timezone = isset($_COOKIE['user_timezone']) ? $_COOKIE['user_timezone'] : 'UTC';

// Create a DateTime object with the user's datetime input and their specified timezone
$user_timezone_obj = new DateTimeZone($user_timezone);
$datetime = new DateTime($datetime_str, $user_timezone_obj);

// Convert the datetime to West Africa Time (WAT)
$datetime->setTimezone(new DateTimeZone('Africa/Lagos')); // Set to Lagos, Nigeria's timezone (WAT)
$formatted_datetime = $datetime->format('Y-m-d H:i:s');


    // Generate a meeting ID
    $meetingID = generateMeetingID();

    // Store Data in the Database
    $sql = "INSERT INTO posts (title, description, time_needed, people, category, language, datetime, meeting_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $time_needed, $people, $category, $language, $formatted_datetime, $meetingID]);

// ...
// After successfully inserting the post into the 'posts' table
if ($stmt->rowCount() > 0) {
    // Success: Data inserted into the 'posts' table
    $postID = $pdo->lastInsertId(); // Get the ID of the newly inserted post

    // Add the user who created the group to the 'peer_members' table
    $userID = 1; // Replace with the actual user ID of the creator
    $addMemberSQL = "INSERT INTO peer_members (post_id, people) VALUES (?, ?)";
    $addMemberStmt = $pdo->prepare($addMemberSQL);
    $initialMembers = $userID; // The creator is the initial member
    $addMemberStmt->execute([$postID, $initialMembers]);

    // Decrease the 'people' count by 1 in the 'posts' table
    $updatePeopleSQL = "UPDATE posts SET people = people - 1 WHERE id = ?";
    $updatePeopleStmt = $pdo->prepare($updatePeopleSQL);
    $updatePeopleStmt->execute([$postID]);

    // Check if 'people' count reached 0, and if so, prevent further additions
    if ($people - 1 <= 0) {
        // Add logic here to prevent further additions, such as disabling join buttons, etc.
    }

    // Automatically join the user to the 'peer_members' table
    $joinMemberSQL = "UPDATE peer_members SET people = CONCAT(people, ', ', ?) WHERE post_id = ?";
    $joinMemberStmt = $pdo->prepare($joinMemberSQL);
    $joinMemberStmt->execute([$userID, $postID]);

    // Redirect to peerroom_details.php with the post ID as a parameter
    //$redirectURL = 'peerroom_details.php?id=' . $postID;
    //header('Location: ' . $redirectURL);
    //exit(); // Terminate the script after redirect
} else {
    // Error: Database insertion failed
    echo "Error: " . $stmt->errorInfo()[2];
}


    // Close the database connection
    $pdo = null;
}

// Function to generate a random meeting ID
function generateMeetingID() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $meetingID = '';
    for ($i = 0; $i < 5; $i++) {
        $randomIndex = mt_rand(0, strlen($characters) - 1);
        $meetingID .= $characters[$randomIndex];
    }
    return $meetingID;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metting ID </title>

    <style>
        body,
html {
    padding: 0;
    margin: 0;
    font-family: 'Quicksand', sans-serif;
    font-weight: 400;
    overflow: hidden;
}

.writing {
    width: 320px;
    height: 200px;
    background-color: #3f3f3f;
    border: 1px solid #bbbbbb;
    border-radius: 6px 6px 4px 4px;
    position: relative;
}

.writing .topbar{
    position: absolute;
    width: 100%;
    height: 12px;
    background-color: #f1f1f1;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}

.writing .topbar div{
    height: 6px;
    width: 6px;
    border-radius: 50%;
    margin: 3px;
    float: left;
}

.writing .topbar div.green{
    background-color: #60d060;
}
.writing .topbar div.red{
    background-color: red;
}
.writing .topbar div.yellow{
    background-color: #e6c015;
}

.writing .code {
    padding: 15px;
}

.writing .code ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.writing .code ul li {
    background-color: #9e9e9e;
    width: 0;
    height: 7px;
    border-radius: 6px;
    margin: 10px 0;
}

.container {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    height: 100vh;
    width: 100%;
    -webkit-transition: -webkit-transform .5s;
    transition: -webkit-transform .5s;
    transition: transform .5s;
    transition: transform .5s, -webkit-transform .5s;
}

.stack-container {
    position: relative;
    width: 420px;
    height: 210px;
    -webkit-transition: width 1s, height 1s;
    transition: width 1s, height 1s;
}

.pokeup {
    -webkit-transition: all .3s ease;
    transition: all .3s ease;
}

.pokeup:hover {
    -webkit-transform: translateY(-10px);
            transform: translateY(-10px);
    -webkit-transition: .3s ease;
    transition: .3s ease;
}


.error {
    width: 400px;
    padding: 40px;
    text-align: center;
}

.error h1 {
    font-size: 125px;
    padding: 0;
    margin: 0;
    font-weight: 700;
}

.error h2 {
    margin: -30px 0 0 0;
    padding: 0px;
    font-size: 47px;
    letter-spacing: 12px;
}

    </style>
</head>
<body>
    <div class="meetingID"></div>



    <div class="container">
        <div class="error">
            <h5>ROOM CREATEED</h5>
            <h5>ROOM ID: <?php echo $meetingID?></h5>
            <p>Pass along the code to your friends so they can be a part of it.</p>
            <h4><a href="home.php">Continue</a></h4>
        </div>
</div>
      
                 
</body>
</html>