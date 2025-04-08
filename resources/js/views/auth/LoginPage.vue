<script setup>
import {reactive, ref, defineProps} from "vue";
import Http, {setCSRfToken} from "../../setup/Http.js";
import {useRouter} from "vue-router";
import AuthStore from "../../store/AuthStore.js";

const {setErrorsBag} = defineProps({
    setErrorsBag: {
        type:Function,
        default: function (){},
    }
})


const data = reactive({
    email: null,
    password: null
});
const dataError = reactive({
    email: null,
    password: null
});
const loading = ref(false)

const router = useRouter()

const store = AuthStore();

function setErrors(errors) {
    for (const [key, value] of Object.entries(errors)) {
        if (Array.isArray(value)) {
            dataError[key] = value[0];
        } else {
            dataError[key] = value;
        }
    }
}

async function handelSubmit() {
    setErrors({
        email: null,
        password: null,
    })
    setErrorsBag([])

    loading.value = true;
    await setCSRfToken()
    const response = await Http.post('/login', data);
    if (!response.data.success) {
        if (response.data.error === 'validation error') {
            setErrors(response.data.errors)

        }else {
            setErrorsBag([response.data.error])
        }
        loading.value = false

        return
    }
    loading.value = false
    store.login(response.data.user);
    await router.push({name: 'todos.index'})

}

</script>

<template>

    <form @submit.prevent="handelSubmit">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="email">Email address</label>
            <input type="email" v-model="data.email" id="email" class="form-control"
                   :class="{'border-danger': dataError.email}"/>
            <span v-if="dataError.email" class="text-danger"> {{ dataError.email }} </span>
        </div>
        <!-- Password input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="password" v-model="data.password" id="password" class="form-control"
                   :class="{'border-danger': dataError.password}"/>
            <span v-if="dataError.password" class="text-danger"> {{ dataError.password }} </span>
        </div>
        <!-- Submit button -->
        <div class="d-flex">
            <button type="submit" class="btn btn-primary btn-block mb-4 flex-grow-1">
                <font-awesome-icon v-if="loading" :icon="['fas', 'spinner']"/>
                <span v-else>Sign in</span>
            </button>
            <router-link :to="{name:'register'}" class="btn btn-secondary btn-block mb-4 flex-grow-1">
                Sign up
            </router-link>
        </div>
    </form>
</template>

<style scoped>
button[type="submit"] {
    margin-inline-end: 5%;
}
</style>
