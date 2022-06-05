let modalElement;
let loginModal;
let modalSwitcher;
const switcherLoginIndex = 0;
const switcherRegisterIndex = 1;
let switcherLoginElement;
let switcherRegisterElement;

document.addEventListener("DOMContentLoaded", () => {
    console.log("start");
    modalElement = document.querySelector("#login-modal");
    modalSwitcher = UIkit.switcher(modalElement.querySelector("#login-switcher"));
    switcherLoginElement = modalElement.querySelector("#login-form-wrapper");
    switcherRegisterElement = modalElement.querySelector("#register-form-wrapper");

    loginModal = UIkit.modal(modalElement);

    // remove /login and /register on login modal close
    modalElement.addEventListener('hide', () => {
        window.history.pushState({}, "", window.location.href.substring(0, ((window.location.href.lastIndexOf("/login") + 1) || (window.location.href.lastIndexOf("/register"))) - 1));
    });
    // add /login on login modal open
    switcherLoginElement.addEventListener('beforeshow', () => {
        window.history.pushState({}, "", "/login");
    });
    // add /register on login modal open
    switcherRegisterElement.addEventListener('beforeshow', () => {
        window.history.pushState({}, "", "/register");
    });


    console.log(switcherRegisterElement);
    console.log(switcherLoginElement);
    UIkit.util.on('#register-form-wrapper', 'show', function () {
        console.log("Shown");
    });
    UIkit.util.on('#login-form-wrapper', 'hide', function () {
        console.log("Hidden");
    });
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
