<?php
$page_titre = "Forget Password";
?>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center">
                        <a href="index.php" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img src="../assets/img/logosvg.svg" alt="">
                </span>
                            <span class="app-brand-text demo text-body fw-bolder">Mindzone</span>
                        </a>
                    </div>
                    <h4 class="mb-1">Forgot Password? 🔒</h4>
                    <p class="mb-3">Enter your email to reset your password</p>
                    <?php
                    if (isset($_POST['sendfgtpwd'])) {
                        $email = htmlspecialchars($_POST['email']);
                        $reqemail = $bdd->prepare("SELECT * FROM users WHERE email = ?");
                        $reqemail->execute(array($email));
                        $mailexist = $reqemail->rowCount();
                        if ($mailexist != 0) {
                            $GENCODE = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 9);
                            $update = $bdd->prepare('UPDATE users SET code = ?  WHERE email = ?');
                            $update->execute(array($GENCODE, $email));
                            $subject = "Mindzone - Password Reset";
                            $headers = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                            $message = file_get_contents("./includes/emailtemp.html");
                            $message = str_replace("USEREMAIL,", "{$email}", $message);
                            $message = str_replace("GENCODE", "{$GENCODE}", $message);
                            mail($email, $subject, $message, $headers);
                            header("Location: ./resetpassword.php");
                        } else {
                            $error = "Email dosen't exist";
                        }
                    }
                    ?>
                    <form class="mb-2" method="POST">
                        <?php if (isset($error)) {
                            echo '
                <div class="alert alert-warning alert-dismissible" role="alert">
                ' . $error . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                        } ?>
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control mb-2" name="email" placeholder="Enter your email">
                        </div>
                        <button name="sendfgtpwd" href="" class="btn btn-primary d-grid w-100 collapsed">Reset
                            password</button>
                    </form>

                    <div class="text-center">
                        <a href="Security/login.php" class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
