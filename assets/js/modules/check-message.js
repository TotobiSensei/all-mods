import postData from "./services/post-data";

function checkMessageStatus(blockElem, blockRec) {

    blockElem.forEach(elem => {
    const containerElementRec = elem.getBoundingClientRect();
    const isUnchecked = elem.querySelector(".uncheced") !== null;

    // перевірка класа анчек при загрузці (до собитія)
    if ( containerElementRec.top >= blockRec.top && containerElementRec.bottom <= blockRec.bottom) {
        // тут ми вказуємо шо нас цікавить тільки озер месаге
        if (elem.classList.contains("other-message")) {
            // перевірка на класс 
            if (isUnchecked) {

                const formData = new FormData();
                formData.append("messageId", elem.id);
                const currentUrl = window.location.href;
                
                postData(currentUrl,formData)
                .then(response => {
                    if (!response.ok) {
                        // Обработка ошибки, если статус ответа не в диапазоне 200-299
                        throw new Error('Network response was not ok');
                    }
            
                    response.ok ? isUnchecked.innerHTML = 1 : isUnchecked.innerHTML = 0;
    
                    return   response.text();
                })
                .catch((error) => {
                    // Обработка ошибки Fetch или обработки ответа
                    console.error('There was a problem with the fetch operation:', error);
                });
    
            } else {
                console.log("Повідомлення перевірено")
            }
        }
    }

  })

  
}


function checkMessageStatusInAction(block, blockElem, blockRec) {
    block.addEventListener('scroll', () => {
    blockElem.forEach(elem => {
        const containerElementRec = elem.getBoundingClientRect();
        const isUnchecked = elem.querySelector(".uncheced");
      
        // перевірка класа анчек при загрузці (до собитія)
        if ( containerElementRec.top >= blockRec.top + (block.offsetHeight - blockRec.top) && containerElementRec.bottom <= blockRec.bottom) {
            // тут ми вказуємо шо нас цікавить тільки озер месаге
            if (elem.classList.contains("other-message")) {
                // перевірка на класс 
                if (isUnchecked  !== null ) {
                    const formData = new FormData();
                    formData.append("messageId", elem.id);
                    const currentUrl = window.location.href;
                
                    
                    postData(currentUrl,formData) 
                    .then(response => {
                        if (!response.ok) {
                            // Обработка ошибки, если статус ответа не в диапазоне 200-299
                            throw new Error('Network response was not ok');
                        }
                        // ця перевірка не працює тому що немає відповіді зі сторони сервера === мій респонс андефайнд
                        response.ok ? isUnchecked.innerHTML = 1 : isUnchecked.innerHTML = 0;
        
                        return   response.text();
                    })
                    .catch((error) => {
                        // Обработка ошибки Fetch или обработки ответа
                        console.error('There was a problem with the fetch operation:', error);
                    });
        
                } else {
                    console.log("Повідомлення перевірено")
                }
            }
        }
    
      })
    })
}


export const  checkMessageStatusInActionExpo = checkMessageStatusInAction;
export default checkMessageStatus;
