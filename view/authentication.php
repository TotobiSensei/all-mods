<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

$auth = new Authentication();

if(isset($_POST["logIn"]))
{
    $login = htmlspecialchars($_POST["login"]);
    $psw = htmlspecialchars($_POST["psw"]);

    if($auth->login($login, $psw))
    {
        header("Location: /");
        exit;
    }
    else
    {
        $_SESSION["error"] = "Неверный логин или пароль";
    }
}

?>
<section class="auth">
    <div>
        <span>Авторизация</span>
        <form action="" method="post">
            <label for="">Логин</label>
            <input type="text" name="login" id="login">
            <label for="">Пароль</label>
            <input type="password" name="psw" id="psw">
            <?php
                if(isset($_SESSION["error"]))
                {
                    echo " <div class=\"error\">";
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                    echo "</div>";
                }
            ?>
            <input type="submit" name="logIn" value="Войти">
        </form>
        <span class="forgot-psw">
            Забыл пароль?
        </span>
    </div>
</section>
<?php

Render::footer();
?>