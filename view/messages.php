<?php
require_once __DIR__ . "/../assets/php/initClasses.php";

Render::header();

var_dump($_POST);
$auth  = new Authentication();

if ($auth->checkAuth())
{
    $sessId = $_SESSION["user"];
    @$userId = $_GET["dialog"];
    $currentUrl = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"];

    if (isset($_POST["sendMessage"]))
    {
        $create  = new Create();

        $form = [
            "fromUserId" => $_POST["fromUserId"],
            "toUserId" => $_POST["toUserId"],
            "message" => $_POST["message"],
        ];

        $create->message($form);
    }

    $read = new Read();
    
    $dialogueList = $read->dialogueList($sessId);


    if (isset($_GET["dialog"]))
    {
        $toUserId = htmlspecialchars($_GET["dialog"]);

        $messages = $read->dialog($sessId, $toUserId);

    }

    if (isset($_POST["messageId"]))
    {
        $update = new Update();

        $update->messageStatus($_POST["messageId"]);
    }

}
else
{
    header("Location: /");
}


?>
<section class="private-messages">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="dialog-list">
                    <div class="row">
                        <div class="col">
                            <?php foreach ($dialogueList as $dialog) : ?>
                                <div onclick="location.href='<?= $currentUrl?>?dialog=<?= $dialog['interlocutor_id']?>'" class="message">
                                    <div class="left">
                                        <img src="<?= $dialog["interlocutor_img"] ?>" alt="">
                                    </div>
                                    <div class="right">
                                        <div class="top">
                                            <div class="author"><?= $dialog["interlocutor_name"] ?></div>
                                            <div class="date"><?= $dialog["date"] ?></div>
                                        </div>
                                        <div class="bottom">
                                            <div class="text"><?= $dialog["message"] ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="message-window">
                    <div class="message-list" id="message-list">
                        <?php
                            if (!empty($messages))
                            {
                                foreach($messages as $message)
                                {
                                    if($message["from_user_id"] === $sessId) 
                                    {
                        ?>
                                        <div class="top my-message" id="message-<?=  $message["id"] ?>" data-message-id = "<?=  $message["id"] ?>">
                                            <div class="message-body">
                                                <div class="left">
                                                    <img src="<?=  $message["img"] ?>" alt="">
                                                </div>
                                                <div class="right">
                                                    <span class="text"><?= $message["message"] ?></span>
                                                    <span class="date"><?= $message["date"] ?></span>
                                                </div>
                                            </div>
                                        </div>
                        <?php
                                    }
                                    else
                                    {
                        ?>
                                        <div class="top other-message" id="message-<?=  $message["id"] ?>"  data-message-id = "<?=  $message["id"] ?>">
                                            <div class="message-body">
                                                <div class="left">
                                                    <img src="<?=  $message["img"] ?>" alt="">
                                                </div>
                                                <div class="right">
                                                    <span class="text"><?= $message["message"] ?></span>
                                                    <span class="date"><?= $message["date"] ?></span>
                                                </div>
                                            </div>
                                        </div>
                    <?php
                                    }
                                }
                            }
                            else
                            {
                    ?>

                    <?php   
                            }
                    ?>
                    </div>
                    <div class="bottom">
                        <form action="" method="POST">
                            <input type="hidden" name="fromUserId" value="<?= $sessId ?>">
                            <input type="hidden" name="toUserId" value="<?= $userId?>" >
                            <textarea  name="message" id=""></textarea>
                            <input type="submit" name="sendMessage" value="&#10148;" id="sendMessage">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
Render::footer();
?>