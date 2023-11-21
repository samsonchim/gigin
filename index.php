
<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
    
  <title>Gigi</title>
  <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
  <link rel="stylesheet" href="index.css">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>

 
<!-- Cookie Consent Banner -->
<div id="cookie-consent">
    <p class="cookies">This is to let you know that we use third party cookies to  give you the very best web experience <a href="#">Learn More</a></p>
    <button id="accept-cookies">No Problem</button>
</div>



<div class="page">

    <nav>
      <a id="logo" href="#">Gigi<ul>
            <li> <a href="home.php">Home</a></li>
            <li><a href="getstarted.php"> Login</a> </li>
            <li><a href="getstarted.php"> Signup</a> </li>
        </ul>
    </nav>

<main>
<section>
    <h1>Gigi <span>Peer</span> Learning!</h1>

  <p>Gigi is a <strong>unique and collaborative online peer learning platform</strong>. <br/>
    It is designed to enhance your learning experience<strong> connect you with </strong> peers <br/>
    for better understanding using the Feynman Learning Technique.  
  </p>

  <a href="home.php"><button> Start Learning </button></a>

</section>

</main>

<script>
  // JavaScript to close the cookie consent banner with transition
document.addEventListener('DOMContentLoaded', function () {
    const acceptCookiesButton = document.getElementById('accept-cookies');
    const cookieConsentBanner = document.getElementById('cookie-consent');

    acceptCookiesButton.addEventListener('click', function () {
        // Apply the transition by changing opacity and translateY
        cookieConsentBanner.style.opacity = '0';
        cookieConsentBanner.style.transform = 'translateY(100%)';

        // Add a delay to remove the banner after the transition
        setTimeout(function () {
            cookieConsentBanner.style.display = 'none';
        }, 300); // Adjust the time (in milliseconds) to match your CSS transition duration
    });
});

</script>

</body>
</html>