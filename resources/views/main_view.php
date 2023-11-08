<?PHP $url = $_SERVER['REQUEST_URI']; ?>
<body>
    <div class="w-100 p-3 vh-100 bg-color">
        <div class="content">
            <h1 class="text-center my-5 color-blue"></h1>
            <h2 class="text-center"></h2>
        </div>
        <div class="d-flex justify-content-center p-5">   
            <a class="btn btn-info btn-block m-3 px-5" href="/register" role="button">Регистрация</a>  
            <a class="btn btn-secondary btn-block m-3"  href="/auth" role="button">Войти</a>   
        </div>
    </div>  
</body>
