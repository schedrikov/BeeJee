<h1>Добавить задачу</h1>
<div class="container-sm form-width border">
    <?php if (strlen($data['error_text']) > 0) { ?>
        <div class="container warning text-danger border shadow-sm p-3 mb-5 bg-body rounded">
            <p><?= $data['error_text'] ?></p>
        </div>
    <?php } ?>
    <form method="post">
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Имя пользователя</label>
            <input type="text" name="name" class="form-control" id="exampleInputName1" value="<?= $data['form_data']['name']; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?= $data['form_data']['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputText1" class="form-label">Текст задачи</label>
            <input type="text" name="text" class="form-control" id="exampleInputText1" value="<?= $data['form_data']['text']; ?>">
        </div>
        <input type="hidden" name="addtask" value="1">
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>