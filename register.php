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
        <form method="post">

            <?php create_input("email", "Електронна пошта", "email", $errors); ?>

            <?php create_input("password","Пароль", "password", $errors); ?>

            <?php create_input("image","Фото", "file", $errors); ?>


            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Реєстрація"/>
            </div>
        </form>
    </div>

</div>

<?php include "_scripts.php"; ?>

<?php include "_footer.php"; ?>

