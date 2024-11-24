<?php 
   require_once __DIR__ . "/../../../database/dbconnection.php";

   $database = new Database();
   $conn = $database->dbConnection();

   $stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
   $stmt->execute([
     ':id' => $_GET['id']  // Replace with the actual user ID you want to change the password for.
   ]);
   $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

   if ($_GET['tokencode'] !== $userRow['tokencode']){
        echo"<script> alert(\" Invalid Token Code \"); window.location.href = \"../../../ \"; </script>";
        exit();
   }
?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Change your password</h1>
            <p>Change your password</p>
            <form action="../../authentication-class.php" method="POST">
                <input type="password" name="newPass" placeholder="Change your password" Required>
                <input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
                <br>
                <button type="submit" name="change_pass"> change your password! </button>
            </form>
        </section>
    </div>
</main>