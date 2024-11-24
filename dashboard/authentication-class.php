<?php 
    require_once __DIR__. '/../database/dbconnection.php';
    include_once __DIR__. '/../config/settings-configuration.php';
    require_once __DIR__.'/../src/vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    class Authentication
        {
        private $conn;
        private $settings;
        private $smtp_email;
        private $smtp_password;

        public function __construct(){

            $this->settings = new SystemConfig();
            $this->smtp_email = $this->settings->getSmtpEmail();
            $this->smtp_password = $this->settings->getSmtpPassword();

            $database = new Database();
            $this->conn = $database->dbConnection();
        }

        public function sendotp($otp,$email){
            if($email == NULL){
                echo "<script>alert('No Email found.'); window.location.href = '../';</script>";
                exit;
            }else {
                $stmt = $this->runQuery("SELECT * FROM user WHERE email = :email");
            $stmt->execute(array(":email" => $email));
            $stmt->fetch(PDO::FETCH_ASSOC);}

            if($stmt->rowCount() > 0){
                echo "<script>alert('Email already taken. Please try another one'); window.location.href = '../';</script>";
                exit;
            }else{
                $_SESSION['OTP'] = $otp;
                $subject = "OTP VERIFICATION";
                $message = "
                <!DOCTYPE html>
                <html>
                <head>
                <meta charset = 'UTF=8'>
                <title> OTP Verification</title>
                <style>
                body {
                font-family: Arial, sans-serif; 
                background-color: #fff;
                margin: 0;
                padding: 0;
            }
                .container{
                max-width: 600px;
                margin: 0 auto;
                padding: 30px;
                background-color: #ffffff;
                border-radius: 4px;
                box-shadow: 2px 4px rgba(0, 0, 0, 0.1);
            }
                
            h1{
            color: #000;
            font-size: 24px;
            margin-bottom: 20px;
            }

            p{
            color: #666666;
            font-size: 16px;
            margin-bottom: 10px;
            }

            .button{
            display: inline-block; 
            padding: 12px 24px;
            background-color: #0088cc;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 20px;
            }

            .logo {
            display: block;
            text-align: center;
            margin-bottom: 30px;
            }

            </style>
            </head>
            <body>
            <div class='container'>
            <div class='logo'>
            <img src = /// /// ///>
            </div>
            <h1> OTP Verification </h1>
            <p> Hello, $email</p>
            <p> Your OTP is: $otp</p>
            <p> If you didn't request an OTP, please ignore this Email.</p>
            <p>Thank You</p>
            </div>
            </body>
            </html>";

            $this->send_email($email,$message,$subject, $this->smtp_email, $this->smtp_password);
            echo "<script>alert('We sent the OTP to $email.'); window.location.href = '../verify-otp.php';</script>";
        
            }

        }
        public function verifyOTP($username, $password, $otp, $tokencode, $email, $csrf_token){
            if($otp == $_SESSION['OTP']){
                unset( $_SESSION['OTP'] );

                $this->addAdmin($csrf_token, $username, $email, $password, "active", $tokencode);

                $subject = "VERIFICATION SUCCESS";
                $message = "
                <!DOCTYPE html>
                <html>
                <head>
                <meta charset = 'UTF=8'>
                <title> OTP Verification Success</title>
                <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #fff;
                margin: 0;
                padding: 0;

            }
                .container{
                max-width: 600px;
                margin: 0 auto;
                padding: 30px;
                background-color: #ffffff;
                border-radius: 4px;
                box-shadow: • 2px 4px rgba(0, 0, 0, 0.1);
            }

                
            h1{
            color: #000;
            font-size: 24px;
            margin-bottom: 20px;
            }

            p{
            color: #666666;
            font-size: 16px;
            margin-bottom: 10px;
            }

            .button{
            display: inline-block; 
            padding: 12px 24px; 
            background-color: #8888cc;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 20px;
            }

            .logo{
            display: block;
            text-align: center;
            margin-bottom: 30px;
            }
            </style>
            </head>
            <body>
            <div class='container'>
            <div class='logo'>
            <img src = /// /// ///>
            </div>
            <h1> Welcome </h1>
            <p> Hello, $email</p>
            <p> Welcome to Systems</p>
           
           <p> If you did not sign up for an account, you can ignore this.</p>
            </div>
            </body>
            </html>";

            $this->send_email($email,$subject,$message, $this->smtp_email, $this->smtp_password);
            echo "<script>alert('Thank You'); window.location.href = '../';</script>";

            unset($_SESSION['not_verify_username']);
            unset($_SESSION['not_verify_email']);
            unset($_SESSION['not_verify_password']);
            }else if ($otp == NULL){
                echo "<script>alert('No OTP found.'); window.location.href = '../verify-otp.php';</script>";
                exit;
            }else{
            echo "<script>alert('It appears that the otp you entered is invalid.'); window.location.href = '../verify-otp.php';</script>";
                exit;
                 } 

             }


            public function addAdmin($csrf_token, $username, $email, $password, $status, $tokencode){
            $stmt = $this->runQuery("SELECT * FROM user WHERE email = :email");
            $stmt->execute(array(":email" => $email));

            if($stmt->rowCount() > 0){
                echo "<script>alert('Email already exists.'); window.location.href = '../';</script>";
                exit;
            }

            if(!isset($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)){
                echo "<script>alert('Invalid CSRF token.'); window.location.href = '../';</script>";
                exit;
            }

            unset($_SESSION['csrf_token']);

            $hash_password = md5($password);
            
            $stmt = $this->runQuery('INSERT INTO user (username, email, password, status, tokencode) VALUES(:username, :email, :password, :status, :tokencode)');
            $exec = $stmt->execute(array(
                ":username" => $username,
                ":email" => $email,
                ":password" => $hash_password,
                ":status" => $status,
                ":tokencode" => $tokencode
            ));

            if($exec){
                echo "<script>alert('Admin Added Successfully.'); window.location.href = '../';</script>";
                exit;
            } else {
                echo "<script>alert('Failed to add admin.'); window.location.href = '../';</script>";
                exit;
            }

        }

        public function adminSignin($email, $password, $csrf_token){
            try{
                if(!isset($csrf_token) || !hash_equals($_SESSION['csrf_token'], $csrf_token)){
                    echo "<script>alert('Invalid CSRF token.'); window.location.href = '../';</script>";
                    exit;
                }
                unset($_SESSION['csrf_token']);
                
                $stmt = $this->runQuery('SELECT * FROM user WHERE email = :email');
                $stmt->execute(array(":email" => $email));
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC); 

                if($userRow['status']!== 'active'){
                    echo "<script>alert('Account is not active.'); window.location.href = '../';</script>";
                    exit;
                }

                if($stmt->rowCount() == 1 && $userRow['password'] == md5($password)){
                    $activity = "Has Successfully Signed In";
                    $user_ID = $userRow['id'];
                    $this->logs($activity, $user_ID);

                    $_SESSION['adminSession'] = $user_ID;
                    echo "<script>alert('Welcome.'); window.location.href = 'admin/index.php';</script>";
                    exit;
                }else{
                    echo "<script>alert('Invalid Credentials.'); window.location.href = '../';</script>";
                    exit;
                }
                
            }catch(PDOException $ex) {
                echo $ex->getMessage();
            
        }

    }


        public function adminSignout(){
            unset($_SESSION['adminSession']);
            echo "<script>alert('Sign Out Successfully.'); window.location.href = '../';</script>";
                    exit;
        }

        function send_email($email, $message, $subject, $smtp_email, $smtp_password)
        {
            $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->addAddress($email);
        $mail->Username = $smtp_email;
        $mail->Password = $smtp_password;
        $mail->setFrom($smtp_email, "yuri");
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->send();
        }

        public function logs($activity, $user_ID){
            $stmt = $this->runQuery("INSERT INTO logs (user_ID, activity) VALUES (:user_ID, :activity)");
            $stmt->execute(array(":user_ID" => $user_ID, ":activity" => $activity ));
        }

        public function isUserLoggedIn(){
            if(isset($_SESSION['adminSession'])){
                return true;
            }
        }

        public function redirect(){
            echo "<script>alert('Admin must login first'); window.location.href = '../';</script>";
                    exit;
        }

        public function runQuery($sql){
            $stmt = $this->conn->prepare($sql);
            return $stmt;

        }

        public function sendRPLINK($email){
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->execute([
                ':email' => $email
            ]);
            if($stmt->rowCount() <= 0) {
                echo "<script>alert('Email does not exist.'); window.location.href = '../';</script>";
                exit();
            }

            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $subject = "Reset Password";
                $message = "
                <!DOCTYPE html>
                <html>
                <head>
                <meta charset = 'UTF=8'>
                <title> Reset Password Link</title>
                <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #fff;
                margin: 0;
                padding: 0;

            }
                .container{
                max-width: 600px;
                margin: 0 auto;
                padding: 30px;
                background-color: #ffffff;
                border-radius: 4px;
                box-shadow: • 2px 4px rgba(0, 0, 0, 0.1);
            }

                
            h1{
            color: #000;
            font-size: 24px;
            margin-bottom: 20px;
            }

            p{
            color: #666666;
            font-size: 16px;
            margin-bottom: 10px;
            }

            .button{
            display: inline-block; 
            padding: 12px 24px; 
            background-color: #8888cc;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 20px;
            }

            .logo{
            display: block;
            text-align: center;
            margin-bottom: 30px;
            }
            </style>
            </head>
            <body>
            <div class='container'>
            <div class='logo'>
            <img src = /// /// ///>
            </div>
            <h1> Welcome </h1>
            <p> Hello, $email</p>
            <p> Reset Your Password</p>
            <a href=\"http://localhost/ActWebPage/dashboard/admin/authentication/reset-password.php?id={$userRow['id']}&tokencode={$userRow['tokencode']}\">reset password</a>
           <p> If you didn't request for reset password, ignore this.</p>
            </div>
            </body>
            </html>";

            $this->send_email($email,$message,$subject, $this->smtp_email, $this->smtp_password);
            echo "<script>alert('Reset Password Sent'); window.location.href = '../';</script>";

        }


        public function changePass($id, $newPass){
            $hash_password = md5($newPass);
            $tokencode = md5(uniqid(rand()));
            $stmt = $this->conn->prepare("UPDATE user SET password = :password, tokencode = :tokencode WHERE id = :id");
            $stmt->execute([
                ':password' => $hash_password,
                ':id' => $id,
                ':tokencode' => $tokencode
            ]);

            echo "<script>alert('Password Reset Succesful'); window.location.href = '../';</script>";
        }

        

    }

    

        if(isset($_POST['btn-signup'])){

        $_SESSION['not_verify_username'] = trim($_POST['username']);
        $_SESSION['not_verify_email'] = trim($_POST['email']);
        $_SESSION['not_verify_password'] = trim($_POST['password']);
       
        $email = trim ($_POST['email']);
        $otp = rand(100000, 999999);
        
        $addAuthentication = new Authentication();
        $addAuthentication->sendOtp($otp, $email);
    }



    if(isset($_POST['btn-verify'])){
        $csrf_token = trim($_POST['csrf_token']);
        $username =  $_SESSION['not_verify_username'];
        $email =  $_SESSION['not_verify_email'];
        $password =  $_SESSION['not_verify_password'];

        $tokencode = md5(uniqid(rand()));
        $otp = trim($_POST['otp']);

        $adminVerify = new Authentication();
       $adminVerify->verifyOTP($username, $password, $otp, $tokencode, $email, $csrf_token);
    }


    if(isset($_POST['btn-signin'])){
        $csrf_token = trim($_POST['csrf_token']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $adminSignIn = new Authentication();
        $adminSignIn->adminSignin($email, $password, $csrf_token);
    }

    if(isset($_GET['admin_signout'])){

        $adminSignOut = new Authentication();
        $adminSignOut-> adminSignout();
    }

    if(isset($_POST['find_email'])){
        (new Authentication())->sendRPLink(trim($_POST['email']));
    }

    if(isset($_POST['change_pass'])){
        (new Authentication())->changePass($_POST['id'], trim($_POST['newPass']));
    }
    

?>