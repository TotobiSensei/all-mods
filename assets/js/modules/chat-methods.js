
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
        this.jumpBtn = document.querySelector(".jump-btn");
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

    // метод за допомогою якого ми виводимо кнопку джамп
    showJumpToMessageBtn() {
        const getPercentage = () => {
            // тут ми получаємо прогресс скролла нашої сторінки
            this.scrollPercentage = Math.round((this.chatBlock.scrollTop / (this.chatBlock.scrollHeight - this.chatBlock.clientHeight)) * 100); 
            // якщо умова спрацьовує ми виводимо кнопку 
            if (this.scrollPercentage <= 99) {
                this.jumpBtn.classList.remove("hiden")
            } 
        }

        // тут ми накладаємо оброблювач подій 
        this.chatBlock.addEventListener("scroll", getPercentage);
    }

 // метод за допомогою якого ми приховуємо  кнопку джамп
    hideJumpToMessageBtn() {
        const getPercentage = () => {
            // тут ми получаємо прогресс скролла нашої сторінки
            this.scrollPercentage = Math.round((this.chatBlock.scrollTop / (this.chatBlock.scrollHeight - this.chatBlock.clientHeight)) * 100); 
            // якщо умова спрацьовує ми ховаємо кнопку 
            if (this.scrollPercentage >= 99 ) {
                this.jumpBtn.classList.add("hiden")
            }
        }

        // тут ми накладаємо оброблювач подій 
        this.chatBlock.addEventListener("scroll", getPercentage);   
    }

}


class ChatJumpMEth extends ChatSrollMeth {
    constructor(chatContainer) {
        super(chatContainer);
        this.chatBlock = document.querySelector(this.chatContainer);
        this.otherMessages = document.querySelectorAll(".other-message");
        this.isUnchecked = false;
    }

    
    // метод який виконує дію стрибка
    JumpTo() {

        // знизу до першої перевірки умови ми отримуємо наші смс та прапорець який ми використаємо аби виконати першу умову

        this.otherMessages.forEach( otherMessage  => {
            this.message = otherMessage.querySelector(".unchecked");

            if (this.message) this.isUnchecked = true
    })

    // Якщо умова виконана тоді ми переносимося на непрочитану смск
    if (this.isUnchecked) {
        this.jumpBtn.addEventListener("click", () => {
           const message =  document.querySelector(".other-message .unchecked");

           if (message)  message.scrollIntoView({behavior: "smooth", block: "end", inline: "center"});
        });
        
    }  else {
    // Якщо умова не виконана тоді ми просто переносимося в кінець нашої сторінки
        this.jumpBtn.addEventListener("click", () => {
            this.chatBlock.scrollTop = this.chatBlock.scrollHeight;
        })
    }


    
    }   
}

export  {ChatSrollMeth, ChatJumpMEth};
