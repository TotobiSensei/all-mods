/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/js/modules/Up-date-messages.js":
/*!***********************************************!*\
  !*** ./assets/js/modules/Up-date-messages.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });

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


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (checkVisibleMessages);

/***/ }),

/***/ "./assets/js/modules/carusel.js":
/*!**************************************!*\
  !*** ./assets/js/modules/carusel.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./services/error-liblrary */ "./assets/js/modules/services/error-liblrary.js");


function carusel(elemSelector) {
  if (!elemSelector) throw new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.SelectorReferenceError("Невірно вказаний, або відсутній селектор классу Каруселі");

  let elem = document.querySelector(elemSelector);
  
  try {
    if (!elem) throw new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.MissingElementError(`Результат оброблення елемента - ${elem}`);

    const flkty = new Flickity(elem, {
      cellAlign: 'center',
      contain: true,
      wrapAround: true // Включаем бесконечную прокрутку
  });

  if (!flkty) new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.MissingElementError(`Результат оброблення елемента - ${flkty}`);
  
  } catch (err) {
    if (err instanceof _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.MissingElementError ) {
      console.error(new  _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.ErrorReader("Відсутній елемент: " + err) );
  } else if (err instanceof _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.SelectorReferenceError ) {
    console.error(new  _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.ErrorReader("Помилка посилання: " + err));
  } else {
    throw new Error("Невідома  помилка " + err.stack)
  }
 
}

      
   
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (carusel);




/***/ }),

/***/ "./assets/js/modules/chat-action.js":
/*!******************************************!*\
  !*** ./assets/js/modules/chat-action.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _chat_methods__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./chat-methods */ "./assets/js/modules/chat-methods.js");
/* harmony import */ var _services_error_liblrary__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./services/error-liblrary */ "./assets/js/modules/services/error-liblrary.js");



function chatObserv(chatContainer, textAreaContainer, jumpBtnSelector ) {
      try {
            if (chatContainer !== ".message-list") {
                  throw new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_1__.SelectorReferenceError(`Відсутній селектор контейнера чату`);
        } else if (textAreaContainer !== "#textarea") {
                  throw new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_1__.SelectorReferenceError(`Відсутній селектор елемента форми Textarea`);
        }
  
          const scrollOobserver = new _chat_methods__WEBPACK_IMPORTED_MODULE_0__.ChatSrollMeth(chatContainer, jumpBtnSelector),
                jumpObserber = new _chat_methods__WEBPACK_IMPORTED_MODULE_0__.ChatJumpMEth(chatContainer,jumpBtnSelector),
                textAreaObserver = new _chat_methods__WEBPACK_IMPORTED_MODULE_0__.ChatTextAreaMeth(textAreaContainer),
                chatObserv = new _chat_methods__WEBPACK_IMPORTED_MODULE_0__.ChatFocusOn(textAreaContainer, chatContainer);
                
  
          scrollOobserver.getScrollPos();
          scrollOobserver.setScrollPos();
          scrollOobserver.showJumpToMessageBtn();
          scrollOobserver.hideJumpToMessageBtn();
        
          jumpObserber.JumpTo();
      
          textAreaObserver.textAreaIncrisHeight();
  
          chatObserv.pemanentFocusOn();

      } catch (err) {
            if (err instanceof SyntaxError) {
                 console.error(new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_1__.ErrorReader("Помилка виконання " + err));
            } else if (err instanceof TypeError) {
                  console.error( new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_1__.ErrorReader("Помилка використання " + err.stack));
            } else if (err instanceof ReferenceError) {
                  console.error(new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_1__.ErrorReader("Помилка використання " + err.stack));
            } else {
                  throw new Error("Невідома  помилка " + err.stack)
            }
      }
      
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (chatObserv);

/***/ }),

/***/ "./assets/js/modules/chat-methods.js":
/*!*******************************************!*\
  !*** ./assets/js/modules/chat-methods.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ChatFocusOn: () => (/* binding */ ChatFocusOn),
/* harmony export */   ChatJumpMEth: () => (/* binding */ ChatJumpMEth),
/* harmony export */   ChatSrollMeth: () => (/* binding */ ChatSrollMeth),
/* harmony export */   ChatTextAreaMeth: () => (/* binding */ ChatTextAreaMeth)
/* harmony export */ });
/* harmony import */ var _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./services/error-liblrary */ "./assets/js/modules/services/error-liblrary.js");

// Класс в якому я задав два метода для запоминанія позиції і її вивода
// Я використав клас тому шо так намного проще передавати переменні внутрі двох функцій
// В клас ми передаємо аргумент ( наш блок з смсками)
class ChatSrollMeth {
    constructor(chatContainer, jumpBtnSelector) {
        this.__noSuchMethod__ = function(name) {
            throw new TypeError(`Метода в класі ${name} не існує`)
        };  
        this.chatContainer = chatContainer;
    // перемєнна яка хранить начальну скрольну позицію
        this.storagedScrollPos = 0;
        this.chatBlock = document.querySelector(this.chatContainer);

        // переменна у яку ми визиваєме дані про позицію з локального храниліща браузера
        this.getSevedScrollTop = localStorage.getItem("chatScrollPos");

        // jumpToMessage variables 
        this.scrollPercentage = 0;
        this.jumpBtn = document.querySelector(jumpBtnSelector);
   
    }

    // метод для зчитуванія позиції активної зони юзера перед його виходом з блока
    getScrollPos() {
        // тут ми скролом зчитуємо позицію і передаємо її у локальноє храниліще браузера
        this.chatBlock.addEventListener("scroll", () => {
             this.storagedScrollPos = this.chatBlock.scrollTop;
             localStorage.setItem("chatScrollPos", this.storagedScrollPos)
        })

        
    }

    // метод на перенос нас на сохраньонну позицію при откритії чата 
    setScrollPos() {
        // тут ми провіряємо условія шо кіть у нас записано у локальноє храніліще дашо шо связано з нашим флагом "chatScrollPos" та товди
        // подставити то значенія замість нашого актуалного СКРОЛЛ ТОП = перенести нас на нужні координати
        if (this.getSevedScrollTop) {
            this.chatBlock.scrollTop = this.getSevedScrollTop;
        }
    }

    // метод за допомогою якого ми виводимо кнопку джамп
    showJumpToMessageBtn() {
        const getPercentage = () => {
            // тут ми получаємо прогресс скролла нашої сторінки
            this.scrollPercentage = Math.round((this.chatBlock.scrollTop / (this.chatBlock.scrollHeight - this.chatBlock.clientHeight)) * 100); 
            // якщо умова спрацьовує ми виводимо кнопку 
            if (this.scrollPercentage <= 80) {
                this.jumpBtn.classList.remove("hiden")
            } 
        }

        // тут ми накладаємо оброблювач подій 
        this.chatBlock.addEventListener("scroll", getPercentage);
    }

 // метод за допомогою якого ми приховуємо  кнопку джамп
    hideJumpToMessageBtn() {
        const getPercentage = () => {
            // тут ми получаємо прогресс скролла нашої сторінки
            this.scrollPercentage = Math.round((this.chatBlock.scrollTop / (this.chatBlock.scrollHeight - this.chatBlock.clientHeight)) * 100); 
            // якщо умова спрацьовує ми ховаємо кнопку 
            if (this.scrollPercentage >= 90 ) {
                this.jumpBtn.classList.add("hiden")
            }
        }

        // тут ми накладаємо оброблювач подій 
        this.chatBlock.addEventListener("scroll", getPercentage);   
    }

}


class ChatJumpMEth extends ChatSrollMeth {
    constructor(chatContainer,jumpBtnSelector) {
        super(chatContainer, jumpBtnSelector);
        this.__noSuchMethod__ = function(name) {
            throw new TypeError(`Метода в класі ${name} не існує`)
        };  
        this.chatBlock = document.querySelector(this.chatContainer);
        this.otherMessages = document.querySelectorAll(".other-message");
        this.isUnchecked = false;
    }
    
    // метод який виконує дію стрибка
    JumpTo() {
        if (!this.jumpBtn) {
            throw new ReferenceError('Помилка посилання')
        }
        // знизу до першої перевірки умови ми отримуємо наші смс та прапорець який ми використаємо аби виконати першу умову

        this.otherMessages.forEach( otherMessage  => {
            this.message = otherMessage.querySelector(".unchecked");

            if (this.message) this.isUnchecked = true
    })

    // Якщо умова виконана тоді ми переносимося на непрочитану смск
    if (this.isUnchecked) {
        this.jumpBtn.addEventListener("click", () => {
           const message =  document.querySelector(".other-message .unchecked");

           if (message)  message.scrollIntoView({behavior: "smooth", block: "end", inline: "center"});
        });
        
    }  else {
    // Якщо умова не виконана тоді ми просто переносимося в кінець нашої сторінки
        this.jumpBtn.addEventListener("click", () => {
            this.chatBlock.scrollTop = this.chatBlock.scrollHeight;
        })
    }


    
    }   
}


class ChatTextAreaMeth {
    constructor(textareaSelector) {
        this.__noSuchMethod__ = function(name) {
            throw new TypeError(`Метода в класі ${name} не існує`)
        };  
        this.textAreablock = document.querySelector(textareaSelector);
        

    }


    textAreaIncrisHeight() {      
       
            this.textAreablock.addEventListener("input", (e) => {
                if(e.target.value.length > 175)  {
                    console.log('ff')
                    e.target.style.height = "auto"
                    e.target.style.height = (this.textAreablock.scrollHeight ) + "px" ;  
                }
                    
        })


        this.textAreablock.addEventListener("input", (e) => {
            // let contentLenght = e.target.value.length;
            if (e.target.value.length === 175)  e.target.style.height = 60 + "px";
                
             if (e.target.value === "") e.target.style.height = "";
        })

    }
}


class ChatFocusOn extends ChatTextAreaMeth {
    constructor(textareaSelector, chatContainer) {
        super(textareaSelector);
        this.__noSuchMethod__ = function(name) {
            throw new TypeError(`Метода в класі ${name} не існує`)
        };  
        this.textAreablock = document.querySelector(textareaSelector);
        this.chatBlock = document.querySelector(chatContainer);
    }

    pemanentFocusOn() {
        this.chatBlock.addEventListener("click", () => {
            this.textAreablock.focus()
        })
    }
}





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
/* harmony import */ var _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./services/error-liblrary */ "./assets/js/modules/services/error-liblrary.js");

// Це функція яка створює секцію після мейна та переміщає туди пагінацію, вона в самому початку файлу бо шось матюкаєся джс на перші дві строки після визова функції
function paginationReplacement() {
    try {
        // Тут я звертаюся до потірбних мені блоків
        const   section = document.createElement('section'),
                main = document.querySelector('main'),
                paginationWrap = document.querySelector('.pagination-wrap'),  
        // Тут тіпа кажеся шо мож сразу чек прописувати у іф, но тоді воно починає матюкатися на іф і мені прийшлося створювати ще одну змінну
                check = main.querySelector('.pagination-wrap');

        //Перевірка -- якщо пагінація є в блоку мейн, тоді створити секцію і закинути в неї пагінацію .
        if (check) {
            main.insertAdjacentElement('afterend', section);
            section.insertAdjacentElement('afterbegin', paginationWrap);
        }


        if (!section  || !main || !paginationWrap) {
            throw new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.SelectorReferenceError('Блоки DOM-Tree не знайдено. Неможливо виконати функцію переміщення пагінації')
          }
          
    } catch(e) {
        console.error(e.message)
      } 
  }

  /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (paginationReplacement);

/***/ }),

/***/ "./assets/js/modules/send-message-methods.js":
/*!***************************************************!*\
  !*** ./assets/js/modules/send-message-methods.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./services/error-liblrary */ "./assets/js/modules/services/error-liblrary.js");


 
 function keyModyfier(form) {
    if (form !== ".bottom form") {
        throw new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.SelectorReferenceError("Невірно вказаний селектор форми")
    }

    try {
        const formBlock = document.querySelector(form);
        formBlock.addEventListener("keydown", (e) => {
            if (e.code === "Enter") {
    
                        formBlock.submit();
            }
        })
    } catch (err) {
        if (err instanceof _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.SelectorReferenceError) {
            console.error(new _services_error_liblrary__WEBPACK_IMPORTED_MODULE_0__.ErrorReader("Початкова помилка: " + err.stack))
        } else {
            throw new Error(err.stack)
        }
    }
   
 }

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (keyModyfier);

/***/ }),

/***/ "./assets/js/modules/services/error-liblrary.js":
/*!******************************************************!*\
  !*** ./assets/js/modules/services/error-liblrary.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ErrorReader: () => (/* binding */ ErrorReader),
/* harmony export */   MissingElementError: () => (/* binding */ MissingElementError),
/* harmony export */   SelectorReferenceError: () => (/* binding */ SelectorReferenceError),
/* harmony export */   SyntaxError: () => (/* binding */ SyntaxError)
/* harmony export */ });
// Класс для читача помилок 
class ErrorReader extends Error {
    constructor(message,cause) {
        super(message);
        this.name = "ErrorReader";
        this.cause = cause;
    }
}

// Класс для помилок посилання
class ReferenceError extends Error {
    constructor(message) {
        super(message);
        this.name = this.constructor.name;
    }
}
//  Класс для помилок посилання на селектор
class SelectorReferenceError extends ReferenceError {
    constructor(message) {
        super(message);
    }
}



// Класс для помилок типу Null || Undefined

class MissingElementError extends Error {
    constructor(message) {
        super(message);
        this.name = this.constructor.name;
    }
}

// Класс для помилок невірного використання методів
class SyntaxError extends Error {
    constructor(message) {
        super(message);
        this.name = this.constructor.name;
    }
}




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
/* harmony import */ var _modules_carusel__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/carusel */ "./assets/js/modules/carusel.js");
/* harmony import */ var _modules_user_img__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/user_img */ "./assets/js/modules/user_img.js");
/* harmony import */ var _modules_pagination_replacement__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/pagination-replacement */ "./assets/js/modules/pagination-replacement.js");
/* harmony import */ var _modules_send_message_methods__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/send-message-methods */ "./assets/js/modules/send-message-methods.js");
/* harmony import */ var _modules_chat_action__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/chat-action */ "./assets/js/modules/chat-action.js");
/* harmony import */ var _modules_Up_date_messages__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modules/Up-date-messages */ "./assets/js/modules/Up-date-messages.js");
/* harmony import */ var _modules_modal_action__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./modules/modal-action */ "./assets/js/modules/modal-action.js");
/* harmony import */ var _modules_services_error_liblrary__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./modules/services/error-liblrary */ "./assets/js/modules/services/error-liblrary.js");









// Ініціалізація методів глобального обьекта
window.addEventListener("load", _modules_Up_date_messages__WEBPACK_IMPORTED_MODULE_5__["default"]);
window.addEventListener("DOMContentLoaded", (e) => {


    try {
        // Отправляем AJAX-запросы для видимых сообщений при загрузке страницы
        // Отправляем AJAX-запросы для видимых сообщений при скроллинге в области "message-list"
        document.getElementById("message-list").addEventListener("scroll", _modules_Up_date_messages__WEBPACK_IMPORTED_MODULE_5__["default"]);
    } catch (err) {

    }

    try {
        // Ініціалізація модулів
        (0,_modules_carusel__WEBPACK_IMPORTED_MODULE_0__["default"])(".main-carousel");
        (0,_modules_Up_date_messages__WEBPACK_IMPORTED_MODULE_5__["default"])();
        (0,_modules_user_img__WEBPACK_IMPORTED_MODULE_1__["default"])();
        (0,_modules_pagination_replacement__WEBPACK_IMPORTED_MODULE_2__["default"])();
        (0,_modules_send_message_methods__WEBPACK_IMPORTED_MODULE_3__["default"])(".bottom form");
        (0,_modules_chat_action__WEBPACK_IMPORTED_MODULE_4__["default"])(".message-list","#textarea", ".jump-btn");
        (0,_modules_modal_action__WEBPACK_IMPORTED_MODULE_6__["default"])();
        
    } finally {
        console.log("All methods works properly")
    }

})


})();

/******/ })()
;
//# sourceMappingURL=bundle.js.map