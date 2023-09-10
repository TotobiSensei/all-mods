import ChatSrollMeth from "./chat-scrolling-methods";

function chatObserv(chatContainer) {
    try {
        const observer = new ChatSrollMeth(chatContainer)

        observer.getScrollPos();
        observer.setScrollPos();
        observer.showJumpToMessageBtn();
        observer.hideJumpToMessageBtn();
        observer.JumpTo();

        if (!chatContainer) {
            throw new ReferenceError('Аргумент функції не знайдено')
          }
          
    } catch(e) {
        console.error(e.stack)
      } 
    
}

export default chatObserv;