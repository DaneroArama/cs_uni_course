<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    die("You are not logged in. Please log in to access this page.");
}

// Retrieve the username from the session
$username = $_SESSION['user'];

// Fetch the user ID based on the username
$stmt = $pdo->prepare("SELECT id FROM users WHERE name = :name");
$stmt->execute(['name' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

$id = $user['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update Name
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
        $stmt = $pdo->prepare("UPDATE users SET name = :name WHERE id = :id");
        $stmt->execute(['name' => $name, 'id' => $id]);
        $_SESSION['user'] = $name; // Update the session variable
        $_SESSION['message'] = "Name updated successfully!";
    }

    // Update Phone
    if (!empty($_POST['phone'])) {
        $phone = $_POST['phone'];
        $stmt = $pdo->prepare("UPDATE users SET phone = :phone WHERE id = :id");
        $stmt->execute(['phone' => $phone, 'id' => $id]);
        $_SESSION['message'] = "Phone number updated successfully!";
    }

    // Update Email
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        $stmt = $pdo->prepare("UPDATE users SET email = :email WHERE id = :id");
        $stmt->execute(['email' => $email, 'id' => $id]);
        $_SESSION['message'] = "Email updated successfully!";
    }

    // Update Password
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute(['password' => $password, 'id' => $id]);
        $_SESSION['message'] = "Password updated successfully!";
    }

// Update Profile Picture
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the uploaded file is an image
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check !== false) {
            // Allow certain file formats
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                    // Store the relative path in the database
                    $relative_file_path = 'uploads/' . basename($_FILES["profile_picture"]["name"]);

                    $stmt = $pdo->prepare("UPDATE users SET profile_picture = :profile_picture WHERE id = :id");
                    $stmt->execute(['profile_picture' => $relative_file_path, 'id' => $id]);

                    $_SESSION['message'] = "Profile picture updated successfully!";
                } else {
                    $_SESSION['message'] = "Sorry, there was an error uploading your file.";
                }
            } else {
                $_SESSION['message'] = "Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.";
            }
        } else {
            $_SESSION['message'] = "File is not an image.";
        }
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/Dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
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
            <a class="active" href="Dashboard.php">Welcome, <?php echo htmlspecialchars($username); ?>!</a>
            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" width="100" style="width: 40px; height: 40px; border-radius: 50%; vertical-align: middle;">
        </nav>
        <a href="Logout.php" class="login">Logout</a>
    </div>
</header>

<div class="card-3d-wrap mx-auto">
    <div class="card-3d-wrapper">
        <div class="center-wrap">
                <div class="section text-center">
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" width="100" style="border-radius: 50%">
                    <form action="Dashboard.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Edit Name:</label>
                            <input type="text" name="name" class="form-style" placeholder="Full Name" value="<?php echo htmlspecialchars($user['name']); ?>" >
                            <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                            <label for="phone">Edit Phone:</label>
                            <input type="tel" name="phone" class="form-style" placeholder="Phone Number" value="<?php echo htmlspecialchars($user['phone']); ?>" >
                            <i class="input-icon uil uil-phone"></i>
                        </div>
                        <div class="form-group mt-2">
                            <label for="email">Edit Email:</label>
                            <input type="email" name="email" class="form-style" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" >
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group mt-2">
                            <label for="password">New Password:</label>
                            <input type="password" name="password" class="form-style" placeholder="Change Password" >
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <div style="display: flex; flex-direction: row; align-items: center; width: 100%; gap: 10px;">
                            <label for="profile_picture" style="white-space: nowrap;">Change Profile Picture:</label>
                            <input type="file" id="profile_picture" name="profile_picture">
                        </div>

                        <div class="form-group mt-2">
                            <button type="submit" class="btn" style="color: white">Update</button>
                        </div>

                        <div class="form-group mt-2" style="color: white">
                            <?php if (isset($_SESSION['message'])): ?>
                                <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

</body>
</html>
