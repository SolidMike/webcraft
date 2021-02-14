<h3>Вход</h3>
<form action="/login" method="post">
    <div class="form-group">
        <label for="name">Логин</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Введите имя" value="">
        <small id="namelHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Введите email" value="">
        <small id="emailHelp" class="form-text text-muted"></small>
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>