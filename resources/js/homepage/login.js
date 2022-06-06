/*
 *   Copyright (c) 2022
 *   All rights reserved.
 */
let modalElement;
let loginModal;
let modalSwitcher;
const switcherLoginIndex = 0;
const switcherRegisterIndex = 1;
console.log("start");

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOMContentLoaded");
    modalElement = document.querySelector("#login-modal");
    modalSwitcher = UIkit.switcher(modalElement.querySelector("#login-switcher"));
    loginModal = UIkit.modal(modalElement);

    // timeout needed, because else /login was added without reason
    setTimeout(() => {
        console.log("load");

        // remove /login and /register on login modal close
        modalElement.addEventListener('hide', () => {
            console.log("removing /login and /register");
            window.history.pushState({}, "", window.location.href.substring(0, ((window.location.href.lastIndexOf("/login") + 1) || (window.location.href.lastIndexOf("/register") + 1)) - 1));
        });

        // add /login on login modal open
        UIkit.util.on('#login-form-wrapper', 'beforeshow', function () {
            console.log("adding /login")
            window.history.pushState({}, "", "/login");
        });

        // add /register on login modal open
        UIkit.util.on('#register-form-wrapper', 'beforeshow', function () {
            console.log("adding /register")
            window.history.pushState({}, "", "/register");
        });
    }, 300);
});


window.openLoginModal = () => {
    if (modalElement) {
        loginModal.show();
        modalSwitcher.show(switcherLoginIndex);
    } else setTimeout(openLoginModal, 20);
}

window.openRegisterModal = () => {
    if (modalElement) {
        loginModal.show();
        modalSwitcher.show(switcherRegisterIndex);
    } else setTimeout(openLoginModal, 20);
}
