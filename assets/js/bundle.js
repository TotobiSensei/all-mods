/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/js/modules/check-message.js":
/*!********************************************!*\
  !*** ./assets/js/modules/check-message.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   checkMessageStatusInActionExpo: () => (/* binding */ checkMessageStatusInActionExpo),
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _services_post_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./services/post-data */ "./assets/js/modules/services/post-data.js");


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
                
                (0,_services_post_data__WEBPACK_IMPORTED_MODULE_0__["default"])(currentUrl,formData)
                .then((responseData) => {
                    // Обработка данных, полученных от сервера
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
        if ( containerElementRec.top >= blockRec.top && containerElementRec.bottom <= blockRec.bottom) {
            // тут ми вказуємо шо нас цікавить тільки озер месаге
            if (elem.classList.contains("other-message")) {
                // перевірка на класс 
                if (isUnchecked  !== null ) {
    
                    const formData = new FormData();
                    formData.append("messageId", elem.id);
                    const currentUrl = window.location.href;
                    
                    (0,_services_post_data__WEBPACK_IMPORTED_MODULE_0__["default"])(currentUrl,formData)
                    .then((responseData) => {
                        // Обработка данных, полученных от сервера
                        responseData.ok ? isUnchecked.innerHTML = 1 : isUnchecked.innerHTML = 0;
                        console.log('Успешный ответ:', responseData);
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


const  checkMessageStatusInActionExpo = checkMessageStatusInAction;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (checkMessageStatus);


/***/ }),

/***/ "./assets/js/modules/message-action.js":
/*!*********************************************!*\
  !*** ./assets/js/modules/message-action.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _check_message__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./check-message */ "./assets/js/modules/check-message.js");



function messageAction(perentBlock) {
    const container = document.querySelector(perentBlock);
    const containerRec = container.getBoundingClientRect();
    const containerElem = Array.from(container.children);
    const currentUrl = window.location.href;
    // функція яка провіряє статус смс при прогрузці
    (0,_check_message__WEBPACK_IMPORTED_MODULE_0__["default"])(containerElem, containerRec)
    // функція яка провіря статус смс при скролі
    ;(0,_check_message__WEBPACK_IMPORTED_MODULE_0__.checkMessageStatusInActionExpo)(container, containerElem, containerRec)

//   фильтр на сообщение собеседника ЗАДАЧА 3
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (messageAction);

/***/ }),

/***/ "./assets/js/modules/modal-action.js":
/*!*******************************************!*\
  !*** ./assets/js/modules/modal-action.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });


function modalAction() {
    try {
        var elem = document.querySelector('.main-carousel');
        var flkty = new Flickity(elem, {
          cellAlign: 'center',
          contain: true,
          wrapAround: true // Включаем бесконечную прокрутку
        });
  
        //report popup
        
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
    } catch {

    }
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (modalAction);

/***/ }),

/***/ "./assets/js/modules/pagination-replacement.js":
/*!*****************************************************!*\
  !*** ./assets/js/modules/pagination-replacement.js ***!
  \*****************************************************/
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

    }
  }

  /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (paginationReplacement);

/***/ }),

/***/ "./assets/js/modules/services/post-data.js":
/*!*************************************************!*\
  !*** ./assets/js/modules/services/post-data.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
    
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



    /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (postData);

/***/ }),

/***/ "./assets/js/modules/user_img.js":
/*!***************************************!*\
  !*** ./assets/js/modules/user_img.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });


function userIMg() {
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

  }
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (userIMg);



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
/*!*************************************!*\
  !*** ./assets/js/modul-colector.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_modal_action__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/modal-action */ "./assets/js/modules/modal-action.js");
/* harmony import */ var _modules_user_img__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/user_img */ "./assets/js/modules/user_img.js");
/* harmony import */ var _modules_pagination_replacement__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/pagination-replacement */ "./assets/js/modules/pagination-replacement.js");
/* harmony import */ var _modules_message_action__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/message-action */ "./assets/js/modules/message-action.js");





window.addEventListener('DOMContentLoaded', () => {
    (0,_modules_modal_action__WEBPACK_IMPORTED_MODULE_0__["default"])();
    (0,_modules_user_img__WEBPACK_IMPORTED_MODULE_1__["default"])();
    (0,_modules_pagination_replacement__WEBPACK_IMPORTED_MODULE_2__["default"])();

    (0,_modules_message_action__WEBPACK_IMPORTED_MODULE_3__["default"])(".message-list");
})
})();

/******/ })()
;
//# sourceMappingURL=bundle.js.map