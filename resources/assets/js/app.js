import Vue from 'vue';
import VueResource from 'vue-resource';
import Router from 'vue-router';
import { configRouter } from './routes.js';

import App from './App.vue';

import jwtAuthInterceptor from './interceptors/jwtAuth';

Vue.use(Router);
Vue.use(VueResource);

Vue.http.interceptors.push(jwtAuthInterceptor);

Vue.transition('new-comment', {
  enterClass: 'fadeInDown',
  leaveClass: 'fadeInUp'
});

Vue.transition('fade', {
  enterClass: 'fadeInDown',
  leaveClass: 'fadeInUp',
  type: 'animation'
});

// Create router
export const router = new Router({
  history: true,
  saveScrollPosition: true
});

// Config router
configRouter(router);

// Start the app on the #app div
router.start(App, '#app');
