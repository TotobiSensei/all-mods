import {ChatSrollMeth, ChatJumpMEth, ChatTextAreaMeth} from "./chat-methods";

function chatObserv(chatContainer, textAreaContainer) {
    try {
        const scrollOobserver = new ChatSrollMeth(chatContainer),
              jumpObserber = new ChatJumpMEth(chatContainer),
              textAreaObserver = new ChatTextAreaMeth(textAreaContainer);
        scrollOobserver.getScrollPos();
        scrollOobserver.setScrollPos();
        scrollOobserver.showJumpToMessageBtn();
        scrollOobserver.hideJumpToMessageBtn();

        jumpObserber.JumpTo()

        textAreaObserver.textAreaIncrisHeight()

        if (!chatContainer) {
            throw new ReferenceError('Аргумент функції не знайдено')
          }

    } catch(e) {
        console.error(e.stack)
      } 
    
}

export default chatObserv;