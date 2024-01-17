document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    if (error === 'failed') {
        const message = document.createElement('div');
        message.textContent = 'Failed to insert user information';
        message.style.position = 'fixed';
        message.style.bottom = '20px';
        message.style.right = '20px';
        message.style.padding = '10px 20px';
        message.style.backgroundColor = '#FF0000';
        message.style.color = '#fff';
        message.style.borderRadius = '5px';
        message.style.zIndex = '9999';

        document.body.appendChild(message);

        // Remove the message after 5 seconds to the right of the screen whit animation
        setTimeout(function () {
            message.style.right = '-500px';
            // transition animation
            message.style.transition = 'all 0.5s ease-in-out';
            message.style.opacity = '0';

            setTimeout(function () {
                message.remove();
            }, 5000);
        }, 5000);

    }
});

// Login message
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const registered = urlParams.get('registered');

    if (registered === 'true') {
        const message = document.createElement('div');
        message.textContent = 'Registration successful! Please log in.';
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
            message.style.right = '-500px';
            // transition animation
            message.style.transition = 'all 0.5s ease-in-out';
            message.style.opacity = '0';

            setTimeout(function () {
                message.remove();
            }, 5000);
        }, 5000);
    }
});



// scroll animation
document.addEventListener("DOMContentLoaded", function () {
    const animation = document.querySelectorAll('.animation');
    window.addEventListener('scroll', checkAnimation);

    function checkAnimation() {
        const trigger = window.innerHeight / 5 * 4;

        animation.forEach(anim => {
            const animationTop = anim.getBoundingClientRect().top;

            if (animationTop < trigger) {
                anim.classList.add('show');
            } else {
                anim.classList.remove('show');
            }
        })
    }
})
const favorite = document.querySelector(".favorite");
const favoriteList = document.querySelector(".favoritelist");
const user = document.querySelector(".user");
const menu = document.querySelector(".user-menu");

const hamburgermenu = document.querySelector(".hamburegremenu");
const navMenu = document.querySelector(".links");

hamburgermenu.addEventListener("click", () => {
    hamburgermenu.classList.toggle("active");
    navMenu.classList.toggle("active");
});

document.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
        hamburgermenu.classList.remove("active");
        navMenu.classList.remove("active");
    });
});

favorite.addEventListener("click", () => {
    favoriteList.style.display = (favoriteList.style.display === "none" || favoriteList.style.display === "") ? "flex" : "none";
});

user.addEventListener("click", () => {
    menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "flex" : "none";
})


