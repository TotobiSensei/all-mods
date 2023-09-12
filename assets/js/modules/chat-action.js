import {ChatSrollMeth, ChatJumpMEth} from "./chat-methods";

function chatObserv(chatContainer) {
    try {
        const scrollOobserver = new ChatSrollMeth(chatContainer),
              jumpObserber = new ChatJumpMEth(chatContainer)

        scrollOobserver.getScrollPos();
        scrollOobserver.setScrollPos();
        scrollOobserver.showJumpToMessageBtn();
        scrollOobserver.hideJumpToMessageBtn();

        jumpObserber.JumpTo()

        if (!chatContainer) {
            throw new ReferenceError('Аргумент функції не знайдено')
          }

    } catch(e) {
        console.error(e.stack)
      } 
    
}

export default chatObserv;