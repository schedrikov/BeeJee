<h1>Авторизация</h1>
<div class="container-sm form-width border">
    <?php if ($data['admin'] == 0) { ?>
        <?php if (strlen($data['error_text']) > 0) { ?>
            <div class="container warning text-danger border shadow-sm p-3 mb-5 bg-body rounded">
                <p><?= $data['error_text'] ?></p>
            </div>
        <?php } ?>
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" id="exampleInputName1" value="<?= $data['form_data']['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPass1" class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" id="exampleInputPass1" value="<?= $data['form_data']['password']; ?>">
            </div>
            <input type="hidden" name="userlogin" value="1">
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    <?php } else { ?>
        <form method="post">
            <div class="mb-3">
                <p>Вы авторизованы.</p>
            </div>
            <input type="hidden" name="userlogout" value="1">
            <button type="submit" class="btn btn-primary">Выйти</button>
        </form>
    <?php } ?>
</div>
