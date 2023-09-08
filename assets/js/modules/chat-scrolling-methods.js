

class ChatSrollMeth {
    constructor(chatContainer) {
        this.chatContainer = chatContainer;
    
        this.storagedScrollPos = 0;
        this.chatBlock = document.querySelector(this.chatContainer);
        this.getSevedScrollTop = localStorage.getItem("chatScrollPos");
      
    }

    getScrollPos() {
        
        this.chatBlock.addEventListener("scroll", () => {
             this.storagedScrollPos = this.chatBlock.scrollTop;
             localStorage.setItem("chatScrollPos", this.storagedScrollPos)
             console.log(this.storagedScrollPos)
            
        })

        console.log(this.storagedScrollPos)
    }

    setScrollPos() {
        console.log(localStorage.getItem("chatScrollPos"))
        if (this.getSevedScrollTop) {
            this.chatBlock.scrollTop = this.getSevedScrollTop;
        }
    }

}


export default ChatSrollMeth;