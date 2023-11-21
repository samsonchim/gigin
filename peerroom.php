<?php 
   session_start();
    include_once "dbconnect.php";
    if (!isset($_SESSION['id'])) {
        header("location: getstarted.php");
        exit;
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">

    <title>Create a Peer Room</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&display=swap');
        *{
            font:600 16px/18px 'Inclusive Sans', sans-serif;
        }
        .container-2 {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 7px 0 rgba(0, 0, 0, 0.11);
        }

        .form-title {
            text-align: center;
            font-size: 1.2rem;
        }

        .form-title .star-required {
            color: red;
        }

        label {
            display: block;
            margin-top: 20px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            font-size: 1rem;
            padding: 5px;
            border: none;
            border-bottom: 1px solid #ddd;
            transition: border-color 0.5s;
        }

        input[type="text"]:hover,
        input[type="number"]:hover,
        textarea:hover,
        select:hover {
            border-color: #999;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            border-color: #333;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            background-color: #6f3e37;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #462924;
        }

        .star-required {
            color: red;
        }

       
        .alert{
            color: #918f8e;
            margin-top: 0px;
            font-size: 15px;

        }

        .input.invalid,
        textarea.invalid {
         border: 1px solid red;
}

       /* Style the input fields with a brown color */
       input[type="time"],
        input[type="date"] {
            color: brown;
            border: 1px solid brown;
            padding: 5px;
            border-radius: 4px;
        }

        input::placeholder {
        color: gray;
        font-size: 10px;
        }
        
        textarea::placeholder{
        color: gray;
        font-size: 10px;
        }

        .container {
	 width: 10%;
	 display: flex;
	 justify-content: left;
	 align-items: center;
	 position: relative;
}
 #toggle {
	 -webkit-appearance: none;
}
.button {
  position: fixed;
  color: black;
  z-index: 999;
  width: 320px;
  height: 65px;
  background: #6f3e37;
  border-radius: 15px;
  cursor: pointer;
  display: flex;
  justify-content: left;
  align-items: center;
  padding: 0 10px;
  overflow: hidden;
  transition: width 300ms linear;
  bottom: 0;
  right: 0;
}

 .button:before {
	 position: absolute;
	 content: "";
	 width: 20px;
	 height: 2px;
	 background: white;
	 transform: rotate(225deg);
	 transition: all 0.4s ease;
}
 .button:after {
	 position: absolute;
	 content: "";
	 width: 20px;
	 height: 2px;
	 background: white;
	 transform: rotate(135deg);
	 transition: all 0.4s ease;
}
 .nav {
	 opacity: 1;
	 transition: all 0.5s ease-in-out;
	 background: white;
	 width: 100%;
	 border-radius: 5px;
	 transform: translateX(10%);
	 padding: 10px;
}
 .nav ul {
	 margin: 0;
	 padding: 0;
	 display: flex;
	 flex-direction: row;
}
 .nav li {
	 opacity: 0;
	 list-style: none;
}
 .nav li:nth-child(1) {
	 transform-origin: bottom;
	 animation: itop 300ms 300ms linear forwards;
}
 .nav li:nth-child(2) {
	 transform-origin: bottom;
	 animation: itop 300ms 400ms linear forwards;
}
 .nav li:nth-child(3) {
	 transform-origin: bottom;
	 animation: itop 300ms 500ms linear forwards;
}
 .nav li:nth-child(4) {
	 transform-origin: bottom;
	 animation: itop 300ms 600ms linear forwards;
}
 .nav a {
	 transition: all 0.5s linear;
	 text-decoration: none;
	 color: #6f3e37;
	 font-size: 20px;
	 width: 52px;
	 height: 52px;
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 margin: 0 10px 0 0;
	 border-radius: 15px;
}
 .nav a:hover {
	 color: #fff;
	 background: #6f3e37;
	 border-radius: 15px;
}
 #toggle:checked ~ label .nav {
	 display: none;
	 opacity: 0;
	 transform: translateX(0);
}
 #toggle:checked ~ .button:before {
	 transform: rotate(90deg);
}
 #toggle:checked ~ .button:after {
	 transform: rotate(0deg);
}
 #toggle:checked ~ .button {
	 width: 70px;
	 transition: all 0.1s linear;
}
 @media (max-width: 640px) {
	 .container {
		 width: 100%;
	}
}
 @keyframes itop {
	 0% {
		 opacity: 0;
		 transform: translateY(60px);
	}
	 100% {
		 opacity: 1;
		 transform: translateY(0);
	}
}
 
 
    </style>
</head>

<body>
 

<!--What knowledge or skills will be gained in the room?
What will be taught in the room?
What will be the learning objectives of the room?
What will participants learn in the room?
What will be the key takeaways from the room? --->
<div class="container-2">
  <form action="submit_peerroom.php" method="post" class="post-form" id="post-form" enctype="multipart/form-data">
    <h1 class="form-title">What Room?</h1>
    <p>Please remember to join room was created</p>

    <label for="title"><i class="fa fa-file-alt" aria-hidden="true"></i> Room Subject<span class="star-required">*</span></label>
    <input type="text" name="title" id="title" placeholder="What knowledge or skills will be gained in the room?" autofocus required>

    <label for="description"><i class="fa fa-info-circle" aria-hidden="true"></i>  Description<span class="star-required">*</span></label>
    <textarea name="description" id="description" placeholder="Give a concise description of the room" required></textarea>

    <label for="time_needed"><i class="fa fa-clock" aria-hidden="true"></i>Time allocation (in minutes)<span class="star-required">*</span></label>
    <input type="number" name="time_needed" id="time_needed" placeholder="For how long" min="1" required>

    <label for="people"><i class="fa fa-users" aria-hidden="true"></i> How many people in the room<span class="star-required">*</span></label>
    <input type="number" name="people" id="people" placeholder="Limit of 20" min="0" required>
    
    <label for="datetime"><i class="fa fa-calendar-alt" aria-hidden="true"></i>When?<span class="star-required">*</span></label>
    <input type="text" id="datetime" name="datetime" placeholder="Select Date and Time">

    <label for="category"><i class="fa fa-folder" aria-hidden="true"></i> Category<span class="star-required">*</span></label>
    <select name="category" id="category" required>
      <option value="">Select a category</option>
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
      <option value="Other">Other</option>
    </select>

    <label for="language"><i class="fa fa-language" aria-hidden="true"></i> Room Language<span class="star-required">*</span></label>
    <select name="language" id="language" required>
      <option value="">Select Language</option>
      <option value="English Language">English</option>
      <option value="French">French</option>
      <option value="Madarin (Chinese)">Mandarin Chinese</option>
      <option value="Spanish">Spanish</option>
      <option value="Arabic (Standard)">Standard Arabic</option>
      <option value="Bengali">Bengali</option>
      <option value="Russian">Russian</option>
      <option value="Portuguese">Portuguese</option>
      <option value="Hindi">Hindi</option>
      <option value="Urdu">Urdu</option>
    </select>




    <input type="submit" value="Submit" id="submit">
    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
  </form>
</div>
    <script>
  flatpickr("#datetime", {
        enableTime: true,
        enableSeconds: false, // Optional: to include seconds
        dateFormat: "Y-m-d H:i:S", // Customize the date-time format as needed
        altInput: true,
        altFormat: "F j, Y H:i:S", // Display format in the input field
        time_24hr: true, // Use 24-hour time format
        enableTimezone: true, // Enable time zone selection
        timezone: "auto", // Set to "auto" to automatically detect the user's time zone
    });

       document.addEventListener('DOMContentLoaded', function() {
  var description = document.getElementById('description');
  var title = document.getElementById('title');
  var maxDescriptionWords = 50;
  var maxTitleWords = 7;

  description.addEventListener('keydown', function(e) {
    var words = description.value.trim().split(/\s+/);
    if (words.length >= maxDescriptionWords && e.keyCode !== 8) {
      e.preventDefault();
    }
    updateDescriptionValidity();
  });

  title.addEventListener('keydown', function(e) {
    var words = title.value.trim().split(/\s+/);
    if (words.length >= maxTitleWords && e.keyCode !== 8) {
      e.preventDefault();
    }
    updateTitleValidity();
  });

  function updateDescriptionValidity() {
    var words = description.value.trim().split(/\s+/);
    if (words.length >= maxDescriptionWords) {
      description.classList.add('invalid');
    } else {
      description.classList.remove('invalid');
    }
  }

  function updateTitleValidity() {
    var words = title.value.trim().split(/\s+/);
    if (words.length >= maxTitleWords) {
      title.classList.add('invalid');   
    } else {
      title.classList.remove('invalid');
    }
  }
});


    </script>
</body>

</html>
