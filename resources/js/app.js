
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
//router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
Vue.use(BootstrapVue)

const ListUsers = () => import('./components/ListUsers')

const app = new Vue({
    el: '#app',
    render: h => h(ListUsers)
})
