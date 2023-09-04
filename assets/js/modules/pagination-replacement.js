'use strict'
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

  export default paginationReplacement;