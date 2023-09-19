import { SelectorReferenceError, ErrorReader} from "./services/error-liblrary";

 
 function keyModyfier(form) {
    if (form !== ".bottom form") {
        throw new SelectorReferenceError("Невірно вказаний селектор форми")
    }

    try {
        const formBlock = document.querySelector(form);
        formBlock.addEventListener("keydown", (e) => {
            if (e.code === "Enter") {
    
                        formBlock.submit();
            }
        })
    } catch (err) {
        if (err instanceof SelectorReferenceError) {
            console.error(new ErrorReader("Початкова помилка: " + err.stack))
        } else {
            throw new Error(err.stack)
        }
    }
   
 }

export default keyModyfier;