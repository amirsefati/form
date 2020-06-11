require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router'
import VueSax from 'vuesax'

import 'vuesax/dist/vuesax.css'
import 'material-icons/iconfont/material-icons.css';

Vue.use(VueRouter)
Vue.use(VueSax)

import Index from './components/index'
import verifycode from './components/verifycode'
import Navi from './components/navigation'
import success from './components/success'
import login from './components/login'
import welcome from './components/welcome'

const router = new VueRouter({
    mode:'history',
    routes :[
        {
            path:'/index',
            name:'index',
            component:Index
        },
        {
            path:'/verifycode',
            name:'verifycode',
            component:verifycode
        },
        {
            path:'/navi',
            name:'navi',
            component:Navi
        },
        {
            path:'/success',
            name:'success',
            component:success
        },
        {
            path:'/loginm',
            name:'loginm',
            component:login
        },
        {
            path:'/welcome',
            name:'welcome',
            component:welcome
        }
    ]
});

const app = new Vue({
    el : '#app',
    components : {Navi},
    router
})
