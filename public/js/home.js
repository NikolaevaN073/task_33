document.addEventListener('DOMContentLoaded', web_socket());

function web_socket() {

    const userId = getCookie('user_id');
    //console.log (userId);
    let nickname;
    let notification;
    let isEdit = false;
    const users = {
        0: userId,
        1: null
    };

    const socket = new WebSocket('ws://127.0.0.1:9000/home?userId=' + userId);

    //console.log(socket.readyState);

    socket.addEventListener('error', (error) => {
        alert('Ошибка соединения ' + error.message);
    });

    socket.addEventListener('open', (event) => {
        console.log('Connected to server');
    });

    socket.addEventListener('close', (event) => {
        alert('Соединение закрыто');        
    });   
   
    
    document.querySelector('#btnSendMsg').disabled = false;
    let messages = sendData(users, url);
    messages.then(result => {
        result.reverse().forEach(res => {
            if (res.from_id != userId) {
                let p = document.createElement('p');
                p.style.textAlign = 'left'
                p.innerText = parseInt(res.nickname) ? res.nickname + ': ' + res.text : res.login + ': ' + res.text;
                div.appendChild(p);
                div.lastChild.scrollIntoView();
            } else {
                let p = document.createElement('p');
                p.style.textAlign = 'right';
                p.style.paddingRight = '5px';
                if (url == '/chat/group') {
                    p.setAttribute('data-group-id', res.id);
                } else {
                    p.setAttribute('data-mess-id', res.id);
                }                
                p.innerHTML = '<span>' + res.text + '</span>' + '<span> :' + (parseInt(res.nickname) ? res.nickname : res.login) + '</span>';
                div.appendChild(p);
                div.lastChild.scrollIntoView();
            }
        })
    });       
    
    async function sendData(data, url) {        
        let formData = new FormData();
        if (data) {
            Object.entries(data).forEach((entry) => {
                const [key, value] = entry;
                formData.append(key, value);
            });
        }

        let response = await fetch(url, {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            let result = await response.json();
            return result;
        }
        return false;        
    }
        
    
        document.forms.form_search.addEventListener('submit', async (event) => {
            event.preventDefault();
            let response = await fetch('/home', {
                method: 'POST',
                body: new FormData(document.forms.form_search)
            });
    
            let result = await response.json();
            if (result.error) {
                document.querySelector('.users_search_error').classList.add('users_search_active');
            }
    
            if (result.id) {
                document.querySelector('.form_contacts_submit').classList.add('form_contacts_submit_active');
                document.querySelector('.form_contacts input[type=text]').value = result.id;
            }
        });
    
    
    if (document.forms.form_contacts) {
        document.forms.form_contacts.addEventListener('submit', async (event) => {
            event.preventDefault();
            if (document.querySelector('.form_contacts_submit_active')) document.querySelector('.form_contacts_submit_active').classList.remove('form_contacts_submit_active');
            let response = await fetch('/home', {
                method: 'POST',
                body: new FormData(document.forms.form_contacts)
            });
    
            let result = await response.json();
        });
    }
    
    

    socket.addEventListener('message', (event) => {

        const dataSocket = JSON.parse(event.data);
        
        if (dataSocket.action == 'Connected') {
            if (dataSocket.userId != userId) {
                let user = document.querySelector('#userId' + dataSocket.userId + ' .status');
                user.classList.add('active');
            } else {
                nickname = dataSocket.nickname;
                notification = dataSocket.notification;
            }
        }

        if (dataSocket.action == 'PrivateMessage') {
            if (document.querySelector('.active_user') && users[1] == dataSocket.fromUserId) {
                let messWindow = document.querySelector('.message_window div');
                if (dataSocket.fromUserId != userId) {
                    let p = document.createElement('p');
                    p.style.textAlign = 'left'
                    p.innerText = dataSocket.nickname + ': ' + dataSocket.text;
                    messWindow.appendChild(p);
                    messWindow.lastChild.scrollIntoView();
                } else {
                    let p = document.createElement('p');
                    p.style.textAlign = 'right'
                    p.style.paddingRight = '5px'
                    p.innerHTML = '<span>' + res.text + '</span>' + '<span> :' + dataSocket.nickname + '</span>';
                    messWindow.appendChild(p);
                    messWindow.lastChild.scrollIntoView();
                }
            } else {
                let messNum = document.querySelector('#userId' + dataSocket.fromUserId + ' #messages');
                messNum.classList.add('messages');
                if (messNum.textContent) {
                    messNum.textContent = (parseInt(messNum.textContent) + 1);
                } else {
                    messNum.textContent = 1;
                }
            }            
        }       

        if (dataSocket.action == 'Disconnected') {
            if (dataSocket.userId != userId) {
                let user = document.querySelector('#userId' + dataSocket.userId + ' .status');
                user.classList.remove('active');
            }
        }
    });

    if (document.forms.message_form) {
        let form = document.forms.message_form;

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            let msgWindow = document.querySelector('.message_window div');
            let msg = form.messageInput.value;
            let toUserId = form.toUserId.value;

            let p = document.createElement('p');
            p.style.textAlign = 'right'
            p.style.paddingRight = '5px'
            p.innerHTML = '<span>' + msg + '</span>' + '<span> :' + nickname + '</span>';
            if (!isEdit) {
                msgWindow.appendChild(p);
            }
            isEdit = false;
            msgWindow.lastChild.scrollIntoView();
            let obj = {
                fromUserId: userId,
                toUserId: toUserId,
                groupId: null,
                action: 'PrivateMessage',
                text: msg
            }


            if (!form.getAttribute('data-action')) {
                socket.send(JSON.stringify(obj));
            } else {
                form.removeAttribute('data-action');
            }

            form.reset();
        });

        form.messageInput.addEventListener('keypress', function (event) {
            if (event.code == 'Enter' && !event.ctrlKey) {
                document.querySelector('#btnSendMsg').focus();
                document.querySelector('#btnSendMsg').click();
            }
            if (event.code == 'Enter' && event.ctrlKey) this.value = this.value + '\n';
        });
    }
}

function getCookie(name) {
    let matches = document.cookie.match(
        new RegExp(
            '(?:^|; )' +
            name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') +
            '=([^;]*)'
        )
    );
    if (matches) return decodeURIComponent(matches[1]);
    return undefined;
}
