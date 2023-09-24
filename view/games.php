<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();
$auth = new Authentication();
$read = new Read();
$pagination = new Pagination(8, count($read->games()));


?>
    <section class="games">
        <div class="container">
                    <?php
                    $games = $read->games([$pagination->getItemsPerPage(), $pagination->getOffset()]);
                    $count = count($games);
                    
                    for ($i = 0; $i < $count; $i++) {
                        if ($i % 4 == 0) {
                            echo '<div class="row">'; // Начало новой строки
                        }
                    ?>
                                    <div class="col item-holder">
                                        <div class="item">
                                            <div class="img-block">
                                                <a href="/view/mods.php?game=<?=  $games[$i]["id"] ?>"><img src="<?= $games[$i]['img'] ?>" alt=""></img></a>
                                            </div>
                                        </div>
                                        <div class="action-block">
                                                
                                                <a href="/view/mods.php?game=<?=  $games[$i]["id"] ?>"><span><?=  $games[$i]["name"] ?></span></a>
                                                <!-- <div class="button">
                                                    <a href="/view/mods.php?game=<?=  $games[$i]["id"] ?>">Открыть</a>
                                                </div> -->
                                            </div>
                                    </div>
                    <?php  
                        if ($i % 4 == 3 || $i == $count - 1) {
                            echo '</div>'; // Закрытие строки
                        }
                    }
                    $pagination->renderLink();
                    ?>
        </div>
    </section>

<?php

