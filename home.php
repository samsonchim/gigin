<?php
session_start();

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

// Construct an SQL query to fetch all posts (adjust the table name if needed)
$sql = "SELECT * FROM posts";

$posts = array(); // Initialize an array to store posts

$postsPerPage = 2; // Number of posts to display per page
$totalPosts = count($posts); // Total number of posts
$totalPages = ceil($totalPosts / $postsPerPage); // Calculate total pages
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; // Get the current page from the query string
$offset = ($currentPage - 1) * $postsPerPage; // Calculate the offset for the SQL query

// Construct an SQL query to fetch a limited number of posts based on pagination
$sql = "SELECT * FROM posts LIMIT $offset, $postsPerPage";

try {
    // Execute the SQL query
    $stmt = $pdo->query($sql);

    // Fetch all posts and store them in the $posts array
    $posts = []; // Reset the $posts array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Store the original datetime without modification
        $row['datetime'] = $row['datetime'];
        $posts[] = $row;
    }
} catch (PDOException $e) {
    // Handle database query error
    echo 'Database error: ' . $e->getMessage();
}

// Close the database connection
$pdo = null;






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

// Construct an SQL query to fetch all posts (adjust the table name if needed)
$sql = "SELECT * FROM live";

$posts = array(); // Initialize an array to store posts

$postsPerPage = 2; // Number of posts to display per page
$totalPosts = count($posts); // Total number of posts
$totalPages = ceil($totalPosts / $postsPerPage); // Calculate total pages
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; // Get the current page from the query string
$offset = ($currentPage - 1) * $postsPerPage; // Calculate the offset for the SQL query

// Construct an SQL query to fetch a limited number of posts based on pagination
$sql = "SELECT * FROM live LIMIT $offset, $postsPerPage";

try {
    // Execute the SQL query
    $stmt = $pdo->query($sql);

    // Fetch all posts and store them in the $posts array
    $posts = array(); // Reset the $posts array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Store the original datetime without modification
        $row['datetime'] = $row['datetime'];
        $posts[] = $row;
    }
} catch (PDOException $e) {
    // Handle database query error
    echo 'Database error: ' . $e->getMessage();
}

// Close the database connection
$pdo = null;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<header   id="nav">
<div class="nav--list">
            <a href="index.php"/>
                <h3 id="logo">
                    <img src="logo.png" alt="Site Logo">
                    <span>gigi</span>
                </h3>
            </a>
       </div>

        <div id="nav__links">
            <a class="nav__link" href="scheduled.php">
                Scheduled Rooms
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#6f3e37" viewBox="0 0 24 24">
   <svg width="24" height="24" viewBox="0 0 24 24" fill="#6f3e37" xmlns="http://www.w3.org/2000/svg"><path d="M2.898 12.581a2.467 2.467 0 0 1 2.073-.538 2.38 2.38 0 0 1 1.42.871l.419-1.023a3.39 3.39 0 0 0-.707-.489 2.5 2.5 0 1 0-3.215-.006 3.454 3.454 0 0 0-.631.418A3.491 3.491 0 0 0 1 14.5V16h1v-1.5a2.492 2.492 0 0 1 .898-1.919zM3 9.5A1.5 1.5 0 1 1 4.5 11 1.502 1.502 0 0 1 3 9.5zm18.103 1.902a2.5 2.5 0 1 0-3.215-.007 3.448 3.448 0 0 0-.631.419c-.026.021-.044.05-.07.072l.412 1.006a2.407 2.407 0 0 1 2.372-.849A2.608 2.608 0 0 1 22 14.646V16h1v-1.354a3.647 3.647 0 0 0-1.897-3.244zM18 9.5a1.5 1.5 0 1 1 1.5 1.5A1.502 1.502 0 0 1 18 9.5zM10 9V8a1.99 1.99 0 0 1 .764-1.572 2.02 2.02 0 0 1 1.739-.367A2.08 2.08 0 0 1 14 8.119V9h1v-.88a3.173 3.173 0 0 0-1.445-2.678 2.5 2.5 0 1 0-3.1.009 2.956 2.956 0 0 0-.31.192A2.984 2.984 0 0 0 9 8v1zm.5-5.5A1.5 1.5 0 1 1 12 5a1.502 1.502 0 0 1-1.5-1.5zm9.463 17.81l-.926.38L14.664 11H9.336L4.963 21.69l-.926-.38L8.41 10.622A.997.997 0 0 1 9.336 10h5.328a.996.996 0 0 1 .925.62z"/></svg>
</svg>

            </a>
            <a class="nav__link" id="create__room__btn" href="https://call-production-5542.up.railway.app/">
               Enter a room
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#6f3e37" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg>
            </a>
        </div>
</header>
<body>

<div class="container-1">
    <input type="checkbox" id="toggle" checked />
    <label class="button-1" for="toggle">
        <nav class="nav">
            <ul>
                <li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
             <!--   <li><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i></a></li> --->
                <li><a href="scheduled.php"><i class="fa fa-calendar-alt" aria-hidden="true"></i></a></li>
                <li><a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i></a></li>
            </ul>
        </nav>
    </label>
</div>


      <div class="menu-container">
   <!-- <div class="menu active-menu" id="menu1">Peer Learning </div>
    <div class="menu" id="menu2">Live Learning</div> --->
</div>
<br> <br><br> <br>
<div class="menu-content-container">
    <div class="menu-content" id="menu-content1">
        <h5 class="title">Connect with other people who share your interests in a dedicated space to learn and grow together</h5>
        <form id="search-form">
        <select id="search" name="category" placeholder="Search by Category">
    <option>Search By Category</option>
    <option value="Mathematics">Math</option>
      <option value="Science">Science</option>
      <option value="Creativity">Creativity</option>
      <option value="Mental Health">Mental Health</option>
      <option value="History">History</option>
      <option value="Religion">Religion</option>
      <option value="Personal Reflection">Personal Reflection</option>
      <option value="Programming">Programming</option>
      <option value="Computer Science">Computer Science</option>
      <option value="Languages">Languages</option>
      <option value="Arts and Music">Arts and Music</option>
      <option value="Business">Business</option>
  <option value="Personal Development">Personal Development</option>
  <option value="Design">Design</option>
  <option value="Photography">Photography</option>
  <option value="Video Editing">Video Editing</option>
  <option value="Cooking and Baking">Cooking and Baking</option>
    <!-- Add more interest options as needed -->
</select>

            <button class="button1" type="submit">Search <i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <Br></Br>
        <?php
try {
    // Establish the database connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the current datetime without time zone conversion
    $now = new DateTime();
    $nowStr = $now->format('Y-m-d H:i:s');

    // Delete posts that have passed their datetime by 10 hours
    $deleteSql = "DELETE FROM posts WHERE datetime < :nowStr";
    $deleteStmt = $pdo->prepare($deleteSql);
    $deleteStmt->bindParam(':nowStr', $nowStr, PDO::PARAM_STR);
    $deleteStmt->execute();
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}

    if (!$deleteStmt->rowCount()) {
      //  echo "<p>New Rooms were created.</p>";
    } else {
       // echo "<p>{$deleteStmt->rowCount()} room deleted.</p>";
    }

// Define the number of posts per page
$postsPerPage = 20;

// Get the current page from the URL parameter
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset to retrieve the correct posts from the database
$offset = ($currentPage - 1) * $postsPerPage;

try {
    // Establish the database connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set up pagination variables
    $postsPerPage = 10;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $postsPerPage;

    // Prepare the SQL statement with or without category
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        $sql = "SELECT * FROM posts WHERE category = :category LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    } else {
        $sql = "SELECT * FROM posts LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
    }

    // Bind common parameters
    $stmt->bindParam(':limit', $postsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    // Execute the SQL statement
    $stmt->execute();

    // Fetch all posts and store them in the $posts array
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($posts)) {
        echo "<p>No peer room found.</p>";
    } else {
        // Loop through and display the fetched and formatted posts
        foreach ($posts as $post) {
            echo '<div class="container">';
            echo '<div class="square">';
            echo '<div class="h1">' . $post['title'] . '</div>';
            echo '<p class="description">' . $post['description'] . '</p>';
            echo '<p class="language">The language that will be used is ' . $post['language'] . ' the date is on ' . $post['datetime'] . '</p>';
            echo '<div><a href="peerroom_details.php?id=' . $post['id'] . '"  class="button"> <i class="fa fa-plus-circle" aria-hidden="true"></i>  Join Room</a></div>';
            echo '</div>';
            echo '</div>';
            echo '<br>';
        }
    }
} catch (PDOException $e) {
    // Handle database connection or query error
    echo "Database error: " . $e->getMessage();
}

// Close the database connection
$pdo = null;
    
    // Calculate the total number of pages based on the number of posts and posts per page
    try {
        // Create a PDO connection
        $pdo = new PDO('mysql:host=localhost;dbname=giginetn_gigi', 'giginetn_user', 'Iamthatiam1');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Execute the SQL query
        $sql = "SELECT COUNT(*) AS total FROM posts";
        $stmt = $pdo->query($sql);
    
        if (!$stmt) {
            throw new Exception("Error executing the SQL query.");
        }
    
        // Fetch the total number of posts
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPosts = $result['total'];
    
        // Calculate the total number of pages
        $totalPages = ceil($totalPosts / $postsPerPage);
    
        // Start an ordered list for pagination links
        echo '<ol class="pagination">';
    
        // Generate pagination links
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item';
            if ($i === $currentPage) {
                echo ' active';
            }
            echo '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }
    
        // Close the ordered list
        echo '</ol><br><br><br>';
    } catch (PDOException $e) {
        // Handle database connection or query error
        echo "Database error: " . $e->getMessage();
    } catch (Exception $e) {
        // Handle other exceptions
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection in the finally block to ensure it happens
        if ($pdo) {
            $pdo = null;
        }
    }
    
    ?>
    
        
        <a class="create"href="peerroom.php">Create a peer Room</a>
    </div>
   
<!---
    <div class="menu-content" id="menu-content2">
    
        <h5 class="title">Join a live learning room with other people who share your interests, and get taught by a certified tutor in real time.</h5>
        <form id="search-form">
        <select id="search" name="category" placeholder="Search by Category">
    <option>Search By Category</option>
    <option value="Mathematics">Math</option>
      <option value="Science">Science</option>
      <option value="Creativity">Creativity</option>
      <option value="Mental Health">Mental Health</option>
      <option value="History">History</option>
      <option value="Religion">Religion</option>
      <option value="Personal Reflection">Personal Reflection</option>
      <option value="Programming">Programming</option>
      <option value="Computer Science">Computer Science</option>
      <option value="Languages">Languages</option>
      <option value="Arts and Music">Arts and Music</option>
      <option value="Business">Business</option>
  <option value="Personal Development">Personal Development</option>
  <option value="Design">Design</option>
  <option value="Photography">Photography</option>
  <option value="Video Editing">Video Editing</option>
  <option value="Cooking and Baking">Cooking and Baking</option>
     Add more interest options as needed
</select>

            <button class="button1" type="submit">Search <i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        <Br></Br> -->
        <?php

/*

// Create a PDO database connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Construct an SQL query to fetch all lives (adjust the table name if needed)
$sql = "SELECT * FROM live";

$lives = array(); // Initialize an array to store lives

$livesPerPage = 2; // Number of lives to display per page
$totallives = count($lives); // Total number of lives
$totalPages = ceil($totallives / $livesPerPage); // Calculate total pages
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1; // Get the current page from the query string
$offset = ($currentPage - 1) * $livesPerPage; // Calculate the offset for the SQL query

// Construct an SQL query to fetch a limited number of lives based on pagination
$sql = "SELECT * FROM live LIMIT $offset, $livesPerPage";

try {
    // Execute the SQL query
    $stmt = $pdo->query($sql);

    // Fetch all lives and store them in the $lives array
    $lives = array(); // Reset the $lives array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Convert UTC datetime to Eastern Daylight Time (EDT)
        $utcDatetime = new DateTime($row['datetime'], new DateTimeZone('UTC'));
        $edtTimezone = new DateTimeZone('America/New_York');
        $edtDatetime = $utcDatetime->setTimezone($edtTimezone);
        
        // Format the datetime in the desired format
        $formattedDatetime = $edtDatetime->format('l jS F, g:ia (T)');
        
        $row['datetime'] = $formattedDatetime;
        $lives[] = $row;
        
    }
} catch (PDOException $e) {
    // Handle database query error
    echo 'Database error: ' . $e->getMessage();
}

// Close the database connection
$pdo = null;
try {
    // Establish the database connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Calculate the datetime that is 10 hours ago
    $tenHoursAgo = new DateTime('-10 hours', new DateTimeZone('UTC'));
    $tenHoursAgoStr = $tenHoursAgo->format('Y-m-d H:i:s');

    // Delete lives that have passed their datetime by 10 hours
    $deleteSql = "DELETE FROM live WHERE datetime < :tenHoursAgo";
    $deleteStmt = $pdo->prepare($deleteSql);
    $deleteStmt->bindParam(':tenHoursAgo', $tenHoursAgoStr, PDO::PARAM_STR);
    $deleteStmt->execute();

    if (!$deleteStmt->rowCount()) {
       // echo "<p>New Rooms were created.</p>";
    } else {
       // echo "<p>{$deleteStmt->rowCount()} room deleted.</p>";
    }

// Define the number of lives per page
$livesPerPage = 20;

// Get the current page from the URL parameter
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset to retrieve the correct lives from the database
$offset = ($currentPage - 1) * $livesPerPage;

try {
    // Establish the database connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['category'])) {
        $category = $_GET['category'];

        // Perform database query to fetch lives based on the selected category with pagination
        $sql = "SELECT * FROM live WHERE category = :category LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $livesPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    } else {
        // If no category is selected, display all lives with pagination
        $sql = "SELECT * FROM live LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $livesPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    }

    $success = $stmt->execute();

    if (!$success) {
        // Handle the SQL statement execution error
        echo "Error executing the SQL statement.";
        exit();
    }

    $lives = array(); // Initialize an array to store lives

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Convert UTC datetime to Eastern Daylight Time (EDT)
        $utcDatetime = new DateTime($row['datetime'], new DateTimeZone('UTC'));
        $edtTimezone = new DateTimeZone('America/New_York');
        $edtDatetime = $utcDatetime->setTimezone($edtTimezone);

        // Format the datetime in the desired format
        $formattedDatetime = $edtDatetime->format('l jS F, g:ia (T)');

        $row['datetime'] = $formattedDatetime;
        $lives[] = $row;
        
    }

    if (empty($lives)) {
        echo "<p>No live room found.</p>";
    } else {
        // Loop through and display the fetched and formatted lives
        foreach ($lives as $live) {
            echo '<div class="container">';
            echo '<div class="square">';
            echo '<div class="h1">' . $live['title'] . '</div>';
            echo '<p class="description">' . $live['description'] . '</p>';
            echo '<p class="language">The language that will be used is ' . $live['language'] . ' the date is on ' . $live['datetime'] . '</p>';
            echo '<div><a href="liveroom_details.php?id=' . $live['id'] . '" class="button"><i class="fa fa-plus-circle" aria-hidden="true"></i> Join for $' . $live['ticket'] . '</a></div>';
            echo '</div>';
            echo '</div>';
            echo '<br>';
        }
        
    }
} catch (PDOException $e) {
    // Handle database connection or query error
    echo "Database error: " . $e->getMessage();
}

// Calculate the total number of pages based on the number of lives and lives per page
try {
    // Create a PDO connection
    $pdo = new PDO('mysql:host=localhost;dbname=gigi', 'root', '');
  
    // Execute the SQL query
    $sql = "SELECT COUNT(*) AS total FROM live";
    $stmt = $pdo->query($sql);
  
    // Fetch the total number of lives
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totallives = $result['total'];
  
    // Calculate the total number of pages
    $totalPages = ceil($totallives / $livesPerPage);
  
    // Start an ordered list for pagination links
    echo '<ol class="pagination">';
  
    // Generate pagination links
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<li class="page-item';
        if ($i === $currentPage) {
            echo ' active';
        }
        echo '"><a class="page-link" href="?page=' . $i;
        if (isset($_GET['category'])) {
            echo '&category=' . $_GET['category'];
        }
        echo '">' . $i . '</a></li>';
    }
  
    // Close the ordered list
    echo '</ol><br><br><br>';
} catch (PDOException $e) {
    // Handle database connection or query error
    echo "Database error: " . $e->getMessage();
}

} catch (PDOException $e) {
    // Handle database connection or query error
    echo "Database error: " . $e->getMessage();
}
       */ ?>

<!--<a class="create"href="liveroom.php">Create a live Room</a>
Stop--->
</div>

    <script>
        // JavaScript to toggle menu content
        document.getElementById("menu1").addEventListener("click", function () {
            toggleContent("menu-content1", "menu-content2");
            setActiveMenu("menu1", "menu2");
        });

        document.getElementById("menu2").addEventListener("click", function () {
            toggleContent("menu-content2", "menu-content1");
            setActiveMenu("menu2", "menu1");
        });

        function toggleContent(showContentId, hideContentId) {
            var showContent = document.getElementById(showContentId);
            var hideContent = document.getElementById(hideContentId);

            showContent.style.display = "block";
            hideContent.style.display = "none";
        }

        function setActiveMenu(activeMenuId, inactiveMenuId) {
            var activeMenu = document.getElementById(activeMenuId);
            var inactiveMenu = document.getElementById(inactiveMenuId);

            activeMenu.classList.add("active-menu");
            inactiveMenu.classList.remove("active-menu");
        }

       


        document.getElementById('search').addEventListener('change', function () {
  // Get the selected category from the dropdown
  var selectedCategory = this.value.toLowerCase();
  var posts = document.getElementsByClassName('menu-content');

  for (var i = 0; i < posts.length; i++) {
    var postCategory = posts[i].getAttribute('data-category').toLowerCase();
    var postContainer = posts[i];

    if (selectedCategory === "search by category" || postCategory.includes(selectedCategory)) {
      postContainer.style.display = "block";
    } else {
      postContainer.style.display = "none";
    }
  }
});


    </script>
</body>
</html>
