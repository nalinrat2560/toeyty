const container = document.getElementById('container');
const registerBTN = document.getElementById('register');
const loginBTN = document.getElementById('login');

registerBTN.addEventListener('click',() => {
    container.classList.add("active");
});

loginBTN.addEventListener('click',() =>{
    container.classList.remove("active");
});