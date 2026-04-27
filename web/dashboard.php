<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
/* Reset & body */
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #4facfe, #00f2fe);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Header */
header {
    background-color: rgba(0,0,0,0.8);
    color: #fff;
    padding: 20px;
    text-align: center;
    box-shadow: 0px 4px 6px rgba(0,0,0,0.2);
}

/* Card container */
.container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* Card style */
.card {
    background-color: #fff;
    border-radius: 15px;
    padding: 30px 40px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    text-align: center;
    max-width: 400px;
    width: 100%;
    animation: fadeIn 1s ease;
}

/* Fade-in animation */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
}

/* User info */
.card h2 {
    margin-bottom: 20px;
    color: #333;
}

.card p {
    margin: 10px 0;
    font-size: 16px;
    color: #555;
}

/* Logout button */
.logout-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 25px;
    background: #ff4b2b;
    color: #fff;
    text-decoration: none;
    border-radius: 50px;
    transition: 0.3s;
}

.logout-btn:hover {
    background: #ff416c;
}

/* Footer */
footer {
    background-color: rgba(0,0,0,0.8);
    color: #fff;
    padding: 15px;
    text-align: center;
    font-size: 14px;
}
</style>
</head>
<body>

<header>
    <h1>📚 Gujarat Secondary & Higher Secondary Education Board</h1>
    <p>Welcome to your Dashboard</p>
</header>

<div class="container">
    <div class="card">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <p><strong>Seat Number:</strong> <?php echo htmlspecialchars($_SESSION['seatnumber']); ?></p>
        <a class="logout-btn" href="dashboard.php?logout=true">Logout</a>
    </div>
</div>

<footer>
    &copy; <?php echo date("Y"); ?> Gujarat Secondary & Higher Secondary Education Board | All Rights Reserved
</footer>

</body>
</html>
