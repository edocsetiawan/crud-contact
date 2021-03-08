/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 import Vue from 'vue'
 
 import VueRouter from 'vue-router';
 import App from './App.vue';
 import VueAxios from 'vue-axios';
 import axios from 'axios';
 Vue.use(VueRouter);
 Vue.use(VueAxios, axios);
 
 import LandingComponent from './components/LandingPage.vue';
 import NewContactComponent from './components/NewContact.vue';
 const routes = [
     {
         name : 'landingpage',
         path: '/',
         component : LandingComponent
     },
     {
        name : 'newcontact',
        path: '/new-contact',
        props: true,
        component : NewContactComponent
     }
 ]
 const router = new VueRouter({ mode: 'history', routes: routes});
 const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');