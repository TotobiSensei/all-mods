try
{
    // Це функція яка створює секцію після мейна та переміщає туди пагінацію, вона в самому початку файлу бо шось матюкаєся джс на перші дві строки після визова функції
  function paginationReplacement() {
    // Тут я звертаюся до потірбних мені блоків
    const section = document.createElement('section'),
          main = document.querySelector('main'),
          paginationWrap = document.querySelector('.pagination-wrap'),  
          // Тут тіпа кажеся шо мож сразу чек прописувати у іф, но тоді воно починає матюкатися на іф і мені прийшлося створювати ще одну змінну
          check = main.querySelector('.pagination-wrap') 
        
    //Перевірка -- якщо пагінація є в блоку мейн, тоді створити секцію і закинути в неї пагінацію .
    if (check) {
      main.insertAdjacentElement('afterend', section);
      section.insertAdjacentElement('afterbegin', paginationWrap);
    }
    
}

paginationReplacement()
}
catch (error)
{
  
}

try {
  var elem = document.querySelector('.main-carousel');
    var flkty = new Flickity(elem, {
      cellAlign: 'center',
      contain: true,
      wrapAround: true // Включаем бесконечную прокрутку
    });

} catch (error) {
  if (window.location.pathname !== '/page1.html') {
    throw error;
  }
}
// const messageList = document.getElementById('message-list');

//     messageList.addEventListener('scroll', () => {
//         const visibleMessageIds = getVisibleMessageIds();
//         visibleMessageIds.forEach((messageId) => {
//             changeMessageStatus(messageId);
//         });
//     });

//     function getVisibleMessageIds() {
//         const visibleMessageIds = [];
//         const messages = messageList.children;

//         for (let i = 0; i < messages.length; i++) {
//             const message = messages[i];
//             if (isMessageVisible(message)) {
//                 const messageId = message.id;
//                 visibleMessageIds.push(messageId);
//             }
//         }

//         return visibleMessageIds;
//     }

//     function isMessageVisible(message) {
//         const rect = message.getBoundingClientRect();
//         return rect.top >= 0 && rect.bottom <= messageList.clientHeight;
//     }

//   function changeMessageStatus(messageId)
//   {
//     const xhr = new XMLHttpRequest();

//     const currentUrl = window.location.href;

//     xhr.open("POST", currentUrl, true);

//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

//     const data = new FormData();

//     data.append("messageId", messageId);

//     xhr.onreadystatechange = function ()
//     {
//        if (xhr.readyState === 4 && xhr.status === 200)
//        {
//           console.log("good");

//           window.location.reload();
//        }
//        else
//        {
//           console.log("erro");
//        }
//     }

//     xhr.send(data);
//   }
try
{

}
catch (error)
{
  
}
try
{
  
}
catch (error)
{
  
}
try
{
    var imagePreview = document.getElementById('image-preview');
    var cropButton = document.getElementById('crop-button');
    
    if (imagePreview && cropButton) {
      imagePreview.style.display = 'none';
      cropButton.style.display = 'none';
    }
    
    var userIdInput = document.getElementById('userId');
    if(userIdInput)
    {
      var userId = userIdInput.value;
    }
    
    
    document.getElementById('image-input').addEventListener('change', function(event) {
      var file = event.target.files[0];
      var reader = new FileReader();
    
      reader.onload = function(e) {
        // Показываем нужные элементы
        document.getElementById('image-preview').style.display = 'block';
        document.getElementById('crop-button').style.display = 'block';
    
        document.getElementById('user-image').style.display = 'none';
        document.getElementById('add-img').style.display = 'none';
        // Установка изображения в Cropper.js
        cropper.replace(e.target.result);
      };
    
      reader.readAsDataURL(file);
    });
    
    // Остальной код остается без изменений
    var image = document.getElementById('image-preview');
    var cropper = new Cropper(image, {
      aspectRatio: 1,
      crop: function(event) {
        // Обработчик события обрезки изображения
      },
      zoomable: false
    });
    
    document.getElementById('crop-button').addEventListener('click', function() {
      var croppedCanvas = cropper.getCroppedCanvas();
      var roundedCanvas = document.createElement('canvas');
      var roundedContext = roundedCanvas.getContext('2d');
      var radius = croppedCanvas.width / 2;
      roundedCanvas.width = croppedCanvas.width;
      roundedCanvas.height = croppedCanvas.height;
      roundedContext.clearRect(0, 0, roundedCanvas.width, roundedCanvas.height);
      roundedContext.beginPath();
      roundedContext.arc(radius, radius, radius, 0, 2 * Math.PI);
      roundedContext.closePath();
      roundedContext.clip();
      roundedContext.drawImage(croppedCanvas, 0, 0, croppedCanvas.width, croppedCanvas.height);
      var croppedImageURL = roundedCanvas.toDataURL('image/png');
      var croppedImageInput = document.getElementById('cropped-image');
      croppedImageInput.value = croppedImageURL;
      var fileInput = document.getElementById('image-input');
      fileInput.value = null;
    
      // Скрываем блоки с обрезанным изображением
      // document.querySelector('.cropper-container').style.display = 'none';
      // document.getElementById('crop-button').style.display = 'none';
    
      // Отправляем форму
      var form = document.getElementById('load-img');
      form.submit();
    });
  }
catch (error)
{
  
}
try
{
  // Функция для открытия модального окна
  function openModal(targetId) {
    const modal = document.getElementById(targetId);
    if (modal) {
      modal.style.display = "block";
    }
  }

  // Функция для закрытия модального окна
  function closeModal(targetId) {
    const modal = document.getElementById(targetId);
    if (modal) {
      modal.style.display = "none";
    }
  }

  // Привязываем открытие и закрытие к соответствующим элементам
  const openModalBtns = document.querySelectorAll(".report-button");
  const closeBtns = document.querySelectorAll(".close-btn");

  openModalBtns.forEach(function (openModalBtn) {
    openModalBtn.addEventListener("click", function () {
      const targetId = openModalBtn.getAttribute("data-target");
      openModal(targetId);
    });
  });

  closeBtns.forEach(function (closeBtn) {
    closeBtn.addEventListener("click", function () {
      const targetId = closeBtn.getAttribute("data-target");
      closeModal(targetId);
    });
  });

  // Предотвращение взаимодействия пользователя с контентом за пределами окна
  const modals = document.querySelectorAll(".popup-block");
  modals.forEach(function (modal) {
    modal.addEventListener("click", function (event) {
      if (event.target === modal) {
        const targetId = modal.getAttribute("id");
        closeModal(targetId);
      }
    });
  });
  //
  document.getElementById("sendMessage")
    .addEventListener('keyup', function(e)
    {
      if (e.code === "Enter")
      {
        e.preventDefault();
        document.querySelector("form").submit();
      }
    });
}
catch (error)
{

}


