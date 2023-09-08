
// Функция, которая отправляет AJAX-запрос для обновления статуса сообщения
function updateMessageStatus(messageId) {
    const xhr = new XMLHttpRequest();
    const currentUrl = window.location.href;

    xhr.open("POST", currentUrl, true); // Замените на URL вашего серверного скрипта
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = xhr.responseText;
            if (xhr.status === 200) {
                // Если запрос успешен, изменяем класс на "checked"
                console.log("ok")
                const message = document.getElementById(messageId);
                if (message) {
                    const span = message.querySelector(".unchecked");
                    if (span) {
                        span.classList.remove("unchecked");
                        span.classList.add("checked");
                    }
                }
            }
            else
            {
                console.log("Response from server:", response);
            }
        }
    };
    xhr.send("messageId=" + messageId);
}

// Функция, которая проверяет видимые сообщения и отправляет AJAX-запросы при скроллинге
function checkVisibleMessages() {
    const messageList = document.getElementById("message-list");
    if (!messageList) return; // Проверка на наличие списка сообщений

    const otherMessages = messageList.querySelectorAll(".other-message");

    otherMessages.forEach(function(otherMessage) {
        const message = otherMessage.querySelector(".unchecked");
        if (!message) return; // Пропускаем, если нет span с классом "unchecked"
        
        const messageId = otherMessage.id;
        const rect = otherMessage.getBoundingClientRect();
        

        if (rect.top >= 0 && rect.bottom <= (messageList.clientHeight + messageList.getBoundingClientRect().top)) {
            // Если сообщение видимо в области, отправляем AJAX-запрос
            updateMessageStatus(messageId);
            console.log("Checking message with messageId:", messageId);
        }
    });
}


export default checkVisibleMessages;