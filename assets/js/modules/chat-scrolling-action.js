import ChatSrollMeth from "./chat-scrolling-methods";

function chatObserv(chatContainer) {
    try {
        const observer = new ChatSrollMeth(chatContainer)

        observer.getScrollPos();
        observer.setScrollPos();
    } catch {

    }
    
}

export default chatObserv;