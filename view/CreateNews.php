

<section class="conteiner">
    <div class="row">
        <div class="col">
            <h1 class="creating-subtitle">Adjust your news</h1>

            <div class="settings-block">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="userId" value="<?=$_SESSION["user"]?>">
                    <input type="text" name="title" id="">
                    <textarea name="content" id="" cols="30" rows="10"></textarea>
                    <input type="file" name="img" id="">
                    <input type="submit" name="createNews" value="Create">
                </form>
            </div>
        </div>
    </div>
</section>

