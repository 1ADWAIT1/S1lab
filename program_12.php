<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Mark Sheet</title>

<style>
:root{
    --bg-1: #f5f8ff;
    --bg-2: #eef6ff;
    --card: #ffffff;
    --accent: #5b6cf6;
    --muted: #6b7280;
    --success: #6fd3b8;
}

*{box-sizing:border-box;}

/* Make sure the page can scroll if content is tall */
html, body {
    height: 100%;
    overflow-y: auto;
}

body{
    margin:0;
    padding:40px 0;
    display:flex;
    justify-content:center;
    align-items:flex-start; /* ✅ keeps form visible from the top */
    background: linear-gradient(135deg, var(--bg-1), var(--bg-2));
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    color: #0f172a;
}

/* Card (form) */
form{
    width:90%;
    max-width:500px;
    background: var(--card);
    border-radius:14px;
    padding:22px;
    border: 1px solid rgba(15,23,42,0.06);
    box-shadow: 0 10px 30px rgba(15,23,42,0.08);
}

/* Header label */
form::before{
    content: "Student Mark Sheet";
    display:block;
    font-size:18px;
    font-weight:700;
    color: var(--accent);
    margin-bottom:8px;
}

/* Inputs */
input[type="text"]{
    width:100%;
    display:block;
    padding:10px 12px;
    margin-bottom:12px;
    border-radius:8px;
    border:1px solid #e6eefb;
    background:#fbfdff;
    font-size:14px;
    transition: box-shadow .12s ease, border-color .12s ease, transform .08s ease;
}

input[type="text"]:focus{
    outline:none;
    border-color: rgba(91,108,246,0.9);
    box-shadow: 0 8px 24px rgba(91,108,246,0.12);
    transform: translateY(-1px);
}

/* Buttons */
button, input[type="submit"], input[type="reset"]{
    cursor:pointer;
    padding:10px 14px;
    border-radius:10px;
    border:none;
    font-weight:600;
    letter-spacing:0.2px;
    transition: transform .08s ease, box-shadow .12s ease;
}

/* Total button */
button{
    display:inline-block;
    background:transparent;
    color: var(--accent);
    border:1px solid rgba(91,108,246,0.12);
    margin-bottom:10px;
}
button:hover{ transform: translateY(-3px); }

/* Submit and reset layout */
input[type="submit"], input[type="reset"]{
    width:48%;
    box-shadow: 0 8px 20px rgba(15,23,42,0.06);
}
input[type="submit"]{
    background: linear-gradient(90deg, var(--accent), var(--success));
    color:#fff;
    margin-right:4%;
}
input[type="reset"]{
    background:#f3f4f6;
    color:#374151;
}

/* Total display */
#total{
    margin-top:6px;
    padding:10px;
    border-radius:8px;
    border:1px solid #eef2ff;
    background: linear-gradient(90deg, #ffffff, #fbfdff);
    font-weight:700;
    color:#0f172a;
}

/* Small screens */
@media (max-width:420px){
    form{ padding:16px; }
    input[type="submit"], input[type="reset"]{ width:100%; margin:6px 0 0 0; }
    input[type="submit"]{ margin-right:0; }
}
</style>
</head>

<body>
<form action="pcard.php" method="post">
    Name: <input type="text" name="name"><br>
    Roll Number: <input type="text" name="roll"><br>
    Gender:
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Female"> Female
    <input type="radio" name="gender" value="Other"> Other
    <br><br>

    Mark 1: <input type="text" name="mark1"><br>
    Mark 2: <input type="text" name="mark2"><br>    
    Mark 3: <input type="text" name="mark3"><br>
    Mark 4: <input type="text" name="mark4"><br>
    Mark 5: <input type="text" name="mark5"><br>
    Mark 6: <input type="text" name="mark6"><br>

    <button type="button" onclick="total()">Total</button><br>
    <p id="total"></p><br>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>

<script>
function total() {
    const marks = ["mark1","mark2","mark3","mark4","mark5","mark6"]
        .map(name => parseFloat(document.getElementsByName(name)[0].value) || 0);
    const totalMarks = marks.reduce((a,b) => a + b, 0);
    document.getElementById("total").innerText = "Total Marks: " + totalMarks;
}
</script>
</body>
</html>
