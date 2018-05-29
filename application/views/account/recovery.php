<div class="form-signup">
    <h1>Восстановление пароля</h1>
    <fieldset>
        <p class="login-msg"></p>
        <form action="/account/recovery" method="post">

            <input type="email" name="email" placeholder="Введите Ваш email адрес..." required />

            <input type="submit" value="Восстановить пароль" />
        </form>
        <p>Войти через: <span class="social fb">Facebook</span> <span class="social gp">Google +</span></p>
        <a href="/account/login">Уже зарегистрированы? Войти.</a>
    </fieldset>
</div>