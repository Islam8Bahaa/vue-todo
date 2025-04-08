<script setup>
import {ref} from "vue";
import ErrorBag from "../components/ErrorBag.vue";
import AuthStore from "../store/AuthStore.js";
import {useRouter} from "vue-router";

const pageTitle = ref('Task List')
const errors = ref([])
const router = useRouter()
const authStore = AuthStore();
function setErrors(errors_) {
    if (Array.isArray(errors_)) {
        errors.value = errors_;
    } else {
        let a = [];
        Object.values(errors_).forEach((item) => a = a.concat(item))
        errors.value = a;
    }
}

function setPageTitle(title) {
    pageTitle.value = title
}
async function logout(){
    if (!confirm('Are You Sure ?!')){
        return;
    }
    await authStore.logout();
    await router.push('login')
}
</script>

<template>
    <section class="min-vh-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-10">
                    <div class="card mask-custom">
                        <div class="card-body p-4 text-white">
                            <div class="text-center pt-3 pb-2">
                                <img
                                    src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-todo-list/check1.webp"
                                    alt="Check" width="60">
                                <button style="margin-inline-start:10px"  @click="logout" class="btn btn-danger">Logout</button>
                                <h2 class="my-4">{{ pageTitle }}</h2>
                            </div>
                            <ErrorBag :errors="errors"/>
                            <RouterView :setPageTitle='setPageTitle' :setErrors='setErrors'/>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.gradient-custom-2 {
    /* fallback for old browsers */
    background: #7e40f6;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(
        to right,
        rgba(126, 64, 246, 1),
        rgba(80, 139, 252, 1)
    );

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(
        to right,
        rgba(126, 64, 246, 1),
        rgba(80, 139, 252, 1)
    );
}

.mask-custom {
    background: rgba(24, 24, 16, 0.2);
    border-radius: 2em;
    backdrop-filter: blur(25px);
    border: 2px solid rgba(255, 255, 255, 0.05);
    background-clip: padding-box;
    box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
}
</style>
