'use strict'

    
async function postData(url= "", data = {}) {
    const response = await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: data
    })
    .then(response => {
        if (!response.ok) {
            // Обработка ошибки, если статус ответа не в диапазоне 200-299
            throw new Error('Network response was not ok');
        }
       
    })
}



    export default postData;