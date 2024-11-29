<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to login page
    header('Location: /cs_uni_course/html/Login&Register.html');
    exit();
}

// Get the username from the session
$username = $_SESSION['user'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user_database');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the profile picture path
$stmt = $conn->prepare("SELECT profile_picture FROM users WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($profile_picture);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link rel="stylesheet" href="../css/Certificate1.css">
</head>

<body>

<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>

<header>
    <div class="inner">
        <div class="logo"><img src="../jpg/CS_Uni_Course.jpg" alt="Logo"></div>
        <div class="burger"></div>
        <nav>
            <a href="Landing_Page.php">Home</a>
            <a href="../html/Courses.html">Courses</a>
            <a href="../html/About_Us.html">About Us</a>
            <a href="Dashboard.php" class="active" >Welcome, <?php echo htmlspecialchars($username); ?>!</a>
            <img  src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%; vertical-align: middle;">
        </nav>
        <a href="Logout.php" class="login">Logout</a>
    </div>
</header>

<div class="certificate-wrapper">
    <div id="certificate" class="certificate-container">
        <div class="logo1">
            <img src="../jpg/CS_Uni_Course.jpg" alt="">
        </div>
        <div class="certificate-header bold h1">Certificate of Appreciation</div>
        <div class="certificate-subheader bold cursive h1">This Certificate is Presented to</div>
        <div class="recipient-name underline bold h1"><?php echo htmlspecialchars($username); ?></div>
        <div class="certificate-text h1">
            Has completed the comprehensive course on our website with distinction, demonstrating exceptional understanding and proficiency. Their dedication and capability are commendable, reflecting their success in applying the knowledge gained.
        </div>

        <div class="date-signature h1">
            <div style="padding-top: 25px">
                <p id="date"><?php echo date('F j, Y'); ?></p>
            </div>
            <div>
                <p1 class="bold cursive" style="font-size: 25px; padding: 0">Danero</p1>
                <p>Signature of the Founder</p>
            </div>
        </div>
    </div>
</div>


<div class="button-container">
    <button class="button" onclick="downloadCertificateAsPDF()">Download as PDF</button>
    <button class="button" onclick="downloadCertificateAsImage()">Download as JPG</button>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="../js/Certificate.js"></script>

</body>
</html>