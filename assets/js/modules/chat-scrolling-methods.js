
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
      
    }

    // метод для зчитуванія позиції активної зони юзера перед його виходом з блока
    getScrollPos() {
        // тут ми скролом зчитуємо позицію і передаємо її у локальноє храниліще браузера
        this.chatBlock.addEventListener("scroll", () => {
             this.storagedScrollPos = this.chatBlock.scrollTop;
             localStorage.setItem("chatScrollPos", this.storagedScrollPos)
             console.log(this.storagedScrollPos)
            
        })

        console.log(this.storagedScrollPos)
    }

    // метод на перенос нас на сохраньонну позицію при откритії чата 
    setScrollPos() {
        // тут ми провіряємо условія шо кіть у нас записано у локальноє храніліще дашо шо связано з нашим флагом "chatScrollPos" та товди
        // подставити то значенія замість нашого актуалного СКРОЛЛ ТОП = перенести нас на нужні координати
        if (this.getSevedScrollTop) {
            this.chatBlock.scrollTop = this.getSevedScrollTop;
        }
    }

}


export default ChatSrollMeth;