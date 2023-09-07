    
async function postData(url = "", data) {
 await fetch(url, {
        method: "POST",
        body: data
    })
}



    export default postData;