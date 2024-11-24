<?php 
    include_once 'config/settings-configuration.php';
?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Reset your password</h1>
            <p>We will send email to reset your password</p>
            <form action="dashboard/authentication-class.php" method="POST">
                <input type="email" name="email" placeholder="Reset your password" Required>
                <br>
                <button type="submit" name="find_email"> reset your password! </button>
            </form>
        </section>
    </div>
</main>