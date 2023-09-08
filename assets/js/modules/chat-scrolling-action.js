import ChatSrollMeth from "./chat-scrolling-methods";

function chatObserv(chatContainer) {
    const observer = new ChatSrollMeth(chatContainer)

    observer.getScrollPos();
    observer.setScrollPos();
}

export default chatObserv;