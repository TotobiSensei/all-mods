<?php
class Render
{
    private static $auth;
    private static $db;
    private static $read;
    private static $sessId;

    public static function header()
    {
        return require_once __DIR__ . "/../../../view/template/header.php";
    }

    public static function footer()
    {
        return require_once __DIR__ . "/../../../view/template/footer.php";
    }

    public static function reportForm($objId, $reportingUser, $objType)
    {
        $types = [
            "theme" => 
                [
                    "Оскорбления и домогательства", "Спам и нежелательная реклама", "Насилие и угрозы безопасности", "Нарушение авторских прав", "Нарушение правил сообщества", "Насилие и экстремизм"
                ],
            "mod" => 
                [
                    "Нарушение авторских прав", "Нарушение правил сообщества", "Незаконный контент", "Чрезмерно грубый контент (не включая наготу)"
                ],
            "comment" => 
                [
                    "Насилие и угрозы", "Насилие и экстремизм", "Нарушение правил сообщества", "Оскорбления и домогательства", "Спам и нежелательная реклама", 
                ],
            ];
        ?>
            <button class="report-button" type="button" data-target="modal-<?= $objId ?>">Report</button>
            <div class="popup-block" id="modal-<?= $objId ?>">
                <div class="popup">
                    <span>Отправить жалобу</span>
                    <hr>
                    <form action="" method="post">
                        <input type="hidden" name="objId" value="<?= $objId ?>">
                        <input type="hidden" name="reportingUser" value="<?= $reportingUser ?>">
                        <input type="hidden" name="objType" value="<?= $objType ?>">
                        <?php
                            foreach($types as $key => $type)
                            {
                                if($key === $objType)
                                {
                                    foreach($type as $val)
                                    {
                        ?>
                            <div>
                                <input type="checkbox" name="report[]" value="<?= $val ?>" id="">
                                <label for=""><?= $val ?></label>
                            </div>
                        <?
                                    }
                                }
                            }
                        ?>
                            <label for="">Другая причина:</label>
                            <textarea name="addition" id="" ></textarea>
                        <div class="buttons">
                            <input type="submit" name="send-report" value="Отправить">
                            <button type="button" class="close-btn" data-target="modal-<?= $objId ?>">Закрыть</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }

    public static function answerForm($objId, $objType, $userId)
    {
        ?>
            <div class="row">
                <div class="col">
                    <div class="answer-form">
                        <form action="http://all-mods/assets/php/handlers/comment.php" method="POST">
                            <input type="hidden" name="objId" value="<?= $objId ?>">
                            <input type="hidden" name="objType" value="<?= $objType ?>">
                            <input type="hidden" name="userId" value="<?= $userId ?>">
                            <label for=""></label>
                            <textarea name="message"></textarea>
                            <input type="submit" name="sendMessage" value="Отправить">
                        </form>
                    </div>
                </div>
            </div>
        <?
    }

    public static function modsRating($objId, $objType, $userId = NULL)
    {
        self::init();

        try
            {
                $query = "SELECT * FROM reviews WHERE obj_id = :objId AND obj_type = :objType AND rating > 0";
                $stmt = self::$db->prepare($query);
                $stmt->bindParam(":objId", $objId);
                $stmt->bindParam(":objType", $objType);
                $stmt->execute();
                $data = $stmt->fetchAll();

                $rating = 0;

                if(!empty($data))
                {
                    

                    $count = count($data);

                    foreach($data as $row)
                    {
                        $rating += $row["rating"];
                    }

                    $rating /= $count;
                }
                ?>

                    <form action="http://all-mods/assets/php/handlers/review.php" class="rating-form" method="POST">
                        <input type="hidden" name="objId" value="<?= $objId ?>">
                        <input type="hidden" name="objType" value="<?= $objType ?>">
                        <input type="hidden" name="userId" value="<?= @$userId ?>">
                        <?php 
                            for($i=1; $i<=5; $i++) : 
                                $active = ceil($rating) >= $i ? "active" : "" ;
                                if(!self::$auth->checkAuth() || !strpos($_SERVER["REQUEST_URI"], "mod-id")) :
                        ?>
                                    <span class="static <?= $active ?>">★</span>
                        <?php
                                else :
                        ?>
                                    <label for="" class="<?= $active ?>">
                                        <span>★</span>
                                        <input type="submit" name="star" value="<?= $i ?>">
                                    </label>
                        <?php
                                endif;
                            endfor;
                        ?>
                    </form>

                <?
            }
            catch(PDOException $e)
            {
                echo $e;
            }
    }

    public static function userRating($objId, $objType, $usersId = [])
    {
        self::init();

        try
        {
            $userId = $usersId["userId"];
            $objCreatorId = $usersId["objCreatorId"];

            $query = "SELECT SUM(rating) as sum FROM reviews WHERE obj_id = :objId AND obj_type = :objType GROUP BY obj_id";

            $stmt = self::$db->prepare($query);
            $stmt->bindValue(":objId", $objId);
            $stmt->bindValue(":objType", $objType);
            $stmt->execute();
            $sum = $stmt->fetch();

            $query = "SELECT rating FROM reviews WHERE obj_id = :objId AND obj_type = :objType AND user_id = :userId";
            $stmt = self::$db->prepare($query);
            $stmt->bindValue(":objId", $objId);
            $stmt->bindValue(":objType", $objType);
            $stmt->bindValue(":userId", $userId);
            $stmt->execute();
            $classActiveStatus = $stmt->fetch();

            $activeUp = isset($classActiveStatus["rating"]) && $classActiveStatus["rating"] === 1 ? "active" : "";
            $activeDown = isset($classActiveStatus["rating"]) && $classActiveStatus["rating"] === -1 ? "active" : "";
            ?>
                <form class="post-action" action="http://all-mods/assets/php/handlers/review.php" method="post">
                    <div class="reviews">
                        <input type="hidden" name="objId" value="<?= $objId ?>">
                        <input type="hidden" name="objType" value="<?= $objType ?>">
                        <input type="hidden" name="userId" value="<?= $userId ?>">
                        <input type="hidden" name="objCreatorId" value="<?= $objCreatorId ?>">
                        <label class="up" for="rating">
                            <span class="<?= $activeUp ?>">&#128402</span>
                            <input  id="rating" type="submit" name="rating" value="up">
                        </label>
            <?php
                        
                        echo !empty($sum) ? "<span>{$sum['sum']}</span>" : "";
            ?>
                        <label class="down" for="rating">
                            <span class="<?= $activeDown ?>">&#128403;</span>
                            <input  id="rating" type="submit" name="rating" value="down">
                        </label>
                    </div>
                </form>
            <?php
        }
        catch (PDOException $e)
        {
            echo $e;
        }
    }

    public static function comments($objId, $objType)
    {
        self::init();

        try
        {
            $itemsCount = count(self::$read->comment($objId, $objType));

            $pagination = new Pagination(5, $itemsCount);

            $comments = self::$read->comment($objId, $objType, [$pagination->getItemsPerPage(), $pagination->getOffset()]);

            ?>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="answer-block">
                                <?php
                                    foreach($comments as $comment) :
                                ?>
                                    <div class="row">
                                        <div class="col">
                                            <div class="answer">
                                                <div class="left">
                                                    <img class="user-img" src="<?= $comment["img"] ?>" alt="">
                                                    <a class="user-name" href="http://all-mods/view/profile.php?user=<?= $comment['user_id'] ?>"><?= $comment["login"] ?></a>
                                                </div>
                                                <div class="right">
                                                    <div class="top">
                                                        <div class="message">
                                                            <?= $comment["message"] ?>
                                                        </div>
                                                    </div>
                                                    <div class="bottom">
                                                        <div class="date-block">
                                                            <div class="date">
                                                                <span>Отправлено: <?= $comment["date"] ?></span>
                                                            </div>
                                                            <div class="update">
                                                                <span>
                                                                    Обновлен: 27.07.2023
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <?= Render::userRating($comment["id"], "comment", ["userId" => self::$sessId, "objCreatorId" =>  $comment["user_id"],] ) ?>
                                                        <?= Render::reportForm($comment["id"], self::$sessId, "theme"); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                    <?= $itemsCount > 5 ? $pagination->renderLink() : ""; ?>
                </div>
            <?php
        }
        catch (PDOException $e)
        {
            echo $e;
        }
    }

    private static function init()
    {
        self::$auth     = new Authentication();
        self::$read     = new Read();
        self::$db       = Database::pdo();
        self::$sessId   = $_SESSION["user"];
    }
}