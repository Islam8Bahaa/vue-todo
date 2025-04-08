import LoginPage from "../views/auth/LoginPage.vue";
import {createRouter, createWebHistory} from 'vue-router'
import RegisterPage from "../views/auth/RegisterPage.vue";
import NotFoundPage from "../views/NotFoundPage.vue";
import TodoPage from "../views/TodoPage.vue";
import TodoIndex from "../views/TodoIndex.vue";
import {authMiddleware, guestMiddleware} from "./middlewares.js";
import AuthLayout from "../layouts/AuthLayout.vue";
import TodoEdit from "../views/TodoEdit.vue";
import TodoCreate from "../views/TodoCreate.vue";

const routes = [
    {
        path: '/app',
        beforeEnter: [guestMiddleware],
        component: AuthLayout,
        children: [
            {
                name: 'login',
                path: "/login",
                component: LoginPage
            },
            {
                name: 'register',
                path: "/register",
                component: RegisterPage
            }
        ]

    },
    {
        path: '/',
        component: TodoPage,
        beforeEnter: [authMiddleware],
        children: [
            {
                name: 'todos.index',
                path: '/todos',
                component: TodoIndex
            },
            {
                name: 'todos.edit',
                path: '/todos/:id',
                component: TodoEdit
            },
            {
                name: 'todos.create',
                path: '/todos/create',
                component: TodoCreate
            }
        ],
    },
    {
        path: '/:catchAll(.*)',
        name: 'notFond',
        component: NotFoundPage
    }
];


const router = createRouter({
    history: createWebHistory('/app'),
    routes,
    strict: true,
})
export default router
