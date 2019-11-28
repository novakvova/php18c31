<?php
    $errors=array();
    $email='';
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(isset($_POST['email']) and !empty($_POST['email']))
        {
            $email=$_POST['email'];
        }
        else
            $errors["email"]="Поле пошта є обов'язковим";

        if(count($errors)==0) {
            session_start();
            $_SESSION["id"]=uniqid();
            header("Location: /index.php");
            exit;
        }
    }
?>

<?php include "_header.php"; ?>

<div class="login-container">
            <div class="row">
                <div class="offset-md-3 col-md-6 login-form-1">
                    <h3>Login for Form 1</h3>
                    <?php if(count($errors)!=0) { ?>
                        <div class="alert alert-danger" role="alert">
                            Заповніть поля
                        </div>
                    <?php } ?>

                    <form method="post">
                        <div class="form-group">
                            <input type="text" 
                                class="form-control" 
                                name="email"
                                placeholder="Your Email *" 
                                value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="register.php" class="ForgetPwd">Реєстрація</a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>

<?php include "_scripts.php"; ?>

<?php include "_footer.php"; ?>
