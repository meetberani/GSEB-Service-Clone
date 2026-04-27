<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "student_portal");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$error = "";
$seatnumber = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seatnumber = trim($_POST["seatnumber"]);
    $password_input = trim($_POST["password"]);

    if (empty($seatnumber) || empty($password_input)) {
        $error = "Please fill in both fields.";
    } else {
        $stmt = $conn->prepare("SELECT fullname, password, role FROM students WHERE seatnumber = ?");
        if (!$stmt) die("Prepare failed: " . $conn->error);

        $stmt->bind_param("s", $seatnumber);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($fullname, $password, $role);
            $stmt->fetch();

            // Plain password check
            if ($password_input === $password) {
                $_SESSION["seatnumber"] = $seatnumber;
                $_SESSION["fullname"] = $fullname;
                $_SESSION["role"] = $role;

                // Redirect based on role
                if ($role === 'admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No user found with that seat number.";
        }

        $stmt->close();
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="index.css">
     <style>
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #f3f6f9;
}



.font-size-controls button {
  margin: 2px;
}


.nav-item {
  margin: 0 10px;
}

form {
  max-width: 400px;
  background-color: white;
  margin: 40px auto;
  padding: 25px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form h2 {
  text-align: center;
  margin-bottom: 20px;
}
form input {
  width: 100%;
  padding: 10px;
  margin: 6px 0 15px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
}
form input[type="submit"] {
  background-color: #004080;
  color: white;
  border: none;
  cursor: pointer;
  font-size: 16px;
}
form input[type="submit"]:hover {
  background-color: #002b5e;
}

footer {
  background-color: #eee;
  text-align: center;
  padding: 20px;
  font-size: 14px;
  color: #333;
}
</style>
</head>
<body>
     <div class="top-header">
    <div class="logo-area">
      <img src="headimg.png" alt="Logo" />
      <h2>Gujarat Secondary and Higher Secondary Education Board<br><small>Education Department - Official Site</small></h2>
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
        <span>English</span> |
        <span>ગુજરાતી</span>
      </div>
      <div class="login-register">
       <a href="login.html">🔓Login</a> |
        <a href="register.html">➕Register Now</a>
      </div>
    </div>
  </div>

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

    <div class="nav-item">
      <a href="Result.html">Result</a>
    </div>

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

  <div>
  

<form method="POST" action="">
  <h2>Student Login</h2>

  <?php if($error): ?>
      <p class="error"><?php echo $error; ?></p>
  <?php endif; ?>

  <label>Seat Number:</label>
  <input type="text" name="seatnumber" placeholder="Enter Seat Number" value="<?php echo htmlspecialchars($seatnumber); ?>" required>

  <label>Password:</label>
  <input type="password" name="password" placeholder="Enter Password" required>

  <input type="submit" value="Login">

  <p style="text-align:center;margin-top:10px;">
    Don't have an account? <a href="register_user.php">Register</a>
  </p>
</form>
    </div>



   <p id="error-message" style="color: red;"></p>
     <footer class="last-heading"><center>
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
