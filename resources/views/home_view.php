
    <div class="contacts d-flex justify-content-between flex-column z-2 m-3">
        <div class="users_search">
            <form class="d-flex" method="post" name="form_search">
                <input type="search" name="search">
                <input type="submit" value="Поиск">
            </form>

        </div>
        <div class="users_list bg-color my-3">
            <ul id="users_list">
                <?php if (isset($data['contacts'])): ?>
                    <?php foreach ($data['contacts'] as $user): ?>
                        <li class="d-flex align-items-center " id="user_id<?php echo $user['id'] ?>">
                            <img class="photo position-relative"
                                src="<?php echo isset($user['img']) ? '/public/img' . $user['img'] : '/public/img/person-icon.png' ?>"
                            >
                            <div id="messages"></div>
                            <a class="text-decoration-none d-flex" href="/" data-user-id="<?php echo $user['id'] ?>">
                                <?php echo $user['nickname'] ?? $user['login'] ?>
                            </a>                            
                        </li>
                    <?php endforeach ?>
                <?php endif ?>
            </ul>
        </div>

        <div class="hidden" id="options">
            <div class="dropdown">                
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">Удалить</a></li>                    
                </ul>
            </div>
        </div>
        
    </div>
    <div class="chat_window bg-color m-3">
        <div class="message_window position-relative bg-color">
        </div>
        <form id="message_form"></form>
        <div class="input-group input_window z-2 my-5">
            <input type="text" class="form-control" aria-label="With textarea" style="height: 50%;" name="messageInput"
                form="message_form" placeholder="Напишите ваше сообщение" required>
            <!-- <input type="text" class="form-control" id="message_input" name="message" form="message_form" autocomplete="off"> -->
            <input type="hidden" name="toUserId" form="message_form">
            <!-- <input type="hidden" name="connectionId" form="message_form"> -->
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" id="btnSendMsg" form="message_form"
                    disabled>Отправить</button>
            </div>
        </div>
    </div>
    <div class="user_profile bg-color d-flex flex-column m-3">
        
        <div class="d-flex color-blue">
            <a class="nav-link my-3 p-3" href="#">Настройки</a>
        </div>
        
        <div class="d-flex color-blue">
            <a class="nav-link p-3" href="/logout">
                Выход                
            </a>
        </div>
    </div>
    <form id="form_contacts" class="form_contacts" method="post" name="form_contacts">
        <input type="text" name="contact">
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

<script src="/public/js/home.js"></script>
<div style="display: none;" id="contact_list_hidden"> <?php echo json_encode($data['contacts']) ?></div>
