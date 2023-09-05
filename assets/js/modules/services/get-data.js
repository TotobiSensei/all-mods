'use strict' 

async function getData(url) {
        const action = await fetch(url)
                .then((response) => {
            return response.json()
        })

        return action;

   
}

export default getData;