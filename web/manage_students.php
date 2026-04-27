<?php
include 'db_connect.php';
$message = "";

// ✅ Delete student
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM students WHERE id=$id");
  $message = "🗑️ Student deleted successfully.";
}

// ✅ Update student (Edit form submitted)
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $fullname = $_POST['fullname'];
  $mobile = $_POST['mobile'];
  $birthdate = $_POST['birthdate'];
  $address = $_POST['address'];
  $school = $_POST['school'];
  $gender = $_POST['gender'];
  $seatnumber = $_POST['seatnumber'];

  $stmt = $conn->prepare("UPDATE students SET fullname=?, mobile=?, birthdate=?, address=?, school=?, gender=?, seatnumber=? WHERE id=?");
  $stmt->bind_param("sssssssi", $fullname, $mobile, $birthdate, $address, $school, $gender, $seatnumber, $id);
  $stmt->execute();
  $stmt->close();

  $message = "✏️ Student updated successfully.";
}

// ✅ Fetch data for edit form (if edit button clicked)
$editData = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $res = $conn->query("SELECT * FROM students WHERE id=$id");
  $editData = $res->fetch_assoc();
}

// ✅ Fetch all students (for table)
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Students</title>
  <style>
    body { font-family: Arial; margin: 20px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    .message { color: green; font-weight: bold; }
    form { margin-top: 20px; background: #f8f8f8; padding: 15px; border-radius: 6px; width: 400px; }
    input, textarea { width: 100%; margin-bottom: 10px; padding: 8px; }
    input[type=submit] { background-color: #0059b3; color: white; border: none; cursor: pointer; }
    input[type=submit]:hover { background-color: #003d80; }
  </style>
</head>
<body>
  <h2>Manage Student Records</h2>

  <?php if ($message): ?>
    <p class="message"><?php echo $message; ?></p>
  <?php endif; ?>

  <!-- 📋 Table: Read + Action Buttons -->
  <table>
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Mobile</th>
      <th>Birthdate</th>
      <th>School</th>
      <th>Gender</th>
      <th>Seat No</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['fullname']; ?></td>
        <td><?php echo $row['mobile']; ?></td>
        <td><?php echo $row['birthdate']; ?></td>
        <td><?php echo $row['school']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['seatnumber']; ?></td>
        <td>
          <a href="?edit=<?php echo $row['id']; ?>">✏️ Edit</a> |
          <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">🗑️ Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>

  <!-- ✏️ Edit Form (shows only if editing a record) -->
  <?php if ($editData): ?>
  <h3>Edit Student</h3>
  <form method="POST">
    <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
    Full Name: <input type="text" name="fullname" value="<?php echo $editData['fullname']; ?>" required><br>
    Mobile: <input type="text" name="mobile" value="<?php echo $editData['mobile']; ?>" required><br>
    Birthdate: <input type="date" name="birthdate" value="<?php echo $editData['birthdate']; ?>" required><br>
    Address: <textarea name="address" required><?php echo $editData['address']; ?></textarea><br>
    School: <input type="text" name="school" value="<?php echo $editData['school']; ?>" required><br>
    Gender: 
    <input type="radio" name="gender" value="Male" <?php if($editData['gender']=='Male') echo 'checked'; ?>> Male 
    <input type="radio" name="gender" value="Female" <?php if($editData['gender']=='Female') echo 'checked'; ?>> Female 
    <input type="radio" name="gender" value="Other" <?php if($editData['gender']=='Other') echo 'checked'; ?>> Other<br><br>
    Seat Number: <input type="text" name="seatnumber" value="<?php echo $editData['seatnumber']; ?>" required><br>
    <input type="submit" name="update" value="Update Student">
  </form>
  <?php endif; ?>

  <br>
  <a href="register_user.php">➕ Register New Student</a>
</body>
</html>
