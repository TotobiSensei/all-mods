function carusel() {
    //ІНІЦІАЛІЗАЦІЯ КАРУСЕЛІ НА ГЛАВНІЙ!
  try {
    var elem = document.querySelector('.main-carousel');
    var flkty = new Flickity(elem, {
      cellAlign: 'center',
      contain: true,
      wrapAround: true // Включаем бесконечную прокрутку
  });
  } catch {

  }   
}

export default carusel;


