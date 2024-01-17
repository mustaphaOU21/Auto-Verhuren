// Login message
document.addEventListener("DOMContentLoaded", function () {
    const selectRol = document.getElementById('role');
    const urlParams = new URLSearchParams(window.location.search);
    const registered = urlParams.get('added');

    if (registered === 'true') {
        const message = document.createElement('div');
        message.textContent = 'The ' + selectRol.value + ' has been added.';
        message.style.position = 'fixed';
        message.style.bottom = '20px';
        message.style.right = '20px';
        message.style.padding = '10px 20px';
        message.style.backgroundColor = '#42b883';
        message.style.color = '#fff';
        message.style.borderRadius = '5px';
        message.style.zIndex = '9999';

        document.body.appendChild(message);

        setTimeout(function () {
            message.remove();
        }, 5000);
    }
});