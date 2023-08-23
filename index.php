<?php
require_once __DIR__ . "/assets/php/initClasses.php";

Render::header();

$read = new Read();
?>

<section class='index-content index-content_modify'>

    <aside class='top-mods top-mods_modify'>
        <h2 class="top-mods__subtitile top-mods__subtitile-modify">Top Mods!</h2>
        <div class="top-mod top-mod_modify">
            <img src="assets\img\mod_img\64c24ea35490d_mavpa.w575.jpg" alt="" class="top-mod__img top-mod__img_modify"><a href=""></a></img>
            <h3 class='top-mod__subtitle top-mod__subtitle_modify'>sdfsfsdfsfdsfds</h3>
        </div>
    </aside>
    
    <section class='mods-news mods-news_modify'>
    <h1 class="mods-news__subtitle" >Новостной блок</h1>

    <div class="add-block add-block_modify">
        <span class="add-btn">Создать статью</span>

        <div class="add-block__settings">
            <form action="POST">
                <label for="">Img</label>
                <input type="text">
                <label for="">Subtitle</label>
                <input type="text">
                <label for="">Text</label>
                <input type="text">

                <input type="submit">
            </form>
        </div>
    </div>

    <div class="row">
    <div class="news-block news-block_modify">
            <img src="assets\img\mod_img\64c10a2714b31_sticker.jpeg" alt="" class="news-block__img news-block__img_modify"></img>
            <div class="news-block__description news-block__description_modify">
                <h3 class="news-block__subtitle news-block__subtitle_modify">News NAme</h3>
                <p>
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Assumenda reprehenderit libero suscipit enim? Laudantium, consequuntur perferen...
                </p>
                <span class="open-news-btn open-news-btn_modify"><a href="">Читать статью</a></span>
            </div>
            
        </div>
        
        
            
        </div>
    </section>
</section>

<?php
Render::footer();
?>