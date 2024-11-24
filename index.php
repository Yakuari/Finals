<?php 
    include_once 'config/settings-configuration.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="src/css/styles.css">
</head>
<body>
    <header>
        <nav>
        <img src="src/css/images/file.png" alt="logo" class="logo">
        <ul class="nav-links">
            <li><a href="home.php">Home</a></li>
            <li><a href="program.php">Program</a></li>
            <li><a href="subscription.php">Subscription</a></li>
            <li><a href="about-us.php">About Us</a></li>
            <li><a href="contacts.php">Contacts</a></li>
            </ul>

        <form action="dashboard/authentication-class.php" method="POST" class="auth-form"> 
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="btn-signin">SIGN-IN!</button>
            <a href="forgot-password.php">FORGOT PASSWORD?</a>
        </form>
        </nav>
    </header>

    <main>
        <section class="content">
        <h1>Welcome to [Gym Name],</h1>
        <p>Your fitness journey starts here. From effortless class bookings to personalized progress tracking,
        we’ve got everything you need to stay on top of your game.
        Explore, engage, and unlock your full potential.
        Remember, strong today, stronger tomorrow!</p>
        </section>

        <aside class="box-right">
            <h2>Register Here</h2>
            <form action="dashboard/authentication-class.php" method="POST"> 
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
                <input type="text" name="username" placeholder="Enter Username" required><br>
                <input type="email" name="email" placeholder="Enter Email" required><br>
                <input type="password" name="password" placeholder="Enter Password" required><br>
                <button type="submit" name="btn-signup">SIGN-UP!</button>
            </form>
        </aside>
    </main>

    <footer>
        <p>&copy; 2024 Your Website | All Rights Reserved</p>
    </footer>
</body>
</html>
