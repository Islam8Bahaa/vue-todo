import {defineStore} from "pinia";
import Http from "../setup/Http.js";

export default defineStore('auth',{
    state:() => {
        return {
            auth: JSON.parse(localStorage.getItem('user')) || null,
        }
    },
    actions:{
        login(auth){
            localStorage.setItem('user',JSON.stringify(auth));
            this.auth = auth;
        },
         async logout(){
            await Http.post('/logout')
             this.expired()
         },
        expired(){
            localStorage.removeItem('user')
            this.auth = null;
        },
    }
});
