<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();
$id = $_SESSION["user"];
$user = new User();
$mods = new Mods();
$reviews = new Reviews();
$auth = new Authentication();

if(!$auth->checkAuth())
{
    header("Location: /");
    exit;
}

$data = $user->getUserData($id);
$fullName = explode("/", $data["full_name"]);
?>
<section class="cabinet">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="info-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-2">
                                <div class="image">
                                    <img src="\assets\img\users_logo\user_defaul.png" alt="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <div class="full-name">
                                                <div class="first-name">
                                                    <?= $fullName[0] ?>
                                                </div>
                                                <div class="login">
                                                    "<?= $data["login"] ?>"
                                                </div>
                                                <div class="last-name">
                                                    <?php
                                                        if(@$fullName[1] == NULL)
                                                        {
                                                            echo "";
                                                        }
                                                        else
                                                        {
                                                            echo  $fullName[1];
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="birthday">
                                                <div>
                                                    <span>Дата рождения: </span>
                                                    <?php
                                                        if($data["birthday"] == NULL)
                                                        {
                                                            echo "не указана";
                                                        }
                                                        else
                                                        {
                                                            echo $data["birthday"];
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="date">
                                                <span>Дата регистрации: </span>
                                                <?= $data["reg_date"] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="other-info">
                                        <div class="row">
                                            <div class="col">
                                                <span>Роль: Пользователь</span>
                                            </div>
                                            <div class="col">
                                                <span class="">Просмотров: 10000</span>
                                            </div>
                                            <div class="col">
                                                <span class="">Тем открыто: 10000</span>
                                            </div>
                                            <div class="col">
                                                <span class="">Коментирии: 6666</span>
                                            </div>
                                            <div class="col">
                                                <span class="">Одобрений: 7777</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-12">
                <div class="more-info">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="about-me">
                                    <a class="btn" href="?about=1">About Me</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="files">
                                    <a class="btn" href="?files=id">Files</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="friends">
                                    <a class="btn" href="?friends=">Friends</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="content">
                                    <?php
                                    switch (true) {
                                        case strpos($_SERVER["REQUEST_URI"], "about"):
                                    ?>
                                    <div class="profile-info">
                                        <div class="row">
                                            <div class="col">
                                                <div class="tabs">
                                                    <div class="about">about</div>
                                                    <div class="integration">integration</div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="tab-content">Lorem ipsum dolor, sit amet consectetur
                                                    adipisicing elit. Vel consequuntur consectetur nesciunt praesentium
                                                    hic ab aperiam nisi mollitia, fuga veritatis fugiat, quas,
                                                    accusantium beatae fugit numquam aspernatur labore dolorem illum!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                                break;
                                        case strpos($_SERVER["REQUEST_URI"], "files"):
                                    ?>
                                    <div class="user-files">
                                        <?php
                                                foreach($mods->showUserMods($id) as $mod):
                                    ?>
                                        <div onclick="location.href='/view/template/mod_page.php?mod-id=<?= $mod['id'] ?>'"
                                            class="file">
                                            <div class="name">
                                                <span><?= $mod["mod_name"] ?></span>
                                            </div>
                                            <div class="mod-rating">
                                                <?= $reviews->reviewRender($mod['id'], "mod") ?>
                                            </div>
                                            <div class="views">
                                                <span class="ico"></span>
                                                <span>1000</span>
                                            </div>
                                            <div class="downloads">
                                                <span class="ico"></span>
                                                <span>1000</span>
                                            </div>
                                        </div>
                                        <?php
                                                endforeach;
                                    ?>
                                    </div>
                                    <?php
                                            break;
                                        case strpos($_SERVER["REQUEST_URI"], "friends"):
                                            echo "FRIENDS";
                                            break;
                                        default:
                                    ?>
                                    <div class="about-me-content">
                                        <?php
                                                echo $data["about_me"];
                                    ?>
                                    </div>
                                    <?php
                                }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
Render::footer();
?>