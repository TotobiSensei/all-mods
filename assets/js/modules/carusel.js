import { SelectorReferenceError, MissingElementError, ErrorReader} from "./services/error-liblrary";

function carusel(elemSelector) {
  if (!elemSelector) throw new SelectorReferenceError("Невірно вказаний, або відсутній селектор классу Каруселі");

  let elem = document.querySelector(elemSelector);
  
  try {
    if (!elem) throw new MissingElementError(`Результат оброблення елемента - ${elem}`);

    const flkty = new Flickity(elem, {
      cellAlign: 'center',
      contain: true,
      wrapAround: true // Включаем бесконечную прокрутку
  });

  if (!flkty) new MissingElementError(`Результат оброблення елемента - ${flkty}`);
  
  } catch (err) {
    if (err instanceof MissingElementError ) {
      console.error(new  ErrorReader("Відсутній елемент: " + err) );
  } else if (err instanceof SelectorReferenceError ) {
    console.error(new  ErrorReader("Помилка посилання: " + err));
  } else {
    throw new Error("Невідома  помилка " + err.stack)
  }
 
}

      
   
}

export default carusel;


