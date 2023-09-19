// Класс для читача помилок 
class ErrorReader extends Error {
    constructor(message,cause) {
        super(message);
        this.name = "ErrorReader";
        this.cause = cause;
    }
}

// Класс для помилок посилання
class ReferenceError extends Error {
    constructor(message) {
        super(message);
        this.name = this.constructor.name;
    }
}
//  Класс для помилок посилання на селектор
class SelectorReferenceError extends ReferenceError {
    constructor(message) {
        super(message);
    }
}



// Класс для помилок типу Null || Undefined

class MissingElementError extends Error {
    constructor(message) {
        super(message);
        this.name = this.constructor.name;
    }
}

// Класс для помилок невірного використання методів
class SyntaxError extends Error {
    constructor(message) {
        super(message);
        this.name = this.constructor.name;
    }
}


export {SelectorReferenceError, MissingElementError,ErrorReader, SyntaxError}