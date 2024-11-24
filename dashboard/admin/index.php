<?php 
    require_once '../authentication-class.php';

    $admin = new Authentication();
    if (!$admin->isUserLoggedIn()) {
        $admin->redirect();
    }

    $stmt = $admin->runQuery("SELECT * FROM user WHERE id = :id");
    $stmt->execute(array(":id" => $_SESSION['adminSession']));
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN DASHBOARD</title>
    <link rel="stylesheet" href="../../src/css/styles2.css">
</head>
<body>
    <header>
        <nav>
            <ul class="navbar">

                <li class="nav-logo"><a href="dashboard/admin/dashboard.php">Admin Dashboard</a></li>

                <li class="search-container">
                    <form>
                        <input type="text" placeholder="Search...">
                    </form>
                </li>
                
                <li class="settings-dropdown">
                    <a href="#" id="settings-btn" class="settings-btn">⚙ Settings</a>
                    <div id="settings-content" class="settings-content">
                        <a href="../authentication-class.php?admin_signout">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="content">
            <h1>Hello, <?php echo $user_data['username']?></h1>
        </section>
    </main>
    <script src="../../src/js/script.js"></script>

    <footer>
        <p>&copy; 2024 Your Website | All Rights Reserved</p>
    </footer>
</body>
</html>