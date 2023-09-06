    
async function postData(url = "", data = {}) {
 await fetch(url, {
        method: "POST",
        body: data
    })
    .then(response => {
        if (!response.ok) {
            // Обработка ошибки, если статус ответа не в диапазоне 200-299
            throw new Error('Network response was not ok');
        }

        return response.text()
    })
}



    export default postData;