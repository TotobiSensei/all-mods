<?php
require_once __DIR__ . "/assets/php/initClasses.php";

Render::header();

$read = new Read();
?>

<section class='index-content index-content_modify'>

    <aside class='top-mods top-mods_modify'>
        <h2 class="top-mods__subtitile top-mods__subtitile-modify">Top Mods!</h2>
        <div class="top-mod top-mod_modify">
            <img src="assets\img\mod_img\64c24ea35490d_mavpa.w575.jpg" alt=""
                class="top-mod__img top-mod__img_modify"><a href=""></a></img>
            <h3 class='top-mod__subtitle top-mod__subtitle_modify'>sdfsfsdfsfdsfds</h3>
        </div>
    </aside>
    <div class="news-container">
    <?php
        foreach($read->allNews() as $new):
    ?>
    
        <div class="news-block news-block_modify">
            <img src="<?= $new["img"]?>" alt=""
                class="news-block__img news-block__img_modify"></img>
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
</section>

<?php
Render::footer();
?>