<div id="footer-push">
    <form class="contact_form" action="/contact" method="post">
        <ul>
            <li>
                <h2>Обратная связь</h2>
                <span class="required_notification">* Поля, обязательные для заполнения</span>
            </li>
            <li>
                <label for="name">Имя:</label>
                <input type="text"  placeholder="Иванов Иван" name="name" required />
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="login@example.com" required />
                <span class="form_hint">Правильный формат "name@something.com"</span>
            </li>
            <li>
                <label for="message">Сообщение:</label>
                <textarea name="message" cols="40" rows="6" required ></textarea>
            </li>
            <li>
                <button class="submit" type="submit">Отправить</button>
            </li>
        </ul>
    </form>
</div>

