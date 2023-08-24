<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

$userId = $_SESSION["user"];
Render::header();
$reviews = new Reviews();
$read = new Read();
$update = new Update();

$user = $read->profileData($userId);
$mods = $read->userMods($userId);

// echo "<pre>";
// var_dump($mods);
// echo "</pre>";
if(isset($_POST["closeReport"]))
{
    $update->closeReport($_POST["objId"],$_POST["objType"]);
}
?>
<section class="profile-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="left-block">
                    <img src="<?= $user["img"] ?>" alt="">
                </div>
            </div>
            <div class="col">
                <div class="right-block">
                    <div class="row">
                        <div class="col">
                            <div class="rigth-top">
                                <div class="name">
                                    <span><?= $user["login"] ?></span>
                                </div>
                                <div onclick="location.href='/view/profile-edit.php?user=<?= $user['id'] ?>'" class="edit">
                                    <span>Редактировать</span>
                                    <span>&#9999;</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="right-bottom">
                                <div class="role">
                                    <span>Роль:</span>
                                    <span><?= $user["role"] ?></span>
                                </div>
                                <div class="likes">
                                    <span>&#10084;</span>
                                    <span><?= $user["likes"] ?></span>
                                </div>
                                <div class="views">
                                    <span>&#128065;</span>
                                    <span><?= $user["views"] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="profile-content">
    <div class="container">
        <div class="row">
            <div class="col-2 left">
                <div class="left-block">
                    <div class="tabs">
                        <div onclick="location.href='?about'" class="tab">
                            <span>about</span>
                        </div>
                        <div onclick="location.href='?files'" class="tab">
                            <span>files</span>
                        </div>
                        <div onclick="location.href='?reports'" class="tab">
                            <span>Reports</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col right">
                <div class="right-block">
                    <div class="content">
                        <?php
                            switch (true) {
                                case strpos($_SERVER["REQUEST_URI"], "about") || !strpos($_SERVER["REQUEST_URI"], "?"):
                        ?>
                                    <div class="about-block">
                                        <div class="name">
                                            <span>Имя:</span>
                                            <span><?= isset($user["name"]) || !empty($user["name"]) ? $user["name"] : "неизвестно" ?></span>
                                        </div>
                                        <div class="surname">
                                            <span>Фамилия:</span>
                                            <span><?= isset($user["surname"]) || !empty($user["surname"])? $user["surname"] : "неизвестна" ?></span>
                                        </div>
                                        <div class="age">
                                            <span>Возраст:</span>
                                            <span><?= isset($user["age"]) ? $user["age"]. " лет" : "неизвестен" ?> </span>
                                        </div>
                                        <div class="about">
                                            <span>О себе:</span>
                                            <span><?= !empty(trim($user["about_me"])) ? $user["about_me"] : "пусто" ?></span>
                                        </div>
                                    </div>
                        <?php
                                break;
                                
                                case strpos($_SERVER["REQUEST_URI"], "files"):
                        ?>
                                    <div class="files-block">
                                        <?php foreach($mods as $mod): ?>
                                            <div onclick="location.href='/view/template/mod_page.php?mod-id=<?= $mod['id'] ?>'" class="file">
                                                <div class="name">
                                                    <span></span>
                                                    <span><?= $mod["name"] ?></span>
                                                </div>
                                                <div class="rating">
                                                    <span>&#8902;</span>
                                                    <span>(<?= ceil($mod["avg_rating"]) ?>)</span>
                                                </div>
                                                <div class="views">
                                                    <span>&#128065;</span>
                                                    <span><?= $mod["count"] ?></span>
                                                </div>
                                                <div class="downloads">
                                                    <span>&#129095;</span>
                                                    <span>1337</span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                        <?php
                                    break;
                                case (strpos($_SERVER["REQUEST_URI"], "reports") || strpos($_SERVER["REQUEST_URI"], "report")):
                                    if (!isset($_GET["report"])){
                        ?>
                                        <div class="reports-block">
                                            <?php
                                                foreach($read->allReports() as $report):
                                            ?>
                                                <div class="report">
                                                        <div class="left">
                                                            <span>Жалоба на тему #<?= $report["obj_id"] ?></span>
                                                            <span>Дата: 20.08.2023</span>
                                                            <span>Количество жалоб: <?= $report["report_count"] ?></span>
                                                            <span>Статус: 
                                                                <span class="<?= $report["status"] === 0 ? "awaiting" : "checked" ?>">
                                                                    <?= $report["status"] === 0 ? "Ожидает проверки" : "Закрыта" ?>
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <div class="right">
                                                            <span onclick="location.href='?report=<?= $report['obj_id']?>&type=<?= $report['obj_type']?>'">
                                                                Посмотреть
                                                            </span>
                                                        </div>
                                                </div>
                                            <?php
                                                endforeach;
                                            ?>
                                        </div>
                        <?php
                                    }
                                    else
                                    {
                                        $reports = $read->report($_GET["report"], $_GET["type"]);

                                        $objType = "";

                                        if  ($_GET["type"] === "theme")
                                        {
                                            $objType = "тему";
                                        }
                                        elseif ($_GET["type"] === "mod")
                                        {
                                            $objType = "мод";
                                        }
                                        else
                                        {
                                            $objType = "коментарий";
                                        }
                                        
                                        
                        ?>
                                        <div class="report-page">
                                            <div class="top">
                                                <span>Жалоба на <?=$objType." ".$reports["reportedObj"]?> </span>
                                                <span>Автор <?= $reports["reportedUser"] ?></span>
                                            </div>
                                            <div class="middle">
                                                <form action="" method="post">
                                                    <input type="hidden" name="objId" value="<?= $_GET["report"] ?>">
                                                    <input type="hidden" name="objType" value="<?= $_GET["type"] ?>">
                                                    <input type="submit" name="closeReport" value="Закрыть жалобу">
                                                    <input type="submit" value="Удалить запись">
                                                    <select name="" id="">
                                                        <option value="">на час</option>
                                                        <option value="">на 12 часов</option>
                                                        <option value="">на 1 день</option>
                                                        <option value="">на неделю</option>
                                                        <option value="">на месяц</option>
                                                        <option value="">навсегда</option>
                                                    </select>
                                                    <input type="submit" value="Забанить юзера">
                                                </form>
                                                <hr>
                                            </div>
                                            <div class="bottom">
                                                <?php
                                                        
                                                    foreach($reports as $key => $complaint):
                                                        if($key === "reportedUser" || $key === "reportedObj")
                                                        {
                                                            break;
                                                        }
                                                ?>
                                                        <div class="complaint">
                                                            <div class="complaint-username">
                                                                <span>Жалоба от <?= $complaint["reporting_user"] ?></span>
                                                                <hr>
                                                            </div>
                                                            <div class="complaint-list">
                                                                <div class="complaint-top">
                                                                    <?php
                                                                        if (isset($complaint["complaintList"]))
                                                                        {
                                                                            foreach($complaint["complaintList"] as $cmp):
                                                                    ?>
                                                                            <span><?= $cmp ?></span>
                                                                    <?php
                                                                            endforeach;
                                                                        }
                                                                        
                                                                       
                                                                    ?>
                                                                   
                                                                </div>
                                                                <div class="complaint-bottom">
                                                                    <?php
                                                                        if (!empty($complaint["addition"])) :
                                                                    ?>

                                                                        <span>Другая причина :</span>
                                                                        <span><?= $complaint["addition"] ?></span>
                                                                    <?php
                                                                        endif;
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </div>
                                        </div>
                        <?
                                    }    

                                    break;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
Render::footer();
?>