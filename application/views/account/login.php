<div class="form-signup">
    <h1>Авторизация</h1>
    <fieldset>
        <form action="/account/login" method="post">
            <input type="text" name="login" placeholder="Логин" required />
            <input type="password" name="password" placeholder="Пароль" required />
            <input type="submit" value="ВОЙТИ" />
        </form>
        <p>Войти через: <span class="social fb">Facebook</span> <span class="social gp">Google +</span></p>
        <p><a href="/account/registration">Нет аккаунта? Регистрация.</a><br>
            <a href="/account/recovery">Забыли пароль?</a></p>
    </fieldset>
</div>