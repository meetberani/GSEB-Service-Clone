<?php
session_start();

// Redirect to login if user not logged in
if (!isset($_SESSION['seatnumber'])) {
    header("Location: login_user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home page</title>

 <link rel="stylesheet" href="index.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f7fa;
    }

    .container {
      display: flex;
      justify-content: space-between;
      padding: 30px;
    }

    .column {
      width: 30%;
    }

    .left-buttons,
    .right-buttons {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .left-buttons p,
    .right-buttons p {
      margin: 0;
    }

    .button-box {
      background-color: #2286c3;
      color: white;
      padding: 15px;
      text-align: center;
      font-weight: bold;
      border-radius: 6px;
      transition: background 0.3s;
      cursor: pointer;
    }

    .button-box:hover {
      background-color: #1769aa;
    }

    .center-panel {
      background-color: white;
      border-radius: 6px;
      padding: 15px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .center-panel h3 {
      margin-top: 0;
      background-color: #0054a6;
      color: white;
      padding: 10px;
      border-radius: 4px;
      font-size: 18px;
    }

    .tabs {
      display: flex;
      justify-content: space-around;
      margin: 15px 0;
      font-weight: bold;
    }

    .tabs label {
      cursor: pointer;
      color: #0054a6;
    }

.news-list {
  
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 10px;
  font-size: 14px;
}

    .news-list option {
      padding: 5px;
    }

    .view-all a {
      color: white;
      text-decoration: none;
    }

    .view-all {
      background-color: #0054a6;
      padding: 15px;
      text-align: center;
      font-weight: bold;
      border-radius: 6px;
      margin-top: 10px;
    }

    .view-all:hover {
      background-color: #004080;
    }
   
.partner-logos-section {
  background-color: #f4f4f4;
  padding: 20px 0;
  text-align: center;
}

.logo-bar {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 40px;
}

.logo-bar img {
  width: 117px;
  max-height: 65px;
  object-fit: contain;
  
}

.logo-bar img:hover {
  transform: scale(1.05);
}
.apply-section {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  background-color: #f5f5f5;
  padding: 40px 20px;
}

.apply-card {
  width: 230px;
  background-color: white;
  border-radius: 12px;
  padding: 20px;
  text-align: center;
  color: black;
  font-family: Arial, sans-serif;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  position: relative;
  transition: transform 0.3s ease;
}

.apply-card img {
  width: 50px;
  height: 50px;
  margin-bottom: 10px;
}

.apply-card h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

.apply-card p {
  font-size: 14px;
  margin-bottom: 15px;
  color: #fff;
}

.apply-card a {
  background-color: white;
  color: inherit;
  text-decoration: none;
  font-weight: bold;
  padding: 8px 14px;
  border-radius: 5px;
  display: inline-block;
  transition: background 0.3s;
}

.apply-card a:hover {
  background-color: #e6e6e6;
}


.apply-card.migration {
  background-color: #03A9F4;
}

.apply-card.duplicate {
  background-color: #8BC34A;
}

.apply-card.equivalent {
  background-color: #673AB7;
}

.apply-card.nri {
  background-color: #F44336;
}


.apply-card:hover {
  transform: translateY(-5px);
}

  </style>
</head>
<body>

 
  <div class="top-header">
    <div class="logo-area">
      <img src="headimg.png" alt="Logo" />
      <h2>Gujarat Secondary and Higher Secondary Education Board<br><small>Education Department - Official Site</small></h2>
    </div>
<h2>Welcome!</h2>
<p>Your Seat Number: <strong><?php echo htmlspecialchars($_SESSION['seatnumber']); ?></strong></p>
<a href="logout_user.php">Logout</a>

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
        <a href="login_user.php">🔓Login</a> |
        <a href="register.php">➕Register Now</a>
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


   <div class="container">

  <div class="column left-buttons">
    <p><strong>Board Website Links</strong></p>
    <div class="button-box">Board Website</div>
    <div class="button-box">School Registration</div>
    <div class="button-box">Teacher Registration</div>
    <div class="button-box">Online Student Exam Registration 10th (SSC)</div>
    <div class="button-box">Online Student Exam Registration 12th (HSC Science)</div>
  </div>


  <div class="column center-panel">
    <h3> News Highlights</h3>

    <div class="tabs">
      <label>ALL</label>
      <label>DEO</label>
      <label>STUDENT</label>
      <label>SCHOOL</label>
      <label>MEDIA</label>
    </div>

    <div class="news-list">
      <select size="15" style="width: 100%; border: none;">
        <option>> ધોરણ-૯ થી ૧૨ના વિદ્યાર્થીઓ માટે BISAG ના માધ્યમથી શૈક્ષણિક કાર્યક્રમો પ્રસારિત કરવા બાબત. (June-2025)</option>
        <option>> બોર્ડની ધોરણ-10 અને ધોરણ-12ની પૂરક પરીક્ષા તા.03/07/2025ના હાજર-ગેરહાજર વિગત</option>
        <option>> બોર્ડની ધોરણ-10 અને ધોરણ-12ની પૂરક પરીક્ષા તા.02/07/2025ના હાજર-ગેરહાજર વિગત</option>
        <option>> બોર્ડની ધોરણ-10 અને ધોરણ-12ની પૂરક પરીક્ષા તા.01/07/2025ના હાજર-ગેરહાજર વિગત</option>
        <option>> બોર્ડની ધોરણ-10 અને ધોરણ-12ની પૂરક પરીક્ષા તા.30/06/2025ના હાજર-ગેરહાજર વિગત</option>
        <option>> બોર્ડની ધોરણ-10 અને ધોરણ-12ની પૂરક પરીક્ષા તા.28/06/2025ના હાજર-ગેરહાજર વિગત</option>
        <option>> બોર્ડની ધોરણ-10 અને ધોરણ-12ની પૂરક પરીક્ષા તા.24/06/2025ના હાજર-ગેરહાજર વિગત</option>
        <option>> બોર્ડની ધોરણ-10 અને ધોરણ-12ની પૂરક પરીક્ષા તા.23/06/2025ના હાજર-ગેરહાજર વિગત</option>
        <option>> ધોરણ-૧૨ સામાન્ય પ્રવાહનાં અંગ્રેજી વિષયની ITI નાં વિદ્યાર્થીઓની પૂરક પરીક્ષા હોલટિકિટ</option>
        <option>> ધોરણ-૧૨ સામાન્ય પ્રવાહ પૂરક પરીક્ષા માટેનું હોલટિકિટ તથા નિમણૂકપત્ર</option>
        <option>> Not Approved New School Application 10.02.2025</option>
        <option>> Provisional Approved New School Application 10.02.2025</option>
        <option>> ધોરણ-૧૨ સામાન્ય પ્રવાહના આંતરિક મૂલ્યાંકના ગુણ અંગે સૂચના</option>
        <option>> ધોરણ-૧૨ વિજ્ઞાન પ્રવાહના આંતરિક મૂલ્યાંકના ગુણ અંગે સૂચના</option>
        <option>> Action Plan February-2025 Examination</option>
        <option>> ધોરણ-૧૦ ના આંતરિક મૂલ્યાંકના ગુણ અંગે સૂચના</option>
        <option>> ધોરણ-૧૨ વિજ્ઞાન પ્રવાહ પ્રાયોગિક પરીક્ષા ગુણ અંગે સૂચના</option>
      </select>
    </div>
  </div>

 
  <div class="column right-buttons">
    <div class="button-box">Online Student Exam Registration 12th (HSC General)</div>
    <div class="button-box">Migration Certificate</div>
    <div class="button-box">Duplicate Marksheet</div>
    <div class="button-box">Equivalent Certificate</div>
    <div class="view-all"><a href="#">View All Links >>></a></div>
  </div>
</div>
<section class="apply-section">
  <div class="apply-card migration">
    <img src="D:\web\home222.png" alt="Migration Icon" />
    <h3>Migration Certificate</h3>
    <p>Apply online for 10<sup>th</sup>–12<sup>th</sup> Migration Certificate</p>
    <a href="migration.html">APPLY NOW</a>
  </div>

  <div class="apply-card duplicate">
    <img src="D:\web\home111.png" alt="Duplicate Marksheet Icon" />
    <h3>Duplicate Marksheet</h3>
    <p>Apply for 10<sup>th</sup>–12<sup>th</sup> Duplicate Marksheet/Certificate</p>
    <a href="duplicate.html">APPLY NOW</a>
  </div>

  <div class="apply-card equivalent">
    <img src="D:\web\home333.png" alt="Equivalent Certificate Icon" />
    <h3>Equivalent Certificate</h3>
    <p>Apply for 10<sup>th</sup> and 12<sup>th</sup> Equivalent Certificate</p>
    <a href="equivalent.html">APPLY NOW</a>
  </div>

  <div class="apply-card nri">
    <img src="D:\web\home444.png" alt="NRI Icon" />
    <h3>Admission Eligibility</h3>
    <p>For NRI</p>
    <a href="nri.html">APPLY NOW</a>
  </div>
</section>

<div class="partner-logos-section">
  <div class="logo-bar">
    <img src="D:\web\11home.png" alt="Logo 1" />
    <img src="D:\web\0home.png" alt="Logo 2" />
    <img src="D:\web\1home.png" alt="Logo 3" />
    <img src="D:\web\2home.png" alt="Logo 4" />
    <img src="D:\web\3home.png" alt="Logo 5" />
    <img src="D:\web\4home.jpg" alt="Logo 6" />
  </div>
</div>
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
