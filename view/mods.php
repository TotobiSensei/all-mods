<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();
$gameId = $_GET["game"];
$read = new Read();
$review = new Reviews();

$pagination = new Pagination(9, count($read->mods($gameId)));

if(isset($_GET["sort"]) && $_GET["sort"] !== "default" || isset($_GET["category"]))
{
    $sortBy = !empty($_GET["sort"]) ? $_GET["sort"] : "name";
    $sortOrder = !empty($_GET["sortOrder"]) ? $_GET["sortOrder"] : "DESC";
    $category = $_GET["category"];
    $sort = new Sort([
        "itemsPerPage" => $pagination->getItemsPerPage(), 
        "offset" => $pagination->getOffset()
    ]);

    $mods = $sort->sortMods($sortBy, $sortOrder, $category);
  
}
else
{
    $mods = $read->mods($gameId, [$pagination->getItemsPerPage(), $pagination->getOffset()]);
}

if(isset($_GET["game"]))
{
?>
<section class="options">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="sort-wrap">
                    <form action="<?= $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET) ?>">
                        <input type="hidden" name="game" value="<?= $gameId ?>">
                        <input type="hidden" name="category" value="<?= $_GET["category"] ?? "" ?>">
                        <select class="sort-input" name="sort">
                            <option value="" <?= !isset($_GET["sort"])? 'selected' : '' ?>>по умолчанию</option>
                            <option value="rating" <?= @$_GET["sort"] === 'rating' ? 'selected' : '' ?>>по рейтингу
                            </option>
                            <option value="views" <?= @$_GET["sort"] === 'views' ? 'selected' : '' ?>>по просмотрам
                            </option>
                            <option value="upload" <?= @$_GET["sort"] === 'upload' ? 'selected' : '' ?>>по дате загрузки
                            </option>
                            <option value="update" <?= @$_GET["sort"] === 'update' ? 'selected' : '' ?>>по дате
                                обновления</option>
                            <!-- <option value="downloads" <?= @$_GET["sort"] === 'downloads' ? 'selected' : '' ?>>по
                                загрузкам</option> -->
                        </select>
                        <select class="order-input" name="sortOrder" id="">
                            <option value="DESC" <?= @$_GET["sortOrder"] === "DESC" ? "selected" : "" ?>>по убыванию
                            </option>
                            <option value="ASC" <?= @$_GET["sortOrder"] === "ASC" ? "selected" : "" ?>>по возростанию
                            </option>
                        </select>
                        <input type="submit" value="Сортировать">
                    </form>
                </div>
            </div>
            <div class="col-5">
                <div class="sort-wrap">
                    <form action="<?= $_SERVER['PHP_SELF'] ?>">
                        <input type="hidden" name="game" value="<?= $gameId ?>">
                        <input type="hidden" name="sort" value="<?= $_GET['sort'] ?? '' ?>">
                        <input type="hidden" name="sortOrder" value="<?= $_GET["sortOrder"] ?? '' ?>">
                        <select class="categories-input" name="category">
                            <option value="1" <?= @$_GET["category"] == 1 ? 'selected' : '' ?>>Геймплей</option>
                            <option value="3" <?= @$_GET["category"] == 3 ? 'selected' : '' ?>>Текстуры</option>
                            <option value="4" <?= @$_GET["category"] == 4 ? 'selected' : '' ?>>Разные</option>
                            <option value="" <?= @$_GET["category"] == "" ? 'selected' : '' ?>>по умолчанию</option>
                        </select>
                        <input type="submit" value="Сортировать">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mods">
    <div class="container">
        <div class="row">

            <div class="col-12">

                <?php
                $count = count($mods);
            for($i = 0; $i < $count; $i++)
            {
                if($i % 3 === 0)
                {
                    echo '<div class="row">';
                }
?>
                <div class="col">
                    <div onclick="location.href='/view/template/mod_page.php?mod-id=<?= $mods[$i]['id']?>'" class="mod">
                        <div class="img">
                            <img src="<?= $mods[$i]["img"] ?>" alt="">
                        </div>
                        <div class="name">
                            <span><?= $mods[$i]["name"] ?></span>
                        </div>
                        <div class="rating">
                            <?= Render::modsRating($mods[$i]["id"], "mod")?>
                        </div>
                        <div class="description">
                            <span><?= mb_strimwidth($mods[$i]["description"], 0, 100, "...") ?></span>
                        </div>
                       <div class="date">
                            <div class="upload">
                                <span>Загружен</span>
                                <span><?= $mods[$i]["upload"] ?></span>
                            </div>
                            <div class="updated">
                                <?php if(isset($mods[$i]["updated"])):?>
                                    <span>Обновлен</span>
                                    <span><?=  $mods[$i]["updated"]  ?></span>
                                <?php endif; ?>
                            </div>
                       </div>
                        <div class="button">
                            <a href="/view/template/mod_page.php?mod-id=<?= $mods[$i]["id"] ?>">Подpобнее</a>
                        </div>

                    </div>
                </div>
                <?php
                if(($i + 1) % 3 === 0 || $i === $count - 1)
                {
                    echo '</div>';
                }
            }
?>
            </div>
        </div>
</section>
<?php
    $pagination->renderLink();
}
else
{
    header("Location: http://all-mods/view/games.php");
    exit();
}

Render::footer()
?>