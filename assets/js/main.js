import openBtn from './modules/open-BTN';
import paginationReplacement from './modules/pagination-replace';
import userImg from './modules/user-img';

window.addEventListener('DOMContentLoaded', () => {
    var elem = document.querySelector('.main-carousel');
    var flkty = new Flickity(elem, {
      cellAlign: 'center',
      contain: true,
      wrapAround: true // Включаем бесконечную прокрутку
    });

    paginationReplacement()
    userImg()


    document.querySelector('.top-themes').classList.add('hiden')
    openBtn('.show-top_themes_btn', '.show-top_themes_btn-block', '.top-themes')
})