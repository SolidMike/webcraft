<h3>Регистрация</h3>
<form action="/register" method="post" enctype="multipart/form-data" novalidate>
    <div class="form-group">
        <label for="name">Логин</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Введите имя" value="">
        <small id="namelHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
        <label for="email1">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Введите email" value="">
        <small id="emailHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
        <label for="image">Ваше фото</label>
        <input type="file" class="form-control-file" id="image" name="image" value="">
    </div>
    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>