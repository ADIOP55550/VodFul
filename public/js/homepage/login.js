/*
 *   Copyright (c) 2022
 *   All rights reserved.
 */
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/homepage/login.js ***!
  \****************************************/
/*
 *   Copyright (c) 2022
 *   All rights reserved.
 */
var modalElement;
var loginModal;
var modalSwitcher;
var switcherLoginIndex = 0;
var switcherRegisterIndex = 1;
console.log("start");
document.addEventListener("DOMContentLoaded", function () {
  console.log("DOMContentLoaded");
  modalElement = document.querySelector("#login-modal");
  modalSwitcher = UIkit.switcher(modalElement.querySelector("#login-switcher"));
  loginModal = UIkit.modal(modalElement); // timeout needed, because else /login was added without reason

  setTimeout(function () {
    console.log("load"); // remove /login and /register on login modal close

    modalElement.addEventListener('hide', function () {
      console.log("removing /login and /register");
      window.history.pushState({}, "", window.location.href.substring(0, (window.location.href.lastIndexOf("/login") + 1 || window.location.href.lastIndexOf("/register") + 1) - 1));
    }); // add /login on login modal open

    UIkit.util.on('#login-form-wrapper', 'beforeshow', function () {
      console.log("adding /login");
      window.history.pushState({}, "", "/login");
    }); // add /register on login modal open

    UIkit.util.on('#register-form-wrapper', 'beforeshow', function () {
      console.log("adding /register");
      window.history.pushState({}, "", "/register");
    });
  }, 300);
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
