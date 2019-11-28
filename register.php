<?php
$errors = array();
$email = '';
$password = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "connection_database.php";

    if (isset($_POST['email']) and !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $errors["email"] = "Поле є обов'язковим";
    }

    if (isset($_POST['password']) and !empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $errors["password"] = "Поле є обов'язковим";
    }

    session_start();
	if (md5($_POST['norobot']) == $_SESSION['randomnr2'])	{ 
        //$password = "Ghj,ktv";
		// // here you  place code to be executed if the captcha test passes
		// 	echo "Hey great , it appears you are not a robot";
	}	else {  
		// here you  place code to be executed if the captcha test fails
        $errors["captcha"] = "Не вірна каптча";
	}

    
    if (count($errors) == 0) {
        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
        $file_name= uniqid('300_').'.jpg';
        $file_save_path=$uploaddir.$file_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $file_save_path)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }

        $urlPath="/uploads/".$file_name;
        $sql = "INSERT INTO tbl_users (Email, Password, Image) VALUES (?,?,?)";
        $stmt= $dbh->prepare($sql);
        $stmt->execute([$email, $password, $urlPath]);

        header("Location: /users.php");
        exit;
    }
}
?>

<?php include "_header.php"; ?>
<?php include_once "input-helper.php"?>
<div class="row mt-3">

    <div class="offset-md-3 col-md-6">
        <h3>Створення нового акаунта</h3>
        <?php
        if(isset($errors["captcha"]))
        {
            echo "<h5>".$errors["captcha"]."</h5>";
        }
        ?>
        <form method="post" id="form_register" enctype="multipart/form-data">

            <?php create_input("email", "Електронна пошта", "email", $errors); ?>

            <?php create_input("password","Пароль", "password", $errors); ?>

            <input class="input" type="text" name="norobot" />
		    <img src="captcha.php" />

            <?php create_input("image","Фото", "file", $errors); ?>


<img id="prev" width="200"/>
            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Реєстрація"/>
            </div>
        </form>
    </div>

</div>

<?php include "_scripts.php"; ?>

<script>
    $(function() {
        $('#form_register input[type=email]').on('input', function()
        {
            valid_hide($(this));
        });
        $('#form_register input[type=password]').on('input', function()
        {
            valid_hide($(this));
        });
        $('#form_register #image').on('input', function()
        {
            readURL(this);
        });

        function valid_hide(child)
        {
            if(child.is(".is-invalid")) {
                child.removeClass("is-invalid");
                child.parent().find('.invalid-feedback')[0].remove();
            }
        }


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    //$(this).parent().append("<img src='"+e.target.result+"'/>");
                    $('#prev').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>

<?php include "_footer.php"; ?>

