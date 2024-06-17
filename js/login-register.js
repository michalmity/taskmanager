function adjustContainerHeight() {
    const container = document.getElementById('container');
    const formLogin = document.getElementById('form-login');
    const formRegister = document.getElementById('form-register');

    if (formLogin.style.display === 'none') {
        container.style.height = `${formRegister.scrollHeight}px`;
    } else {
        container.style.height = `${formLogin.scrollHeight}px`;
    }
}

document.getElementById('show-register').addEventListener('click', function() {
    document.getElementById('form-login').style.display = 'none';
    document.getElementById('form-register').style.display = 'block';
    adjustContainerHeight();
});

document.getElementById('show-login').addEventListener('click', function() {
    document.getElementById('form-register').style.display = 'none';
    document.getElementById('form-login').style.display = 'block';
    adjustContainerHeight();
});

window.addEventListener('load', adjustContainerHeight);