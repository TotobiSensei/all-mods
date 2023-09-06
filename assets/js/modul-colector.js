import modalAction from "./modules/modal-action";
import userIMg from "./modules/user_img";
import paginationReplacement from "./modules/pagination-replacement";
import messageAction from "./modules/message-action";

window.addEventListener('DOMContentLoaded', () => {
    modalAction();
    userIMg();
    paginationReplacement();

    messageAction(".message-list");
})