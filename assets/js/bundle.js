/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/js/modules/open-BTN.js":
/*!***************************************!*\
  !*** ./assets/js/modules/open-BTN.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });



function openBtn(btnSelector, container, hiddenBlockSelector) {
    try {
        const btn = document.querySelector(btnSelector),
              hiddenBlock = document.querySelector(hiddenBlockSelector),
              handlerBlock = document.querySelector(container)

     btn.addEventListener('click', () => {
        handlerBlock.classList.toggle('top-themes-show')
        
        if (handlerBlock.classList.contains('top-themes-show')) {
            hiddenBlock.classList.remove('hiden')

            btn.textContent = 'Close Top Themes'
        } else {
            hiddenBlock.classList.add('hiden')
            btn.textContent = 'Open Top Themes'
        }
    })
    } catch {
       new Error('ss') 
    }
    
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (openBtn);

/***/ }),

/***/ "./assets/js/modules/pagination-replace.js":
/*!*************************************************!*\
  !*** ./assets/js/modules/pagination-replace.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });



// Це функція яка створює секцію після мейна та переміщає туди пагінацію, вона в самому початку файлу бо шось матюкаєся джс на перші дві строки після визова функції
function paginationReplacement() {
    try {
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
    } catch {
      new Error('JJ')
      }
       
  }

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (paginationReplacement);
  


/***/ }),

/***/ "./assets/js/modules/user-img.js":
/*!***************************************!*\
  !*** ./assets/js/modules/user-img.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });


function userImg() {
  
try {
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
} catch {
  new Error('JJSD')
}
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (userImg);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***************************!*\
  !*** ./assets/js/main.js ***!
  \***************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_open_BTN__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/open-BTN */ "./assets/js/modules/open-BTN.js");
/* harmony import */ var _modules_pagination_replace__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/pagination-replace */ "./assets/js/modules/pagination-replace.js");
/* harmony import */ var _modules_user_img__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/user-img */ "./assets/js/modules/user-img.js");




window.addEventListener('DOMContentLoaded', () => {
    var elem = document.querySelector('.main-carousel');
    var flkty = new Flickity(elem, {
      cellAlign: 'center',
      contain: true,
      wrapAround: true // Включаем бесконечную прокрутку
    });

    (0,_modules_pagination_replace__WEBPACK_IMPORTED_MODULE_1__["default"])()
    ;(0,_modules_user_img__WEBPACK_IMPORTED_MODULE_2__["default"])()


    document.querySelector('.top-themes').classList.add('hiden')
    ;(0,_modules_open_BTN__WEBPACK_IMPORTED_MODULE_0__["default"])('.show-top_themes_btn', '.show-top_themes_btn-block', '.top-themes')
})
})();

/******/ })()
;
//# sourceMappingURL=bundle.js.map