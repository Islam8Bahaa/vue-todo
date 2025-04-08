<script setup>
import {defineProps} from "vue";
const {errors} = defineProps({
    errors : {
        type: Array,
        default: [],
    }
});
</script>

<template>
    <div v-if="errors.length" class="alert alert-danger">
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
    </div>
</template>
