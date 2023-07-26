<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

$read = new Read();
$update = new Update();
$create = new Create();

if(isset($_GET["mod"]))
{
    $modId = $_GET["mod"];

    $mod = $read->mod($modId);

}

if(isset($_POST["btn"]))
{
    try
    {
       if(isset($_POST["modId"]))
       {
            $form = [
                "modId" => $_POST["modId"],
                "name" => $_POST["name"], 
                "description" => $_POST["description"], 
                "categoryId" => $_POST["category"],
                "img" => $_FILES["img"],
                "link" => filter_var($_POST["link"], FILTER_SANITIZE_URL)
            ];

            $update->mod($form);
       }
       else
       {
            $form = [
                "name" => $_POST["name"], 
                "description" => $_POST["description"], 
                "categoryId" => $_POST["category"],
                "img" => $_FILES["img"],
                "link" => filter_var($_POST["link"], FILTER_SANITIZE_URL),
                "userId" => $_SESSION["user"],
                "gameId" => $_POST["game"],
            ];

            $create->mod($form);
       }
    }
    catch(Exception $e)
    {
        $error = $e->getMessage();
    }
}
            
?>
<?= @$error ?>
<section class="upload-page">
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="" method="post" enctype="multipart/form-data">
                    <?= isset($_GET["mod"]) ? "<input type=\"hidden\" name=\"modId\" value=\"{$_GET["mod"]}\">" : "" ?>
                    <label for="name">Название мода</label>
                    <input type="text" name="name" value="<?= isset($modId) ? $mod["name"]: ""; ?>" id="">
                    <label for="description">Описание мода</label>
                    <textarea name="description" id="" cols="30" rows="10"><?= isset($modId) ? $mod["description"]: ""; ?></textarea>
                    <label for="img">Изображение</label>
                    <input type="file" name="img" id="">
                    <label for="link">Ссылка на скачивание</label>
                    <input type="text" name="link" value="<?= isset($modId) ? $mod["file_name"]: ""; ?>" id="">
                    <label for="game">Игра</label>
                    <select name="game" id="">
                        <?php foreach($read->games() as $game) : ?>
                            <option value="<?= $game["id"] ?>" <?= isset($modId) && $mod['game_id'] === $game["id"] ? 'selected' : '' ?>><?= $game["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="category">Категория</label>
                    <select name="category" id="">
                        <?php foreach($read->modsCategories() as $category) : ?>
                            <option value="<?= $category["id"] ?>" <?= isset($modId) && $mod['category_id'] === $category["id"] ? 'selected' : '' ?>><?= $category["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" name="btn" value="Upload">
                </form>
            </div>
        </div>
    </div>
</section>
<?php
Render::footer();
?>