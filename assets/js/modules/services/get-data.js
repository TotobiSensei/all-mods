'use strict' 

async function getData(url) {
        const action = await fetch(url);
        return action;
}

export default getData;