<?PHP $url = $_SERVER['REQUEST_URI']; ?>
<div class="container my-5" style="width: 50%">
    <h2 class="mb-5 color-broun">Авторизация</h2>
    <form action="<?php echo $url; ?>" method="post" name="auth">
        <label for="login" class="form-label">Введите логин</label>
        <input type="email" class="form-control mb-3" name="login" placeholder="Email" required>
        <label for="password" class="form-label">Введите пароль</label>
        <input type="password" class="form-control mb-3" name="password" placeholder="password" required> 
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
        <input type="submit" class="btn btn-info my-3" name="submit" value="Отправить">            
        <a class="btn btn-outline-info mx-3"  href="/" role="button">На главную</a>     
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
