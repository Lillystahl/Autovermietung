// JavaScript code for next and previous buttons (slider functionality)
let next = document.querySelector('.next');
let prev = document.querySelector('.prev');

next.addEventListener('click', function(){
    let items = document.querySelectorAll('.item');
    document.querySelector('.slide').appendChild(items[0]);
});

prev.addEventListener('click', function(){
    let items = document.querySelectorAll('.item');
    document.querySelector('.slide').prepend(items[items.length - 1]);
});

// JavaScript to toggle the modal and blur effect
var loginButton = document.getElementById('loginButton');
var modalContainer = document.getElementById('modalContainer');
var blurBackground = document.querySelector('.background');
var form = document.getElementById('container1')

loginButton.addEventListener('click', function() {
    modalContainer.classList.toggle('active');
    blurBackground.classList.toggle('blur');
    form.classList.toggle('container1');
});

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container1');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});