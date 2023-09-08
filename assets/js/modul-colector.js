import modalAction from "./modules/modal-action";
import userIMg from "./modules/user_img";
import paginationReplacement from "./modules/pagination-replacement";
import messageAction from "./modules/message-action";
import keyModyfier from "./modules/send-message-methods";
import chatObserv from "./modules/chat-scrolling-action";

window.addEventListener("DOMContentLoaded", () => {
    modalAction();
    userIMg();
    paginationReplacement();

    messageAction(".message-list");
    keyModyfier(".bottom form")
    chatObserv(".message-list")

})