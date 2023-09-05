import postData from "./services/post-data";
// import getData from "./services/get-data";

'use strict'

function checkMessageStatus(perentBlock) {
  const container = document.querySelector(perentBlock);
  
  const containerRec = container.getBoundingClientRect();

  container.addEventListener('scroll',  async (e) => {

    const containerElem = container.children;
 

    for (let i = 0; i < containerElem.length; i++) {
        const element = containerElem[i];
        const elementRec = element.getBoundingClientRect();
        if (elementRec.top >= containerRec.top && elementRec.bottom <= containerRec.bottom) {Ц
            
            const currentUrl = window.location.href;
            const formData = new FormData();
            formData.append("messageId", element.id); // Замените на нужное значение
            
            fetch(currentUrl, {
                method: "POST",
                body: formData,
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then((responseData) => {
                // Обработка данных, полученных от сервера
                console.log('Успешный ответ:', responseData);
            })
            .catch((error) => {
                // Обработка ошибки Fetch или обработки ответа
                console.error('There was a problem with the fetch operation:', error);
            });

            
        }
          
    }
});


    // const containerElemRec = element.getBoundingClientRect();

    // if (containerElemRec.top >= containerRec.top && containerElemRec.bottom <= containerRec.bottom) {
    //     console.log('Ne govno')
    // } else {
    //     console.log('govno')
    // }



    

    
}

export default checkMessageStatus;
