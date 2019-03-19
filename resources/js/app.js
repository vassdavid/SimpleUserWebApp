
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import { Pagination } from 'bootstrap-vue/es/components'
Vue.use(Pagination)
//router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
Vue.use(BootstrapVue)

//components:
const ListUsers = () => import('./components/ListUsers')
const Main = () => import('./components/layout/Main')
const LeftSidebar = () => import('./components/LeftSidebar')
const CreateUser = () => import('./components/CreateUser')
const NotFound = () => import('./components/NotFound')

//registering components:
Vue.component( 'ListUsers', ListUsers )
Vue.component( 'Main', Main )
Vue.component( 'LeftSidebar', LeftSidebar )
Vue.component( 'CreateUser', CreateUser )


const routes = [
  {
    path: '/',
    component: ListUsers,
    name: 'home'
  },
  {
    path: '/users',
    component: ListUsers
  },
  {
    path: '/users-page/:page',
    component: ListUsers,
    name: 'userPager'
  },
  {
    path: '/CreateUser',
    component: CreateUser,
    name: 'CreateUser'
  },
  {
    path: '/404',
    component: NotFound
  },
  {
    path: '*',
    redirect: '/404'
  },
]

const router = new VueRouter({
  routes
})

const app = new Vue({
    el: '#app',
    router,
    render: h => h(Main)
})
