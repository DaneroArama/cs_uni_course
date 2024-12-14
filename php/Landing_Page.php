<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to login page
    header('Location: /html/Login&Register.html');
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
    <title>CSUniCourses</title>
    <link rel="stylesheet" href="/css/Landing_Page.css">
</head>
<body>

<header>
        <div style="position: absolute; padding-top: 5px">
            <button class="button" data-text="Awesome">
                <span class="actual-text">&nbsp;CS_ONLINE&nbsp;</span>
                <span aria-hidden="true" class="hover-text">&nbsp;CS_ONLINE&nbsp;</span>
            </button>
        </div>

        <div style="position: absolute; padding-top: 29px">
            <button class="button" data-text="Awesome">
                <span class="actual-text">&nbsp;Course&nbsp;</span>
                <span aria-hidden="true" class="hover-text">&nbsp;Course&nbsp;</span>
            </button>
        </div>

    <div class="inner">
        <div class="logo"><img src="../jpg/CS_Uni_Course.jpg" alt="Logo"></div>
        <div class="burger"></div>
        <nav>
            <a class="active" href="Landing_Page.php">Home</a>
            <a href="/html/Courses.html">Courses</a>
            <a href="/html/About_Us.html">About Us</a>
            <a href="Dashboard.php">Welcome, <?php echo htmlspecialchars($username); ?>!</a>
            <img class="profile_picture" src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" style="width: 45px; height: 45px; border-radius: 50%; vertical-align: middle;transition: transform 0.3s, box-shadow 0.3s;">
        </nav>
        <a href="Logout.php" class="login">Logout</a>
    </div>
</header>

    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>

    <section class="hero">
        <div class="container">
            <div class="hero-text">
            <h1>Unlock Your Future with a Certificate in Computer Science!</h1>
                <p class="bullet-paragraph">
                <span class="bullet-point">Cutting-Edge Curriculum: Stay ahead with courses in AI, Machine Learning, Cybersecurity, and more.</span>
                <span class="bullet-point">Expert Faculty: Learn from industry leaders and experienced professors.</span>
                <span class="bullet-point">Hands-On Experience: Gain practical skills through internships and real-world projects.</span>
                <span class="bullet-point">State-of-the-Art Facilities: Access the latest technology and research labs.</span>
                <span class="bullet-point">Career Opportunities: Our graduates are in high demand, with top companies seeking their expertise.</span>
                </p>
                <div class="cta">
                    <a href=/html/Courses.html class="btn">Get Started Now</a>
                    <p>Call us (959)795-905-432<br>For any question or concern</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="feature-below">
                <div class="feature">
                    <img src=/jpg/icon-01.svg>
                    <h3>24/7 Support</h3>
                    <p>Can discuss with the teachers anytime</p>
                </div>
                <div class="feature">
                    <img src=/jpg/icon-02.svg>
                    <h3>Learn from Anywhere</h3>
                    <p>Our courses are recorded,so you can learn anytime, anywhere</p>
                </div>
                <div class="feature">
                    <img src=/jpg/icon-03.svg>
                    <h3>Team Work</h3>
                    <p>We cooperate the students' teamwork through the projects</p>
                </div>
            </div>
        </div>
    </section>

    <div class="hero1">
        <h1>What You’ll Learn:</h1>
    </div>

    <div class="container-pic">
        <div class="box">
            <div class="imgBx">
                <img src=/jpg/pic1.png>
            </div>
            <div class="content">
                <div>
                    <h2>Programming Languages</h2>
                    <p>Programming languages are formal systems for instructing computers to perform specific tasks.</p>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="imgBx">
                <img src=/jpg/pic2.png>
            </div>
            <div class="content">
                <div>
                    <h2>Data Structures and Algorithms</h2>
                    <p>Data Structures and Algorithms are essential for organizing data efficiently and solving computational problems.</p>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="imgBx">
                <img src=/jpg/pic3.png>
            </div>
            <div class="content">
                <div>
                    <h2>Software Development and Engineering</h2>
                    <p>Software development and engineering involve designing, coding, testing, and maintaining software using systematic methodologies.
                    </p>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="imgBx">
                <img src=/jpg/pic4.png>
            </div>
            <div class="content">
                <div>
                    <h2>Network Security and Cryptography</h2>
                    <p>Network Security and Cryptography focus on protecting data and communication through encryption, authentication, and secure protocols.</p>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="imgBx">
                <img src=/jpg/pic5.png>
            </div>
            <div class="content">
                <div>
                    <h2>Artificial Intelligence and Machine Learning</h2>
                    <p>Artificial Intelligence and Machine Learning involve creating systems that can learn, adapt, and perform tasks typically requiring human intelligence.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="fade-in-section-container">
        <div class="fade-in-section">
            <div>
                <div class="text-content">
                    <h1>Learn from anywhere,anytime online<br>Becoming a Software Engineer</h1>
                    <p>Software engineering encompasses essential skills for developing robust applications. Our University offers courses covering programming languages, data structures, algorithms, and software design.<br>Learn at your own pace and gain practical knowledge in this dynamic field.</p>
                </div>
            </div>
            <div class="button-container ">
                <button class="cta-button" onclick="location.href='Courses.html'">Get Started Now</button>
            </div>
        </div>
    </div>

    <section class="additional-section">
        <div class="container">
            <h2>More About Our Services</h2>
            <p>Welcome to our Computer Science hub! At our university, we’re passionate about shaping the future through code, algorithms, and innovation. Whether you’re passionate about machine learning, web development, or cybersecurity, we’ve got you covered! Our programs blend theoretical foundations with hands-on experience, equipping students with the skills needed to tackle real-world challenges. </p>
            <p>So, whether you’re unraveling the mysteries of neural networks, crafting elegant web designs with HTML and CSS, or safeguarding digital systems, our CS department is your launchpad To Success. Join us on this exciting journey! let’s shape the future! 🚀</p>
        </div>
    </section>

    <script src=/js/Landing_page.js></script>

</body>
</html>
