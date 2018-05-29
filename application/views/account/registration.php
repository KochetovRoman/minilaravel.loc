<div class="form-signup">
    <h1>Регистрация</h1>
    <fieldset>
        <p class="login-msg"></p>
        <form action="/account/registration" method="post">
            <input type="text" name="login" placeholder="Имя пользователя" required />
            <input type="email" name="email" placeholder="Введите Ваш email адрес..." required />
            <input type="password" name="password" placeholder="Ваш сложный пароль..." required />
            <input type="submit" value="Зарегистрироваться" />
        </form>
        <p>Войти через: <span class="social fb">Facebook</span> <span class="social gp">Google +</span></p>
        <a href="/account/login">Уже зарегистрированы? Войти.</a>
    </fieldset>
</div>