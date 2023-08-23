'use strict'
// // Це функція яка створює секцію після мейна та переміщає туди пагінацію, вона в самому початку файлу бо шось матюкаєся джс на перші дві строки після визова функції
// function paginationReplacement() {
//   // Тут я звертаюся до потірбних мені блоків
//   const section = document.createElement('section'),
//         main = document.querySelector('main'),
//         paginationWrap = document.querySelector('.pagination-wrap'),  
//         // Тут тіпа кажеся шо мож сразу чек прописувати у іф, но тоді воно починає матюкатися на іф і мені прийшлося створювати ще одну змінну
//         check = main.querySelector('.pagination-wrap') 
      
//   //Перевірка -- якщо пагінація є в блоку мейн, тоді створити секцію і закинути в неї пагінацію .
//   if (check) {
//     main.insertAdjacentElement('afterend', section);
//     section.insertAdjacentElement('afterbegin', paginationWrap);
//   }
  
// }

// paginationReplacement()

// var elem = document.querySelector('.main-carousel');
//       var flkty = new Flickity(elem, {
//         cellAlign: 'center',
//         contain: true,
//         wrapAround: true // Включаем бесконечную прокрутку
//       });




window.addEventListener('DOMContentLoaded', () => {

  const btnBlock = document.querySelectorAll('.add-block__btn-constructor');

btnBlock.forEach(elem => {
 
 
  elem.addEventListener('click', (e) => {
    const createForm = document.querySelector('.submit');

    constructorBtns ( `${e.target.classList[0]}`, createForm)
  })
})

function constructorBtns (btnClass, destObj) {
    if (btnClass == `add-block__new-preview`) {
        let newPreview = document.createElement('input');

        newPreview.setAttribute('id', `previewImg`);
        newPreview.setAttribute('type', `file`);

        destObj.insertAdjacentElement('beforebegin', newPreview);

        
    } else if (btnClass == 'add-block__new-news_title') {
        let newTitle = document.createElement('input');
        
        newTitle.setAttribute('id', 'news-title');
        newTitle.setAttribute('type', `text`);

        destObj.insertAdjacentElement('beforebegin', newTitle)
    } else if (btnClass == 'add-block__new_news_content') {
        let newContent = document.createElement('textarea');
        
        newContent.setAttribute('id', `news-content`);
        newContent.setAttribute('name', `news-Content`);
        newContent.setAttribute('cols', 30);
        newContent.setAttribute('rows', 10);

        destObj.insertAdjacentElement('beforebegin', newContent)
    }
}

})



  

