import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import NewPost from './views/NewPost'
import Post from './views/Post'
import EditPost from './views/EditPost'
import Home from './views/Home'
import Login from './views/Login'
import store from './store/store'
import Navbar from './components/Navbar'


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/newpost',
            name: 'newpost',
            component: NewPost,
            beforeEnter: (to, from, next) => {
                if(localStorage.getItem('access_token')) {
                    next()
                } else {
                    next({name:'login'})
                }
            }
        },
        { 
            path: '/post/:id', 
            name: 'post',
            component: Post
        },
        { 
            path: '/post/edit/:id', 
            name: 'editpost',
            component: EditPost,
            beforeEnter: (to, from, next) => {
                if(localStorage.getItem('access_token')) {
                    next()
                } else {
                    next({name:'login'})
                }
            }
        },
        { 
            path: '/login', 
            name: 'login',
            component: Login,
            beforeEnter: (to, from, next) => {
                if(localStorage.getItem('access_token')) {
                    next({name:'login'})
                } else {
                    next()
                }
            }
        }
    ],
});

var filter = function(text, length, clamp){
    clamp = clamp || '...';
    var node = document.createElement('div');
    node.innerHTML = text;
    var content = node.textContent;
    return content.length > length ? content.slice(0, length) + clamp : content;
};

Vue.filter('truncate', filter);
Vue.component('Navbar', Navbar);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});