<?php
require_once __DIR__ . "/assets/php/initClasses.php";

Render::header();

$read = new Read();
?>

<section class='container-fluid index-content index-content_modify'>
    <div class="row justify-content-center">
    <div class="col-md-10 offset-sm-0.1 news-container">
            <?php
                foreach($read->allNews() as $new):
            ?>

        <div class="news-block news-block_modify">
                <img src="<?= $new["img"]?>" alt="" class="news-block__img news-block__img_modify"></img>
            <div class="news-block__description news-block__description_modify">
                    <h3 class="news-block__subtitle news-block__subtitle_modify"><?= $new["title"]?></h3>
                    <p>
                        <?= $new["content"]?>
                    </p>
                 <div class="div">Автор: <?= $new["login"]?></div>
                <div class="news-date">Дата публикации: <?= $new["date"]?></div>
                <span onclick="location.href='/view/news-page.php?news-=<?= $new['id'] ?>'" class="open-news-btn open-news-btn_modify">Читать статью</span>
            </div>
        </div>
         <?php
        endforeach
        ?>
    </div>
    </div>
</section>
<div class="show-top_themes_btn-block">
    <div class="row">
        <aside class="col-xl-12 top-themes">
            <?= $read->topThemes() ?>
        </aside>
    </div>
         <div class="row justify-content-end  show-top_themes_btn">Open Top Themes>></div>
</div>

<?php
Render::footer();
?>