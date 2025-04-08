<script setup>
import {defineProps, reactive, ref} from "vue";
import Http, {setCSRfToken} from "../../setup/Http.js";
import {useRouter} from "vue-router";
import AuthStore from "../../store/AuthStore.js";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

const {setErrorsBag} = defineProps({
    setErrorsBag: {
        type: Function,
        default: function () {
        },
    }
})
const user = reactive({
    first_name: null,
    last_name: null,
    email: null,
    password: null
});
const loading = ref(false)
const router = useRouter()
const store = AuthStore();

async function submit() {
    loading.value = true;
    await setCSRfToken()
    try {
        setErrorsBag([])
        const response = await Http.post('/register', user)
        store.login(response.data);
        loading.value = false;
        await router.push({name:'todos.index'})
    } catch (e) {
        if (e.status === 422) {
            console.log(e.data.errors);
            setErrorsBag(e.data.errors)
        }
    }
    loading.value = false;
}

</script>

<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-outline">
                    <input type="text" v-model="user.first_name" id="form3Example1" class="form-control"/>
                    <label class="form-label" for="form3Example1">First name</label>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-outline">
                    <input type="text" id="form3Example2" v-model="user.last_name" class="form-control"/>
                    <label class="form-label" for="form3Example2">Last name</label>
                </div>
            </div>
        </div>

        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="form3Example3" v-model="user.email" class="form-control"/>
            <label class="form-label" for="form3Example3">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input v-model="user.password" type="password" id="form3Example4" class="form-control"/>
            <label class="form-label" for="form3Example4">Password</label>
        </div>
        <!-- Submit button -->
        <div class="d-flex">
            <button type="submit" class="btn btn-primary btn-block mb-4 flex-grow-1">
                <FontAwesomeIcon v-if="loading" icon="fa fa-spinner" spin/>
                <span v-else>Sign up</span>
            </button>
            <router-link :to="{name:'login'}" class="btn btn-secondary btn-block mb-4 flex-grow-1">
                Sign in
            </router-link>
        </div>
    </form>

</template>

<style scoped>
button[type="submit"] {
    margin-inline-end: 5%;
}
</style>
