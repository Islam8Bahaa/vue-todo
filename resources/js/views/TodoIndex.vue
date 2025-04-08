TodoPage.vue
<script setup>
import {onMounted, reactive, ref, watch,defineProps} from "vue";
import Http from "../setup/Http.js";
import {useRouter} from "vue-router";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import Todo from "../components/Todo.vue";


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

setPageTitle('Todos List');
setErrors([]);
const hasMorePages = ref(true);
const loading = ref(true)
const router = useRouter();
const todos = ref({});
const search = reactive(Object.keys(router.currentRoute.value.query).length ? router.currentRoute.value.query : {
    page: 1,
    query: '',
    perPage: 25,
    priority: '',
    status: ''
})

async function fetchData() {
    loading.value = true;
    const queryString = Object.entries(search).map(([key, value]) => `${key}=${value}`).join('&')
    const response = await Http.get(`/todos?${queryString}`);
    todos.value = response.data;
    hasMorePages.value = response.has_more;
    setTimeout(() => loading.value = false, 500)
}

onMounted(fetchData)

watch(search, function (value) {
    router.push({
        query: {
            ...value
        },
    })
    fetchData();
})

function changePage(number) {
    const x = parseInt(number)
    if (isNaN(x)) {
        return;
    }
    search.page = x;
}

function nextPage() {
    search.page++;
}

function prevPage() {
    if (search.page <= 1) {
        return;
    }
    search.page--;
}
</script>

<template>
    <div class="controllers mb-2">
        <div class="search d-flex align-items-center">
            <input type="search" v-model.lazy.trim="search.query" class="form-control flex-grow-1">
            <select class="form-control" v-model="search.perPage">
                <option value="5">5 per page</option>
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
                <option value="50">50 per page</option>
            </select>
            <select class="form-control" v-model="search.priority">
                <option value="">all priorities</option>
                <option value="1">low priority</option>
                <option value="2">medium priority</option>
                <option value="3">high priority</option>
                <option value="4">critical priority</option>
            </select>
            <select class="form-control" v-model="search.status">
                <option value="">all statuses</option>
                <option value="0">unfinished</option>
                <option value="1">finished</option>
            </select>
            <router-link :to="{'name':'todos.create'}" class="btn text-white">
                <font-awesome-icon :icon="['fas', 'square-plus']"/>
            </router-link>
        </div>
    </div>
    <div v-if="!loading">
        <table class="table text-white mb-3">
            <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">description</th>
                <th scope="col">Priority</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <Todo v-for="todo in todos.data" :key="todo.id" :todo="todo" :reload='fetchData'/>
            </tbody>
        </table>
        <nav aria-label="Page navigation example mb-0">
            <ul class="pagination mb-0">
                <li class="page-item">
                    <button class="page-link" @click="()=>changePage(1)" data-page="1"
                            aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </button>
                </li>
                <li class="page-item" v-for="link in todos.links" :key="link.url"
                    :class="{'active':link.active}">
                    <button v-if="link.label.includes('&ra')" class="page-link"
                            @click="nextPage"
                            :data-page="link.label"
                            :disabled="!hasMorePages"
                            v-html="link.label">
                    </button>
                    <button v-else-if="link.label.includes('&la')" class="page-link"
                            @click="prevPage" :data-page="link.label"
                            v-html="link.label "></button>
                    <button v-else class="page-link" @click="()=>changePage(link.label)"
                            :data-page="link.label">{{ link.label }}
                    </button>
                </li>
                <li class="page-item">
                    <button class="page-link" @click="()=>changePage(todos.last_page)"
                            :data-page="todos.last_page"
                            :disabled="!hasMorePages"
                            aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
    <div class="text-white mb-0 d-flex flex-column mt-5 justify-content-center loading-container"
         v-else>
        <font-awesome-icon class="fw-bold" :icon="['fas', 'spinner']" spin size="2xl"/>
        <span class="d-block text-center">Loading...</span>
    </div>
</template>

<style scoped>
.loading-container {
    font-size: 40px;
}

.controllers .search > *:not(:last-child) {
    margin-inline-end: 10px;
}

</style>
