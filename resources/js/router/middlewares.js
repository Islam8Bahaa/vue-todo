import AuthStore from "../store/AuthStore.js";

export function authMiddleware(to, from,next) {
    const store = AuthStore();
    if (!store.auth) {
        next({name: "login"});
    } else {
        next()
    }
}

export function guestMiddleware(to,from,next) {
    const store = AuthStore();
    if (store.auth) {
        next({name: "todos.index"});
    } else {
        next()
    }
}
