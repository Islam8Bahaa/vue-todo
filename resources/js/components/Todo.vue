<script setup>
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import Http from "../setup/Http.js";

const {todo , reload} = defineProps({
    todo: {
        type: Object,
        default: {
            id: null,
            status: null,
            title: null,
            description: null,
            priority: null,
            created_at: null,
        },
    },
    reload:{
        type : Function,
        default: ()=> {},
    }
});

async function deleteTodo(){
    if (!confirm('Are you Sure!?')){
        return
    }
    const response =  await Http.delete(`/todos/${todo.id}`)
    if (response.data==='deleted'){
        await reload();
        alert('todo successfully deleted :)');
    }

}
async function changeStatus(){
    if (!confirm('Are you Sure!?')){
        return
    }
    const response =  await Http.put(`todos/${todo.id}/change-status`,{
        'status' : 1,
    })
    if (response.data==='updated'){
        await reload();
        alert('todo marked as done :)');
    }
}

</script>
<template>
    <tr class="fw-normal">
        <th>
            <font-awesome-icon size="2xl" v-if="todo.status" icon="fa-regular fa-circle-check" class="text-success"/>
            <font-awesome-icon size="2xl" v-else icon="fa-solid fa-times" class="text-danger"/>
            <span class="ms-2">{{ todo.title }}</span>
        </th>
        <td class="align-middle">
            <span>{{ todo.description }}</span>
        </td>
        <td class="align-middle">
            <h6 class="mb-0">
                <span class="badge " :class="{
                    'bg-danger' : todo.priority === 'Critical',
                    'bg-warning' : todo.priority === 'High',
                    'bg-secondary' : todo.priority === 'Medium',
                    'bg-primary' : todo.priority === 'Low'
                }">
                    {{ todo.priority }} Priority
                </span>
            </h6>
        </td>
        <td class="align-middle">
            {{ todo.created_at }}
        </td>
        <td class="align-middle">
            <button  v-if="!todo.status" data-mdb-toggle="tooltip" class="btn" @click="changeStatus" title="Done">
                <font-awesome-icon icon="fa-solid fa-check" class="text-success"/>
            </button>
            <router-link  v-if="!todo.status"  class="btn" :to="{name:'todos.edit',params:{id:todo.id}}" title="edit">
                <font-awesome-icon icon="fa-solid fa-edit" class="text-warning"/>
            </router-link>
            <button class="btn" data-mdb-toggle="tooltip" title="Remove" @click="deleteTodo">
                <font-awesome-icon icon="fa-solid fa-times" class="text-danger"/>
            </button>
        </td>
    </tr>
</template>

<style scoped>

</style>
