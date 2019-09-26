
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

import { PaginationPlugin } from 'bootstrap-vue'
Vue.use(PaginationPlugin)
//router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
Vue.use(BootstrapVue)

//components:
const CreateUser = () => import('./components/CreateUser')
const NotFound = () => import('./components/NotFound')
const ListUsers = () => import('./components/ListUsers')
const Main = () => import('./components/layout/Main')

//registering components:
Vue.component( 'ListUsers', ListUsers )
Vue.component( 'CreateUser', CreateUser )
Vue.component( 'Main', Main )

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
