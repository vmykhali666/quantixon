const userForm = document.querySelector('.user-form');

const makeSendObject = form => {
    let sendObj = {};

    for(let element of form.elements) {
        if (element.hasAttribute ('name')) {
            sendObj[element.name] = element.value;
        }
    }

    return sendObj;
}

userForm.addEventListener('submit', event=>{
    event.preventDefault();
    let xhr = new XMLHttpRequest();
    let method = 'POST';
    let url = 'save_data.php';
    let sendJSON = JSON.stringify(makeSendObject(userForm));

    //здесь еще на фронте можно валидацию сделать, перед отправкой, но этого нет в тз
    xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
        }
    };
    xhr.open(method, url);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.send('user=' + sendJSON)
})
