<script setup>
import ErrorBag from "../components/ErrorBag.vue";
import {ref} from "vue";
const errors = ref([]);

function setErrors(errors_){
    if (Array.isArray(errors_)){
        errors.value = errors_;
    }
    else {
        let a = [];
        Object.values(errors_).forEach((item)=> a =  a.concat(item));
        errors.value = a;
    }
}
</script>

<template>
    <!-- Section: Design Block -->
    <section class="">
        <!-- Jumbotron -->
        <div class="px-4 py-5 px-md-5 text-center text-lg-start"
             style="background-color: hsl(0, 0%, 96%); min-height: 100vh">
            <div class="container">
                <div class="row gx-lg-5 align-items-center justify-content-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            Todo app <br/>
                            <span class="text-primary">Using Vue.js</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            simple todo app in vue.js and laravel for education purpose
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <error-bag :errors="errors"/>
                            <div class="card-body py-5 px-md-5">
                                <RouterView :setErrorsBag = 'setErrors'/>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
</template>

<style scoped>

</style>
