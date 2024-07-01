const from= document.querySelector('#formPostB');
const titleimput= document.querySelector('#postnameinput');
const contentpost= document.querySelector('#postcontentinput');
const message= document.querySelector('#message');

function validCont(contents){
    return contents.length >= 100 && contents.length <= 1000
}
function validTitle(title){
    return title.length >= 10 && title.length <= 30
}
from.addEventListener('submit',function(e){
    e.preventDefault();
    message.textContent = '';
    if (!validTitle(titleimput.value)){
        message.textContent = 'Please enter title between 10 and 30 characters';
        titleimput.focus();
        return;
    }
    if (!validCont(contentpost.value)){
        message.textContent = 'fill the contents with between 100/1000 characters';
        contentpost.focus();
        return;
    }
    from.submit();
});