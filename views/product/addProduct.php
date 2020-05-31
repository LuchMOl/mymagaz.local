<?php require_once '/../layouts/header.php'; ?>
<section id='newsletter'  class='newsletter'>
    <div class='hm-foot-menu'>
        <div class='container'><h1>Добавить продукт</h1><hr>

            <form method = 'post' action = '' enctype="multipart/form-data">
                <input name = 'name'  type = 'text' maxlength = '30' size = '30' placeholder = 'name' > Название</input><br><br>
                <input name = 'brand' type = 'text' maxlength = '20' size = '30' placeholder = 'brand'> Бренд</input><br><br>
                <input name = 'size'  type = 'text' maxlength = '20' size = '30' placeholder = 'size' > Размер: В-Ш-Г</input><br><br>
                <input name = 'description' type = 'textarea' maxlength = '20' size = '30' placeholder = 'description'> Описание</input><br><br>
                <input id="file" type="file" name="images[]" multiple>
                <label for="file-input"> Изображения</label><br><hr>

                <input name = 'next' type = submit value = 'Далее >>'>
            </form>
            <hr>
        </div>
    </div>
</section>
<?php require_once '/../layouts/footer.php'; ?>