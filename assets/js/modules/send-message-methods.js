import { SelectorReferenceError } from "./services/error-liblrary";

 
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
    } catch {
        
    }
   
 }

export default keyModyfier;