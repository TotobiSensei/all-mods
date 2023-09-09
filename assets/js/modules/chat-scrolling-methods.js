
// Класс в якому я задав два метода для запоминанія позиції і її вивода
// Я використав клас тому шо так намного проще передавати переменні внутрі двох функцій
// В клас ми передаємо аргумент ( наш блок з смсками)
class ChatSrollMeth {
    constructor(chatContainer) {
        this.chatContainer = chatContainer;
    // перемєнна яка хранить начальну скрольну позицію
        this.storagedScrollPos = 0;
        this.chatBlock = document.querySelector(this.chatContainer);

        // переменна у яку ми визиваєме дані про позицію з локального храниліща браузера
        this.getSevedScrollTop = localStorage.getItem("chatScrollPos");

        // jumpToMessage variables 
        this.scrollPercentage = 0;
        this.jumpBtn = document.querySelector('.jump-btn');
      
    }

    // метод для зчитуванія позиції активної зони юзера перед його виходом з блока
    getScrollPos() {
        // тут ми скролом зчитуємо позицію і передаємо її у локальноє храниліще браузера
        this.chatBlock.addEventListener("scroll", () => {
             this.storagedScrollPos = this.chatBlock.scrollTop;
             localStorage.setItem("chatScrollPos", this.storagedScrollPos)
        })

        
    }

    // метод на перенос нас на сохраньонну позицію при откритії чата 
    setScrollPos() {
        // тут ми провіряємо условія шо кіть у нас записано у локальноє храніліще дашо шо связано з нашим флагом "chatScrollPos" та товди
        // подставити то значенія замість нашого актуалного СКРОЛЛ ТОП = перенести нас на нужні координати
        if (this.getSevedScrollTop) {
            this.chatBlock.scrollTop = this.getSevedScrollTop;
        }
    }

    showJumpToMessageBtn() {
        const getPercentage = () => {
            this.scrollPercentage = Math.round((this.chatBlock.scrollTop / (this.chatBlock.scrollHeight - this.chatBlock.clientHeight)) * 100); 
            if (this.scrollPercentage <= 90) {
                this.jumpBtn.classList.remove('hiden')
            } 
        }

        this.chatBlock.addEventListener("scroll", getPercentage);
    }


    hideJumpToMessageBtn() {
        const getPercentage = () => {
            this.scrollPercentage = Math.round((this.chatBlock.scrollTop / (this.chatBlock.scrollHeight - this.chatBlock.clientHeight)) * 100); 
            if (this.scrollPercentage > 85 || this.scrollPercentage == 100) {
                this.jumpBtn.classList.add('hiden')
            }
        }


        this.chatBlock.addEventListener("scroll", getPercentage);   
    }

    JumpTo() {
    //     const otherMessages = document.querySelectorAll(".other-message");
    //     console.log(otherMessages)
    //     otherMessages.forEach(function(otherMessage) {
    //     const message = otherMessage.querySelector(".unchecked");
    // })
    this.jumpBtn.addEventListener("click", () => {
        this.chatBlock.scrollTop = this.chatBlock.scrollHeight;
        // if (message) {
        //     message.scrollIntoView()
        // } else {
        //     this.chatBlock.scrollTop = this.chatBlock.scrollHeight;
        // }
    })
       
    }

}


export default ChatSrollMeth;




// console.log(this.scrollPercentage)
// this.jumpBtn = document.createElement('div')
//     this.jumpBtn.classList.add('jump-btn')
//     this.jumpBtn.innerHTML = `
//         <span>Jump</span>
//     `