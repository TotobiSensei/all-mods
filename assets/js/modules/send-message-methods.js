 
 function keyModyfier(form) {
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