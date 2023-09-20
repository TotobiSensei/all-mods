import { SelectorReferenceError, SyntaxError, ErrorReader} from "./services/error-liblrary";
function userIMg(data) {
 
  try {
    const {imagePrevSlc, cropBtnSlc,userIdSlc, imageInputSlc, userImageSlc, addImgSlc, toDataUrlSlc,cropImgSlc, ImgInputSlc, loadImgSlc} = data;
    for (let prop in data) {
      if (!data[prop]) {
        throw new SelectorReferenceError(`Селектор ${prop} переданий некоректно`)
      } 

      if ( typeof(data[prop]) !== 'string') {
        throw new SyntaxError(`Не вірно вказаний тип аргумента ${prop}. Oчікується передача String!`)
      }
    }

    let imagePreview = document.getElementById(imagePrevSlc),
         cropButton = document.getElementById(cropBtnSlc);
    
    if (imagePreview && cropButton) {
      imagePreview.style.display = 'none';
      cropButton.style.display = 'none';
    }
    
    let userIdInput = document.getElementById(userIdSlc);
    if(userIdInput)
    {
      let userId = userIdInput.value;
    }
    
    
    document.getElementById(imageInputSlc).addEventListener('change', function(event) {
      let file = event.target.files[0],
          reader = new FileReader();
    
      reader.onload = function(e) {
        // Показываем нужные элементы
        document.getElementById(imagePrevSlc).style.display = 'block';
        document.getElementById(cropBtnSlc).style.display = 'block';
    
        document.getElementById(userImageSlc).style.display = 'none';
        document.getElementById(addImgSlc).style.display = 'none';
        // Установка изображения в Cropper.js
        cropper.replace(e.target.result);
      };
    
      reader.readAsDataURL(file);
    });
    
    // Остальной код остается без изменений
    let image = document.getElementById(imagePrevSlc);
    let cropper = new Cropper(image, {
      aspectRatio: 1,
      crop: function(event) {
        // Обработчик события обрезки изображения
      },
      zoomable: false
    });
    
    document.getElementById(cropBtnSlc).addEventListener('click', function() {
      let croppedCanvas = cropper.getCroppedCanvas(),
          roundedCanvas = document.createElement('canvas'),
          roundedContext = roundedCanvas.getContext('2d'),
           radius = croppedCanvas.width / 2;
      roundedCanvas.width = croppedCanvas.width;
      roundedCanvas.height = croppedCanvas.height;
      roundedContext.clearRect(0, 0, roundedCanvas.width, roundedCanvas.height);
      roundedContext.beginPath();
      roundedContext.arc(radius, radius, radius, 0, 2 * Math.PI);
      roundedContext.closePath();
      roundedContext.clip();
      roundedContext.drawImage(croppedCanvas, 0, 0, croppedCanvas.width, croppedCanvas.height);
      let croppedImageURL = roundedCanvas.toDataURL(toDataUrlSlc),
           croppedImageInput = document.getElementById(cropImgSlc);
          croppedImageInput.value = croppedImageURL;
      let fileInput = document.getElementById(ImgInputSlc);
      fileInput.value = null;
    
      // Скрываем блоки с обрезанным изображением
      // document.querySelector('.cropper-container').style.display = 'none';
      // document.getElementById('crop-button').style.display = 'none';
    
      // Отправляем форму
      let form = document.getElementById(loadImgSlc);
      form.submit();
    });
    
  } catch (err) {
    if (err instanceof SelectorReferenceError) {
      console.error(new ErrorReader("Початкова помилка: " + err.stack))
    }

    if (err instanceof SyntaxError) {
      console.error(new ErrorReader("Початкова помилка: " + err.stack))
    }
  }
}

export default  userIMg;

