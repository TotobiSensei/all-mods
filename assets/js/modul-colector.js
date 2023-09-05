import modalAction from "./modules/modal-action";
import userIMg from "./modules/user_img";
import paginationReplacement from "./modules/pagination-replacement";
import checkMessageStatus from "./modules/check-message";

window.addEventListener('DOMContentLoaded', () => {
    modalAction();
    userIMg();
    paginationReplacement();

    checkMessageStatus(".message-list");
})