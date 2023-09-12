<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

$auth = new Authentication();
$create = new Create();
$read = new Read();
$update = new Update();
$delete = new Delete();

$currentURL = "http://". $_SERVER["HTTP_HOST"];

if(!$auth->checkAUth())
{
    header("Location: http://all-mods/view/themes.php");
}

if(isset($_POST["themeId"]))
{
    $data = $read->themes($_POST["themeId"]);

    if(isset($_POST["send"]))
    {
        $form = [
            "themeId" => $_POST["themeId"],
            "userId" => $_POST["userId"],
            "header" => $_POST["header"],
            "topic" => $_POST["topic"],
            "text" => $_POST["text"],
        ];

        $update->theme($form);
        header("Location: ".$currentURL."/view/themes.php");
    }
}
else
{
    if(isset($_POST["send"]))
    {
        $form = [
            "userId" => $_POST["userId"],
            "header" => $_POST["header"],
            "topic" => $_POST["topic"],
            "text" => $_POST["text"],
        ];

        $create->theme($form);
        header("Location: ".$currentURL."/view/themes.php");
    }
}

if(isset($_POST["delete"]))
{
    $themeId = $_POST["themeId"];

    $delete->theme($themeId);
}

?>
<form action="" method="POST">
    <?= isset($_POST["themeId"]) ? "<input type=\"hidden\" name=\"themeId\" value=\"{$_POST["themeId"]}\">" : "" ?> 
    <input type="hidden" name="userId" value="<?= @$_SESSION["user"] ?>">
    <input type="text" name="header" id="" value="<?= @$data["header"] ?>">
    <input type="text" name="topic" id=""value="<?= @$data["topic"] ?>">
    <textarea name="text" id="" cols="30" rows="10"><?= @$data["text"] ?></textarea>
    <input type="submit" name="send" value="Создать">
    <input type="submit" name="delete" value="Delete">
</form>
<?php
Render::footer();
?>
