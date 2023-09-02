<?php
class Render
{
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
}