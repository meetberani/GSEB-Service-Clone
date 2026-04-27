<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <link rel="stylesheet" href="index.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
.success {
  text-align: center;
  color: green;
  font-size: 18px;
  font-weight: bold;
  margin-top: 20px;
  margin-bottom: 20px;
}

    form {
      width: 400px;
      margin: 30px auto;
      padding: 20px;
      border: 1px solid #cccccc;
      border-radius: 8px;
      background-color: #f9f9f9;
    }

    form input,
    form textarea,
    form select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    form input[type="submit"] {
      background-color: #0059b3;
      color: white;
      border: none;
      cursor: pointer;
    }

    form input[type="submit"]:hover {
      background-color: #004080;
    }

    .error-message {
      color: red;
      font-size: 13px;
      margin-bottom: 10px;
      display: block;
    }
.gender-options {
  display: flex;
  justify-content: space-between;
  margin-top: 5px;
  margin-bottom: 10px;
}

.gender-options label {
  flex: 1;
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 8px 0;
  background-color: #f9f9f9;
  cursor: pointer;
  margin: 0 4px;
  font-size: 14px;
}

.gender-options input {
  margin-right: 6px;
  vertical-align: middle;
}

    footer {
      background-color: #eee;
      padding: 20px;
      font-size: 14px;
      color: #333;
    }
  </style>
</head>
<body>
  <!-- Top Header -->
  <div class="top-header">
    <div class="logo-area">
      <img src="headimg.png" alt="Logo" />
      <h2>
        Gujarat Secondary and Higher Secondary Education Board<br />
        <small>Education Department - Official Site</small>
      </h2>
    </div>

    <div class="top-right">
      <div>
        Skip to main content | Screen Reader Access <br />
        <a href="#">Home</a> |
        <a href="#">Feedback</a> |
        <a href="faq.html">FAQ</a> |
        <a href="#">Sitemap</a>
      </div>
      <div class="font-size-controls">
        <button>A-</button>
        <button>A</button>
        <button>A+</button>
        <span>English</span> | <span>ગુજરાતી</span>
      </div>
      <div class="login-register">
        <a href="login.html">🔓Login</a> |
        <a href="register.html">➕Register Now</a>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav>
    <div class="nav-item"><a href="index.html">Home</a></div>
    <div class="nav-item">
      <select onchange="location = this.value;">
        <option value="">About Board</option>
        <option value="OrganizationStructure.html">Organization Structure</option>
        <option value="Contact.html">Contact</option>
        <option value="Branches.html">Branches</option>
      </select>
    </div>
    <div class="nav-item">
      <select onchange="location = this.value;">
        <option value="">School</option>
        <option value="StaticalData.html">Statical Data</option>
        <option value="SchoolRegistration.html">School Registration</option>
        <option value="NewSchoolApplication.html">New School Application</option>
        <option value="NewClassApplication.html">New Class Application</option>
      </select>
    </div>
    <div class="nav-item">
      <select onchange="location = this.value;">
        <option value="">Students</option>
        <option value="10QuestionPaper.html">10 Question Paper</option>
        <option value="12QuestionPaper.html">12 Question Papers</option>
      </select>
    </div>
    <div class="nav-item">
      <select onchange="location = this.value;">
        <option value="">Teachers</option>
        <option value="Teachers.html">Teacher Info</option>
      </select>
    </div>
    <div class="nav-item"><a href="Result.html">Result</a></div>
    <div class="nav-item">
      <select onchange="location = this.value;">
        <option value="">E-Citizen</option>
        <option value="right-to-information.html">Right To Information</option>
        <option value="act-rules.html">Act & Rules</option>
        <option value="government-resolutions.html">Govt Resolutions</option>
        <option value="tenders.html">Tenders</option>
        <option value="Gallery.html">Gallery</option>
        <option value="circulars.html">Circulars</option>
      </select>
    </div>
    <div class="nav-item"><a href="ImportantLinks.html">Important Links</a></div>
    <div class="nav-item"><a href="matdaryadi.html">Matdar Yadi</a></div>
    <div class="nav-item calendar-icon">📅</div>
  </nav>
<?php
// --- MySQL Connection ---
$servername = "localhost";
$username = "root";      
$password = "";          
$dbname = "student_portal"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variables
$name = $mobile = $birthdate = $address = $school = $gender = $seatnumber = $password_input = "";
$nameErr = $mobileErr = $birthdateErr = $addressErr = $schoolErr = $genderErr = $seatErr = $passErr = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Full name
    if (empty($_POST["fullname"])) {
        $nameErr = "Full Name is required";
        $valid = false;
    } else {
        $name = test_input($_POST["fullname"]);
        if (strlen($name) < 3) {
            $nameErr = "Name must be at least 3 characters.";
            $valid = false;
        }
    }

    // Mobile
    if (empty($_POST["mobile"])) {
        $mobileErr = "Mobile number is required";
        $valid = false;
    } else {
        $mobile = test_input($_POST["mobile"]);
        if (!preg_match("/^[6-9][0-9]{9}$/", $mobile)) {
            $mobileErr = "Enter valid 10-digit mobile starting with 6-9.";
            $valid = false;
        }
    }

    // Birthdate
    if (empty($_POST["birthdate"])) {
        $birthdateErr = "Birthdate is required";
        $valid = false;
    } else {
        $birthdate = $_POST["birthdate"];
        if (strtotime($birthdate) >= strtotime(date("Y-m-d"))) {
            $birthdateErr = "Birthdate cannot be today or in the future.";
            $valid = false;
        }
    }

    // Address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
        $valid = false;
    } else {
        $address = test_input($_POST["address"]);
        if (strlen($address) < 10) {
            $addressErr = "Address should be at least 10 characters.";
            $valid = false;
        }
    }

    // School
    if (empty($_POST["school"])) {
        $schoolErr = "School name is required";
        $valid = false;
    } else {
        $school = test_input($_POST["school"]);
        if (strlen($school) < 3) {
            $schoolErr = "School Name must be at least 3 characters.";
            $valid = false;
        }
    }

    // Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Please select a gender";
        $valid = false;
    } else {
        $gender = $_POST["gender"];
    }

    // Seat Number
    if (empty($_POST["seatnumber"])) {
        $seatErr = "Seat Number is required";
        $valid = false;
    } else {
        $seatnumber = test_input($_POST["seatnumber"]);
    }

    // Password
    if (empty($_POST["password"])) {
        $passErr = "Password is required";
        $valid = false;
    } else {
        $password_input = $_POST["password"];
        if (strlen($password_input) < 6) {
            $passErr = "Password must be at least 6 characters.";
            $valid = false;
        }
    }

    // --- If all valid, insert into DB ---
    if ($valid) {
        $role = 'student'; // ✅ All new registrations are students

        $stmt = $conn->prepare(
            "INSERT INTO students (fullname, mobile, birthdate, address, school, gender, seatnumber, password, role)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssssssss", $name, $mobile, $birthdate, $address, $school, $gender, $seatnumber, $password_input, $role);

        if ($stmt->execute()) {
            $success = true;
            $name = $mobile = $birthdate = $address = $school = $gender = $seatnumber = $password_input = "";
            echo "<p style='color:green;'>✅ Registration successful! You can now login.</p>";
        } else {
            echo "<p style='color:red;'>❌ Database error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<form method="post" action="">
  <h2>Student Registration Form</h2>

  <label>Full Name:</label>
  <input type="text" name="fullname" value="<?php echo $name; ?>">
  <span class="error"><?php echo $nameErr; ?></span>

  <label>Mobile Number:</label>
  <input type="text" name="mobile" value="<?php echo $mobile; ?>">
  <span class="error"><?php echo $mobileErr; ?></span>

  <label>Birthdate:</label>
  <input type="date" name="birthdate" value="<?php echo $birthdate; ?>">
  <span class="error"><?php echo $birthdateErr; ?></span>

  <label>Address:</label>
  <textarea name="address"><?php echo $address; ?></textarea>
  <span class="error"><?php echo $addressErr; ?></span>

  <label>School Name:</label>
  <input type="text" name="school" value="<?php echo $school; ?>">
  <span class="error"><?php echo $schoolErr; ?></span>

  <label>Gender:</label><br>
  <label><input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked"; ?>> Male</label>
  <label><input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked"; ?>> Female</label>
  <label><input type="radio" name="gender" value="Other" <?php if($gender=="Other") echo "checked"; ?>> Other</label>
  <span class="error"><?php echo $genderErr; ?></span><br><br>

  <label>Seat Number:</label>
  <input type="text" name="seatnumber" value="<?php echo $seatnumber; ?>">
  <span class="error"><?php echo $seatErr; ?></span>

  <label>Password:</label>
  <input type="password" name="password">
  <span class="error"><?php echo $passErr; ?></span>

  <input type="submit" value="Register">
</form>

  <!-- Footer -->
  <footer class="last-heading">
    <center>
      <p>Education Department | Commissionerate Mid Day Meal & Schools | Commissionerate of Higher Education</p>
      <p>Gujarat Institute of Educational Technology | Director of Literacy & Continuing Education | Commissionerate of Technical Education</p>
      <p>Directorate of Primary Education | National Cadet Corps | Sarva Shiksha Abhiyan</p>
      <p>Gujarat Secondary and Higher Secondary Education Board | State Examination Board</p>
      <p>Gujarat State Board of School Textbooks | State Board of Technical Examinations Gujarat</p>
      <p>Gujarat Council of Educational Research and Training</p>
      <p><a href="index.html">Home Page</a></p>
      <p>Privacy Policy | Terms of Use | Disclaimer</p>
    </center>
  </footer>
</body>
</html>
