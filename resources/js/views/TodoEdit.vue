<script setup>
import {onMounted, ref, defineProps} from "vue";
import Http from "../setup/Http.js";
import {useRouter} from "vue-router";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";


const loading = ref(false)
const router = useRouter();

const todo = ref({
    id: null,
    status: null,
    title: null,
    description: null,
    priority: null,
    created_at: null,
});

const {setPageTitle, setErrors} = defineProps({
    setPageTitle: {
        type: Function,
        default: () => {
        }
    },
    setErrors: {
        type: Function,
        default: () => {
        }
    },
});


setPageTitle('Edit Todo');

async function getTodo(id) {
    const response = await Http.get(`/todos/${id}`)
    todo.value = response.data;
    setPageTitle(`Edit Todo ${todo.value.title}`)
}

onMounted(() => {
    getTodo(router.currentRoute.value.params.id);

})

async function submit() {
    if (!confirm('Are you Sure!?')) {
        return
    }
    try {
        setErrors([])
        loading.value = true
        const response = await Http.put(`/todos/${todo.value.id}`, todo.value)
        if (response.data === 'updated') {
            alert('todo successfully updated :)');
            setErrors([])

        }
    } catch (error) {
        if (error.status === 422) {
            setErrors(error.data.errors);
        }
    }
    loading.value = false;
}
</script>

<template>
    <form class="row" @submit.prevent="submit">
        <div class="col-12 mb-3">
            <input v-model="todo.title" type="text" class="form-control" placeholder="Title">
        </div>
        <div class="col-sm-12 col-md-6 mb-3">
            <select class="form-control" v-model="todo.priority">
                <option value="1"> Low</option>
                <option value="2"> Medium</option>
                <option value="3"> High</option>
                <option value="4"> Critical</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-6 mb-3">
            <select class="form-control" v-model="todo.status">
                <option value="0"> Unfinished</option>
                <option value="1"> Finished</option>
            </select>
        </div>
        <div class="col-12 mb-3">
            <textarea class="form-control" rows="5" v-model="todo.description" placeholder="Description"/>
        </div>
        <div class="col-12 btns d-flex justify-content-end">
            <router-link class="btn btn-secondary" :to="{name:'todos.index'}">
                back
            </router-link>
            <button type="submit" class="btn btn-primary">
                <FontAwesomeIcon v-if="loading" icon="fa fa-spinner" spin/>
                <span v-else>save</span>
            </button>

        </div>
    </form>
</template>
<style scoped>
.btns > *:not(:last-child) {
    margin-inline-end: 15px;
}

.loading-container {
    font-size: 40px;
}
</style>
