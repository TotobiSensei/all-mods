<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();
$read = new Read();
$update = new Update();

$currentId  = htmlspecialchars($_GET["user"]);

$user = $read->profileData($currentId);
// var_dump($_POST);
if(isset($_POST["send"]) || isset($_POST["image"]))
{
    $form = [
        "userId" => $_POST["userId"],
        "image" => @$_POST["image"],
        "login" => @$_POST["login"],
        "name" => @$_POST["name"],
        "surname" => @$_POST["surname"],
        "birthday" => @$_POST["birthday"],
        "about" => @$_POST["about"],
    ];
    $update->profile($form);

    if($update->profile($form))
    {
        header("Location: http://all-mods/view/profile-edit.php?user=$currentId");
    }

}
?>
<section class="profile-edit">
    <form id="load-img" action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="userId" id="userId" value="<?= $user["id"] ?>">
        <div class="image-preview-container" id="image-preview-container">
            <img id="user-image" class="user-image" src="<?= $user["img"] ?>" alt="Изображение">
            <img id="image-preview" class="image-preview" src="" alt="Изображение">
            <label id="add-img" class="add-img" for="img">
                <span>ИЗМЕНИТЬ</span>
                <input type="file" name="img" id="image-input" accept="image/*">
            </label>
            <button id="crop-button" class="crop-button" type="button">Cохранить</button>
        </div>
        <input type="hidden" id="cropped-image" name="image">
    </form>
    <form id="" class="load-profile-data" action="" method="post">
        <input type="hidden" name="userId" id="userId" value="<?= $user["id"] ?>">
        <label for="login">Логин</label>
        <input type="text" name="login" value="<?= $user["login"] ?>" id="">
        <label for="name">Имя</label>
        <input type="text" name="name" value="<?= $user["name"] ?>" id="">
        <label for="surname">Фамилия</label>
        <input type="text" name="surname" value="<?= $user["surname"] ?>" id="">
        <label for="birthday">Дата рождения</label>
        <input type="date" name="birthday" value="<?= $user["birthday"] ?>" id="">
        <label for="about">О себе</label>
        <textarea name="about" id=""><?= $user["about_me"] ?></textarea>
        <input type="submit" name="send" value="Сохранить">
    </form>
</section>
<div>
    <?php
        if(isset($_SESSION["error"]))
        {
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
        }
    ?>
</div>
<?
Render::footer();
?>