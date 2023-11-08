<?PHP $url = $_SERVER['REQUEST_URI']; ?>
<div class="container my-5 width-50" style="width: 50%">
    <h2 class="mb-5 color-broun">Регистрация</h2>

    <form method="post" id="registerForm">
        <label for="nickname" class="form-label">Введите Никнэйм</label>
        <input type="text" class="form-control mb-3" name="nickname" placeholder="Nickname">
        <label for="login" class="form-label">Введите логин</label>
        <input type="email" class="form-control mb-3" name="login" placeholder="Email" required>
        <label for="password" class="form-label">Введите пароль</label>
        <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
        
        <input type="submit" class="btn btn-info my-3" name="submit" value="Отправить">
        <a class="btn btn-outline-info mx-3"  href="<?=URL ?>" role="button">На главную</a> 
    </form>
    <?php if ($data) : ?>
        <div class="alert alert-warning" role="alert">
            <?=$data ?>
        </div>
    <?php endif ?>    
</div>
<script src="public/js/register.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
