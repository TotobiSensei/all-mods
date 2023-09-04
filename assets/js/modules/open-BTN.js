'use strict'


function openBtn(btnSelector, container, hiddenBlockSelector) {
    try {
        const btn = document.querySelector(btnSelector),
              hiddenBlock = document.querySelector(hiddenBlockSelector),
              handlerBlock = document.querySelector(container)

     btn.addEventListener('click', () => {
        handlerBlock.classList.toggle('top-themes-show')
        
        if (handlerBlock.classList.contains('top-themes-show')) {
            hiddenBlock.classList.remove('hiden')

            btn.textContent = 'Close Top Themes'
        } else {
            hiddenBlock.classList.add('hiden')
            btn.textContent = 'Open Top Themes'
        }
    })
    } catch {
       new Error('ss') 
    }
    
}

export default openBtn;