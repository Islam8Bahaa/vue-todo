/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import {createApp} from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import router from "./router";
import {library} from '@fortawesome/fontawesome-svg-core'
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome'
import {createPinia} from "pinia";



/**
 *  fontawesome setup
 */
import {faFacebookF, faGoogle, faXTwitter, faGithub } from '@fortawesome/free-brands-svg-icons'
import {faCheckCircle,faTimesCircle} from '@fortawesome/free-regular-svg-icons'
import {
    faSpinner,faMagnifyingGlass,faPlusSquare ,faSave ,faTimes,faCheck ,faEdit
} from '@fortawesome/free-solid-svg-icons'
/* add icons to the library */
library.add(
    faFacebookF, faGoogle, faXTwitter, faGithub,faCheckCircle,faSpinner,faMagnifyingGlass,faPlusSquare,faTimesCircle,
    faTimes,faCheck,faEdit,faSave
)

/**
 * router
 */




/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(router);
app.use(createPinia());


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
