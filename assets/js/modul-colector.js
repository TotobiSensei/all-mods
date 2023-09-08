import modalAction from "./modules/modal-action";
import userIMg from "./modules/user_img";
import paginationReplacement from "./modules/pagination-replacement";
import keyModyfier from "./modules/send-message-methods";
import chatObserv from "./modules/chat-scrolling-action";
// import checkVisibleMessages from "./modules/Up-date-messages";

// window.addEventListener("load", checkVisibleMessages);

window.addEventListener("DOMContentLoaded", () => {
    // Отправляем AJAX-запросы для видимых сообщений при загрузке страницы
// Отправляем AJAX-запросы для видимых сообщений при скроллинге в области "message-list"
// document.getElementById("message-list").addEventListener("scroll", checkVisibleMessages);


    modalAction();
    userIMg();
    paginationReplacement();

    keyModyfier(".bottom form")
    chatObserv(".message-list")

})