<?PHP $url = $_SERVER['REQUEST_URI']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <title>Мессенджер</title>
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid mt-2">                   
                    <a class="nav-link" href="<?=URL ?>">
                        <h4> 
                            <span class="color-blue">Simple</span>Messenger
                        </h4>
                    </a>                        
                </div>
            </nav>
        </div>  
    </header>                             
    <hr>  
    <main class="main"> 
        <div class="container">     
            <div class="main d-flex overflow-hidden">    
                <?php include VIEWS .'/'. $content_view; ?>                
            </div> 
        </div>                      
    </main>  
</body>
</html>
