<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

try
{
    $reg = new Registration();

    

    if(isset($_POST["reg"]))
    {
        $log = htmlspecialchars($_POST["login"]);
        $email = htmlspecialchars($_POST["email"]);
        $psw = htmlspecialchars($_POST["psw"]);
        $conf_psw = htmlspecialchars($_POST["confirm_psw"]);

        $reg->register($log, $email, $psw, $conf_psw);
        header("Location: /");
        exit;
    }
}
catch(Exception $e)
{
    $error = $e->getMessage();
}
?>
<section class="sign-in">
    <div>
        <span>Регистрация</span>
        <form action="" method="post">
            <label for="login">Логин</label>
            <input type="text" name="login" id="login">
            <label for="email">Емейл</label>
            <input type="text" name="email" id="email">
            <label for="psw">Пароль</label>
            <input type="password" name="psw" id="psw">
            <label for="confirm_psw">Потвердите пароль</label>
            <input type="password" name="confirm_psw" id="confirm_psw">
            <?php
                if(isset($error))
                {
                    echo "<div class=\"error\">";
                    echo $error;
                    echo "</div>";
                }
            ?>
            <input type="submit" name="reg" value="Регистрация">
        </form>
    </div>
</section>
<?php

Render::footer();
?>