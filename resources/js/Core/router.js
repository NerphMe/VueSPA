import {createRouter, createWebHistory} from 'vue-router';
import Main from "../Components/Main/Main.vue";
import NewsItem from "../Components/NewsItem.vue";

const routes = [
    {
        path: '/',
        component: Main,
        meta: {
            title: 'Main'
        },
    },
    {
        path: '/news/:id',
        component: NewsItem,
        meta: {
            title: 'News Item'
        },
        props: true
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: '/'
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
