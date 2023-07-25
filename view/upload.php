<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

$read = new Read();
$create = new Create();

if(isset($_POST["btn"]))
{
    try
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
                    <label for="name">Название мода</label>
                    <input type="text" name="name" id="">
                    <label for="description">Описание мода</label>
                    <textarea name="description" id="" cols="30" rows="10"></textarea>
                    <label for="img">Изображение</label>
                    <input type="file" name="img" id="">
                    <label for="link">Ссылка на скачивание</label>
                    <input type="text" name="link" id="">
                    <label for="game">Игра</label>
                    <select name="game" id="">
                        <?php foreach($read->games() as $game) : ?>
                            <option value="<?= $game["id"] ?>"><?= $game["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="category">Категория</label>
                    <select name="category" id="">
                        <?php foreach($read->modsCategories() as $category) : ?>
                            <option value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
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