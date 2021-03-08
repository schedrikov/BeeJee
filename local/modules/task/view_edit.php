<h1>Редактирование задачи</h1>
<div class="container-sm form-width border">
    <?php if (strlen($data['error_text']) > 0) { ?>
        <div class="container warning text-danger border shadow-sm p-3 mb-5 bg-body rounded">
            <p><?= $data['error_text'] ?></p>
        </div>
    <?php } ?>
    <form method="post">
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Имя пользователя</label>
            <input type="text" name="name" class="form-control" id="exampleInputName1" value="<?= $data['form_data']['name']; ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?= $data['form_data']['email']; ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="exampleInputText1" class="form-label">Текст задачи</label>
            <input type="text" name="text" class="form-control" id="exampleInputText1" value="<?= $data['form_data']['text']; ?>">
        </div>
        <div class="mb-3">
            <input type="checkbox" name="status" class="form-check-input" id="exampleInputStatus1" <?= ($data['form_data']['status'] == 1) ? 'checked' : ''; ?>>
            <label for="exampleInputStatus1" class="form-label">Выполнено</label>
        </div>
        <input type="hidden" name="savetask" value="1">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>