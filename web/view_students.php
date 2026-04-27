<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portal_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

echo "<h2>📋 Registered Students</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Mobile</th>
        <th>Birthdate</th>
        <th>Address</th>
        <th>School</th>
        <th>Gender</th>
      </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["fullname"]."</td>
                <td>".$row["mobile"]."</td>
                <td>".$row["birthdate"]."</td>
                <td>".$row["address"]."</td>
                <td>".$row["school"]."</td>
                <td>".$row["gender"]."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>No records found</td></tr>";
}
echo "</table>";

$conn->close();
?>
