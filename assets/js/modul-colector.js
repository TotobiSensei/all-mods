import carusel from "./modules/carusel";
import userIMg from "./modules/user_img";
import paginationReplacement from "./modules/pagination-replacement";
import keyModyfier from "./modules/send-message-methods";
import chatObserv from "./modules/chat-scrolling-action";
import checkVisibleMessages from "./modules/Up-date-messages";
import modalAction from "./modules/modal-action";

// Ініціалізація методів глобального обьекта
window.addEventListener("load", checkVisibleMessages);
window.addEventListener("DOMContentLoaded", (e) => {

// Отправляем AJAX-запросы для видимых сообщений при загрузке страницы
// Отправляем AJAX-запросы для видимых сообщений при скроллинге в области "message-list"
try {
    document.getElementById("message-list").addEventListener("scroll", checkVisibleMessages);
} catch {
    
}





// Ініціалізація модулів
    checkVisibleMessages()
    userIMg();
    paginationReplacement();
    carusel();
    keyModyfier(".bottom form")
    chatObserv(".message-list")
    modalAction()
    
})