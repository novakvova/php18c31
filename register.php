<?php
$errors = array();
$email = '';
$password = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    if (isset($_POST['image']) and !empty($_POST['image'])) {
        //$password = $_POST['image'];
        ;
    } else {
        $errors["image"] = "Поле є обов'язковим";
    }

    if (count($errors) == 0) {
        header("Location: /index.php");
        exit;
    }
}
?>

<?php include "_header.php"; ?>
<?php include_once "input-helper.php"?>
<div class="row mt-3">
    <div class="offset-md-3 col-md-6">
        <h3>Створення нового акаунта</h3>
        <form method="post" id="form_register">

            <?php create_input("email", "Електронна пошта", "email", $errors); ?>

            <?php create_input("password","Пароль", "password", $errors); ?>

            <?php create_input("image","Фото", "file", $errors); ?>
<img id="prev"/>
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
            //let val= $(this).val();
            readURL(this);
            //alert(val);
            //$(this).parent().append("<img src='"+val+"'/>");
            //valid_hide($(this));
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

