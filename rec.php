<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mca23";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>View Student Record</title>
<style>
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f7fbff, #eef2ff);
    padding: 40px;
    color: #0f172a;
}
.container {
    max-width: 700px;
    margin: auto;
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 6px 24px rgba(0,0,0,0.08);
}
select, input[type=submit] {
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
}
select:focus {
    border-color: #6366f1;
    outline: none;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}
th {
    background: #6366f1;
    color: white;
}
</style>
</head>
<body>
<div class="container">
<h2>View Student Record</h2>

<form method="post" action="">
    <label for="roll">Select Roll Number:</label>
    <select name="roll" id="roll" required>
        <option value="">-- Select Roll Number --</option>
        <?php
        
        $result = $conn->query("SELECT roll_no FROM stud ORDER BY roll_no ASC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars($row['roll_no']) . '">' . htmlspecialchars($row['roll_no']) . '</option>';
            }
        }
        ?>
    </select>
    <input type="submit" value="View Record">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['roll'])) {
    $roll = $_POST['roll'];

    $stmt = $conn->prepare("SELECT name, roll_no, gender, mark1, mark2, mark3, mark4, mark5, mark6, totalmarks FROM stud WHERE roll_no = ?");
    $stmt->bind_param("s", $roll);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>Student Details for Roll No: " . htmlspecialchars($roll) . "</h3>";
        echo "<table>";
        echo "<tr><th>Name</th><td>" . htmlspecialchars($row['name']) . "</td></tr>";
        echo "<tr><th>Gender</th><td>" . htmlspecialchars($row['gender']) . "</td></tr>";
        echo "<tr><th>Mark 1</th><td>" . htmlspecialchars($row['mark1']) . "</td></tr>";
        echo "<tr><th>Mark 2</th><td>" . htmlspecialchars($row['mark2']) . "</td></tr>";
        echo "<tr><th>Mark 3</th><td>" . htmlspecialchars($row['mark3']) . "</td></tr>";
        echo "<tr><th>Mark 4</th><td>" . htmlspecialchars($row['mark4']) . "</td></tr>";
        echo "<tr><th>Mark 5</th><td>" . htmlspecialchars($row['mark5']) . "</td></tr>";
        echo "<tr><th>Mark 6</th><td>" . htmlspecialchars($row['mark6']) . "</td></tr>";
        echo "<tr><th>Total Marks</th><td><strong>" . htmlspecialchars($row['totalmarks']) . "</strong></td></tr>";
        echo "</table>";
    } else {
        echo "<p style='color:red;'>No record found for Roll No: " . htmlspecialchars($roll) . "</p>";
    }

    $stmt->close();
}
$conn->close();
?>
</div>
</body>
</html>
