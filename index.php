<?php
require_once __DIR__ . "/assets/php/initClasses.php";

Render::header();

$read = new Read();
?>
<section class="home">
    <div class="container">
        <div class="row">
            <div class="col">
                <span class="header">Моды с наивышим рейтингом: </span>
                <div class="top-mods">
                    <?= $read->topMods() ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="top-themes">
                    <?= $read->topThemes() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
Render::footer();
?>