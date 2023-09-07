import checkMessageStatus from "./check-message";
import {checkMessageStatusInActionExpo} from "./check-message";

function messageAction(perentBlock) {
    const container = document.querySelector(perentBlock);
    const containerRec = container.getBoundingClientRect();
    const containerElem = Array.from(container.children);
    // const currentUrl = window.location.href;
    // функція яка провіряє статус смс при прогрузці
    checkMessageStatus(containerElem, containerRec)
    // функція яка провіря статус смс при скролі
    checkMessageStatusInActionExpo(container, containerElem, containerRec)

//   фильтр на сообщение собеседника ЗАДАЧА 3
}

export default messageAction;