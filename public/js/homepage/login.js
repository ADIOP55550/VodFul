/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/homepage/login.js ***!
  \****************************************/
var modalElement;
var loginModal;
var modalSwitcher;
var switcherLoginIndex = 0;
var switcherRegisterIndex = 1;
var switcherLoginElement;
var switcherRegisterElement;
document.addEventListener("DOMContentLoaded", function () {
  console.log("start");
  modalElement = document.querySelector("#login-modal");
  modalSwitcher = UIkit.switcher(modalElement.querySelector("#login-switcher"));
  switcherLoginElement = modalElement.querySelector("#login-form-wrapper");
  switcherRegisterElement = modalElement.querySelector("#register-form-wrapper");
  loginModal = UIkit.modal(modalElement); // remove /login and /register on login modal close

  modalElement.addEventListener('hide', function () {
    window.history.pushState({}, "", window.location.href.substring(0, (window.location.href.lastIndexOf("/login") + 1 || window.location.href.lastIndexOf("/register")) - 1));
  }); // add /login on login modal open

  switcherLoginElement.addEventListener('beforeshow', function () {
    window.history.pushState({}, "", "/login");
  }); // add /register on login modal open

  switcherRegisterElement.addEventListener('beforeshow', function () {
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

window.openLoginModal = function () {
  if (modalElement) {
    loginModal.show();
    modalSwitcher.show(switcherLoginIndex);
  } else setTimeout(openLoginModal, 20);
};

window.openRegisterModal = function () {
  if (modalElement) {
    loginModal.show();
    modalSwitcher.show(switcherRegisterIndex);
  } else setTimeout(openLoginModal, 20);
};
/******/ })()
;