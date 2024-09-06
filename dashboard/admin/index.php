<?php 
    require_once 'autentication/admin-class.php';

    $admin = new ADMIN();
    if (!$admin->isUserLoggedIn()) {
        $admin->redirect('../../');
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
</head>
<body>
    <h1> Welcome <?php echo $user_data['email']?></h1>
    <button><a href="autentication/admin-class.php?admin_signout">SIGN OUT</a></button>
</body>
</html>