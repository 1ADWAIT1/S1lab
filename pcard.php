<?php 
$servername = "localhost";
$username = "root"; 
$password = "";       
$dbname = "mca23";
$conn = new mysqli($servername, $username, $password, $dbname);
echo '<style>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap");
:root{--bg1:#f7fbff;--bg2:#eef2ff;--card:#ffffff;--accent:#6366f1;--muted:#6b7280}
*{box-sizing:border-box}
body{font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:linear-gradient(135deg,var(--bg1),var(--bg2)); margin:0; padding:40px; color:#0f172a; display:flex; justify-content:center;}
.wrapper{width:100%;max-width:760px;background:linear-gradient(180deg,rgba(255,255,255,0.9),rgba(255,255,255,0.98));backdrop-filter:blur(6px);border-radius:14px;padding:28px 32px;box-shadow:0 10px 30px rgba(2,6,23,0.08);border:1px solid rgba(99,102,241,0.06);}
h2{margin:0 0 14px;padding:10px 16px;display:inline-block;background:linear-gradient(90deg,var(--accent),#8b5cf6);color:white;font-weight:700;border-radius:10px;box-shadow:0 8px 24px rgba(99,102,241,0.12);}
h3{margin:6px 0 12px;color:#0f172a;font-size:1.05rem;}
ul{list-style:none;padding:6px;margin:0 0 12px;border-radius:10px;}
li{display:flex;justify-content:space-between;align-items:center;padding:10px 12px;margin-bottom:8px;background:linear-gradient(90deg,rgba(99,102,241,0.02),rgba(145,158,255,0.01));border-radius:8px;border:1px solid rgba(15,23,42,0.03);}
li span.label{color:#374151;font-weight:600;}
li span.value{background:linear-gradient(90deg,#eef2ff,#f8f9ff);padding:6px 10px;border-radius:8px;font-weight:700;color:var(--accent);box-shadow:inset 0 -1px 0 rgba(0,0,0,0.03);}
.total{display:flex;justify-content:space-between;align-items:center;padding:14px 16px;margin-top:10px;background:linear-gradient(90deg,#fff,#fafafa);border-radius:10px;border:1px solid rgba(15,23,42,0.04);font-weight:700;}
p{margin:10px 0 0;font-size:1.02rem;color:var(--muted);}
strong{color:#111827;}
@media (max-width:520px){body{padding:20px}.wrapper{padding:18px}}
</style>
<div class="wrapper">';
echo "<h2>Student Performance Card</h2>";
mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $roll = htmlspecialchars($_POST['roll']);
     $gender = isset($_POST['gender']) ? $_POST['gender'] : 'Not specified';
    $marks = [];
    for ($i = 1; $i <= 6; $i++) {
        $marks[] = is_numeric($_POST["mark$i"]) ? floatval($_POST["mark$i"]) : 0;
    }
    $totalMarks = array_sum($marks);
        echo "<h3>Performance Card for $name (Roll No: $roll)</h3>";
    echo "<p><strong>Gender:</strong> $gender</p>";
    echo "<ul>";

    foreach ($marks as $index => $mark) {
        echo "<li>Mark " . ($index + 1) . ": $mark</li>";
    }
    echo "</ul>";
    echo "<p><strong>Total Marks:</strong> $totalMarks</p>"; 
} else {
    echo "<p>No data submitted.</p>";}
       $check = $conn->prepare("SELECT roll_no FROM stud WHERE roll_no = ?");
    $check->bind_param("s", $roll);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Error: Roll number $roll already exists in the database!');</script>";
    } else {
        $stmt = $conn->prepare("
            INSERT INTO stud (name, roll_no, gender, mark1, mark2, mark3, mark4, mark5, mark6, totalmarks)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
$stmt->bind_param("sssddddddd", $name, $roll,$gender, $marks[0], $marks[1], $marks[2], $marks[3], $marks[4], $marks[5], $totalMarks);
$stmt->execute();
$stmt->close();
}
if ($stmt->execute()) {
    echo "<p style='color:green;'><strong>Data successfully stored in database!</strong></p>";
    echo "<a href='view.php' style='
        display:inline-block;
        background:#6366f1;
        color:white;
        padding:10px 16px;
        border-radius:8px;
        text-decoration:none;
        font-weight:600;
        '>View Student Records</a>";
} else {
    echo "<p style='color:red;'>Error saving data: " . $stmt->error . "</p>";
}

 $check->close();
?>