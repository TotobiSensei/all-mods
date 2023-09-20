import carusel from "./modules/carusel";
import userIMg from "./modules/user_img";
import paginationReplacement from "./modules/pagination-replacement";
import keyModyfier from "./modules/send-message-methods";
import chatObserv from "./modules/chat-action";
import checkVisibleMessages from "./modules/Up-date-messages";
import modalAction from "./modules/modal-action";
import { MissingElementError, SelectorReferenceError, ErrorReader} from "./modules/services/error-liblrary";

// Ініціалізація методів глобального обьекта
window.addEventListener("load", checkVisibleMessages);
window.addEventListener("DOMContentLoaded", (e) => {


    try {
        // Отправляем AJAX-запросы для видимых сообщений при загрузке страницы
        // Отправляем AJAX-запросы для видимых сообщений при скроллинге в области "message-list"
        document.getElementById("message-list").addEventListener("scroll", checkVisibleMessages);
    } catch (err) {

    }

    try {
        // Ініціалізація модулів
        carusel(".main-carousel");
        checkVisibleMessages();
        userIMg({
            imagePrevSlc: "image-preview", 
            cropBtnSlc: "crop-button",
            userIdSlc: "userId", 
            imageInputSlc: "image-input", 
            userImageSlc: "user-image", 
            addImgSlc: "add-img", 
            toDataUrlSlc: "image/png",
            cropImgSlc: "cropped-image", 
            ImgInputSlc: "image-input",
            loadImgSlc: 'load-img'
        
        });
        paginationReplacement();
        keyModyfier(".bottom form");
        chatObserv(".message-list","#textarea", ".jump-btn");
        modalAction();
        
    } finally {
        console.log("All methods works properly")
    }

})

