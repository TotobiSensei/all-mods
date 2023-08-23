<?php
require_once __DIR__ . "/assets/php/initClasses.php";

Render::header();

$read = new Read();
?>

<section class="conteiner">
    <div class="row">
        <div class="col">
            <h1 class="creating-subtitle">Adjust your news</h1>

            <div class="settings-block">
                <form action="POST">
                    <label for="previewImg">Фото для превью</label>
                    <input type="file" id="previewImg"> 

                    <label for="news-title"></label>
                    <input type="text" id="news-title">

                    <label for="news-content"></label>
                    <input type="text" id="news-content">

                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</section>

<?php
Render::footer();
?>