
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


document.getElementById('image-preview').style.display = 'none';
document.getElementById('crop-button').style.display = 'none';

var userIdInput = document.getElementById('userId');
var userId = userIdInput.value;
console.log(userId);

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