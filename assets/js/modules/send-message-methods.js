 import postData from "./services/post-data";
 
 function keyModyfier(form) {
    const formBlock = document.querySelector(form);
    console.log(formBlock);
    formBlock.addEventListener("keydown", (e) => {
        if (e.code === "Enter") {

                    formBlock.submit();
        }
    })
 }

export default keyModyfier;