 import postData from "./services/post-data";
 
 function keyModyfier(form) {
    const formBlock = document.querySelector(form);
    formBlock.addEventListener("keydown", (e) => {
        if (e.code === "Enter") {

                    formBlock.submit();
        }
    })
 }

export default keyModyfier;