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
        if (elementRec.top >= containerRec.top && elementRec.bottom <= containerRec.bottom) {
           const data = new FormData()
            data.append("messageId", element.id)
            
            

           await postData("http://allmods/view/messages.php", data)
           .then(data => {
            // Обработка данных, полученных от сервера
            console.log('Успешный ответ:', data);
        })
        .catch(error => {
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
