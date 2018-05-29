<div class="form-signup">
    <h1><?php echo $title; ?></h1>
    <fieldset>
        <form action="/account/profile" method="post">
            <label>Логин:</label>
            <input type="text" name="login" value="<?php echo $_SESSION['account']['login']; ?>" disabled />
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $_SESSION['account']['email']; ?>" required />
            <label>Новый пароль для входа:</label>
            <input type="password" name="password" placeholder="Ваш сложный пароль..." />
            <input type="submit" value="Сохранить" />

        </form>

            <p><a href="/account/recovery">Забыли пароль?</a> | <a  href="/account/logout" >Выход</a></p>
        <p><a href="/">На главную</a></p>

    </fieldset>
</div>
