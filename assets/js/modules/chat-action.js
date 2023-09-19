import {ChatSrollMeth, ChatJumpMEth, ChatTextAreaMeth, ChatFocusOn} from "./chat-methods";
import { SelectorReferenceError, ErrorReader } from "./services/error-liblrary";

function chatObserv(chatContainer, textAreaContainer, jumpBtnSelector ) {
      try {
            if (chatContainer !== ".message-list") {
                  throw new SelectorReferenceError(`Відсутній селектор контейнера чату`);
        } else if (textAreaContainer !== "#textarea") {
                  throw new SelectorReferenceError(`Відсутній селектор елемента форми Textarea`);
        }
  
          const scrollOobserver = new ChatSrollMeth(chatContainer, jumpBtnSelector),
                jumpObserber = new ChatJumpMEth(chatContainer,jumpBtnSelector),
                textAreaObserver = new ChatTextAreaMeth(textAreaContainer),
                chatObserv = new ChatFocusOn(textAreaContainer, chatContainer);
                
  
          scrollOobserver.getScrollPos();
          scrollOobserver.setScrollPos();
          scrollOobserver.showJumpToMessageBtn();
          scrollOobserver.hideJumpToMessageBtn();
        
          jumpObserber.JumpTo();
      
          textAreaObserver.textAreaIncrisHeight();
  
          chatObserv.pemanentFocusOn();

      } catch (err) {
            if (err instanceof SyntaxError) {
                 console.error(new ErrorReader("Помилка виконання " + err));
            } else if (err instanceof TypeError) {
                  console.error( new ErrorReader("Помилка використання " + err.stack));
            } else if (err instanceof ReferenceError) {
                  console.error(new ErrorReader("Помилка використання " + err.stack));
            } else {
                  throw new Error("Невідома  помилка " + err.stack)
            }
      }
      
}

export default chatObserv;