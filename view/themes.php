<?php
require_once __DIR__ . "/../assets/php/initClasses.php";
Render::header();

@$userId = $_SESSION["user"];

$auth = new Authentication();
$moder = new Moderation();
$read = new Read();

if(isset($_GET["sort"]) && $_GET["sort"] !== "default")
{
    $sortBy = $_GET["sort"];
    $sortOrder = $_GET["sortOrder"];
    $sort = new Sort("themes", $sortBy, $sortOrder);

    $data = $sort->sortItemsBy(10, 0);
}
else
{
    $data = $read->themes();
}


?>
<section class="themes">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <section class="options">
                    <div class="container">
                        <div class="row">
                            <div class="col-7">
                                <div class="sort-wrap">
                                    <form action="<?= $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET) ?>">
                                        <select class="sort-input" name="sort">
                                            <option value="header" <?= !isset($_GET["sort"])? 'selected' : '' ?>>по
                                                умолчанию</option>
                                            <option value="rating" <?= @$_GET["sort"] === 'rating' ? 'selected' : '' ?>>
                                                по
                                                рейтингу</option>
                                            <option value="count" <?= @$_GET["sort"] === 'count' ? 'selected' : '' ?>>по
                                                просмотрам</option>
                                            <option value="date" <?= @$_GET["sort"] === 'date' ? 'selected' : '' ?>>
                                                по
                                                дате создания</option>
                                            <option value="updated" <?= @$_GET["sort"] === 'update' ? 'selected' : '' ?>>
                                                по
                                                дате обновления</option>
                                        </select>
                                        <select class="order-input" name="sortOrder" id="">
                                            <option value="DESC"
                                                <?= @$_GET["sortOrder"] === "DESC" ? "selected" : "" ?>>по
                                                убыванию</option>
                                            <option value="ASC" <?= @$_GET["sortOrder"] ==="ASC" ? "selected" : "" ?>>по
                                                возростанию</option>
                                        </select>
                                        <input type="submit" value="Сортировать">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col">
                <div class="add-theme">
                    <a href="/view/create-theme.php">Добавить обсуждение</a>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                foreach($data as $item) :
            ?>
                    <div class="col-12">
                        <div class="theme">
                            <div class="head-block">
                                <div class="name">
                                    <h1>
                                        <?= $item["header"] ?>
                                    </h1>
                                </div>
                                <div class="topic">
                                    <span>
                                        <?= $item["topic"] ?>
                                    </span>
                                </div>
                                <div class="author">
                                    <span>
                                        <span>Автор: <?= $item["login"] ?></span>
                                    </span>
                                </div>
                            </div>
                            <div class="date-block">
                                <div class="create-date">
                                    <span>Создано: <?= $item["date"] ?></span>
                                </div>
                                <div class="update-date">
                                    <?= isset($item["updated"]) ? "<span>Обновленно: {$item["updated"]} </span>" : "" ?>
                                </div>
                                <div class="last-message">
                                    <?= isset($item["last_mess"]) ? "<span>Последние сообщение: {$item["last_mess"]}</span>" : "" ?>
                                </div>
                            </div>
                            <div class="views-block">
                                <div class="views">Просмотры: <?= isset($item["count"]) ? $item["count"] : 0 ?></div>
                            </div>
                            <div class="theme-button">
                                <a href="/view/template/theme_page.php?theme=<?= $item["id"] ?>">Перейти</a>
                                <?php if(($auth->checkAuth() && $userId === $item["user_id"]) || ($moder->isAdmin($userId) || $moder->isModerator($userId))): ?>
                                    <form action="/view/create-theme.php" method="post">
                                        <input type="hidden" name="update" value="1">
                                        <input type="hidden" name="themeId" value="<?= $item["id"] ?>">
                                        <input type="submit" value="Изменить">
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            ?>
        </div>
    </div>
</section>
<?php
Render::footer();