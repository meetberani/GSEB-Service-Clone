<?php
session_start();

// ✅ Step 1: Security check
if (!isset($_SESSION['seatnumber']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_user.php");
    exit;
}

// ✅ Step 2: Connect to database
include 'db_connect.php';

$message = "";

// ✅ Step 3: Delete student
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM students WHERE id = $id");
    $message = "🗑️ Student deleted successfully.";
}

// ✅ Step 4: Update student
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $birthdate = htmlspecialchars($_POST['birthdate']);
    $address = htmlspecialchars($_POST['address']);
    $school = htmlspecialchars($_POST['school']);
    $gender = htmlspecialchars($_POST['gender']);
    $seatnumber = htmlspecialchars($_POST['seatnumber']);

    $stmt = $conn->prepare("UPDATE students SET fullname=?, mobile=?, birthdate=?, address=?, school=?, gender=?, seatnumber=? WHERE id=?");
    $stmt->bind_param("sssssssi", $fullname, $mobile, $birthdate, $address, $school, $gender, $seatnumber, $id);
    $stmt->execute();
    $stmt->close();

    $message = "✏️ Student updated successfully.";
}

// ✅ Step 5: Fetch data for edit form
$editData = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM students WHERE id = $id");
    $editData = $res->fetch_assoc();
}

// ✅ Step 6: Fetch all students
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - Manage Students</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f8f9fa;
    }
    h2 {
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }
    a:hover {
        color: #0056b3;
    }
    .message {
        color: green;
        font-weight: bold;
    }
    form {
        margin-top: 20px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 6px;
        width: 400px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    input, textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type=submit] {
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }
    input[type=submit]:hover {
        background-color: #0056b3;
    }
    .logout {
        float: right;
        background: #dc3545;
        color: white;
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
    }
    .logout:hover {
        background-color: #a71d2a;
    }
    h3 {
        color: #333;
    }
    label {
        font-weight: bold;
    }
    background-color: #007bff;
</style>
</head>
<body>

<h2>👨‍💼 Admin Dashboard - Manage Students</h2>
<a href="logout_user.php" class="logout">Logout</a>
<a href="manage_students.php" style="background-color:#007bff; color:white; padding:8px 15px; border-radius:5px; text-decoration:none; margin-bottom:10px; display:inline-block;">
    Go to Manage Students
</a>
<?php if ($message): ?>
    <p class="message"><?= $message ?></p>
<?php endif; ?>

<!-- ✅ Students Table -->
<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Mobile</th>
        <th>Birthdate</th>
        <th>School</th>
        <th>Gender</th>
        <th>Seat Number</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['fullname']) ?></td>
            <td><?= htmlspecialchars($row['mobile']) ?></td>
            <td><?= htmlspecialchars($row['birthdate']) ?></td>
            <td><?= htmlspecialchars($row['school']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= htmlspecialchars($row['seatnumber']) ?></td>
            <td>
                <a href="?edit=<?= $row['id'] ?>">✏️ Edit</a> |
                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this student?');">🗑️ Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- ✏️ Edit Form -->
<?php if ($editData): ?>
<h3>Edit Student</h3>
<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
    <label>Full Name</label>
    <input type="text" name="fullname" value="<?= htmlspecialchars($editData['fullname']) ?>" required>
    <label>Mobile</label>
    <input type="text" name="mobile" value="<?= htmlspecialchars($editData['mobile']) ?>" required>
    <label>Birthdate</label>
    <input type="date" name="birthdate" value="<?= htmlspecialchars($editData['birthdate']) ?>" required>
    <label>Address</label>
    <textarea name="address" required><?= htmlspecialchars($editData['address']) ?></textarea>
    <label>School</label>
    <input type="text" name="school" value="<?= htmlspecialchars($editData['school']) ?>" required>
    <label>Gender</label>
    <input type="radio" name="gender" value="Male" <?= ($editData['gender'] == 'Male') ? 'checked' : '' ?>> Male
    <input type="radio" name="gender" value="Female" <?= ($editData['gender'] == 'Female') ? 'checked' : '' ?>> Female
    <input type="radio" name="gender" value="Other" <?= ($editData['gender'] == 'Other') ? 'checked' : '' ?>> Other
    <br><br>
    <label>Seat Number</label>
    <input type="text" name="seatnumber" value="<?= htmlspecialchars($editData['seatnumber']) ?>" required>
    <input type="submit" name="update" value="Update Student">
</form>
<?php endif; ?>

</body>
</html>
