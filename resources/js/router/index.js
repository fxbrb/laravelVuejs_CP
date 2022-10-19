import { createRouter, createWebHistory } from "vue-router";
// admin
import homeAdminIndex from '../components/admin/home/index.vue'
import adminAboutIndex from '../components/admin/about/index.vue'
import adminProjectIndex from '../components/admin/projects/index.vue'
import adminProjectNew from '../components/admin/projects/new.vue'
import adminProjectEdit from '../components/admin/projects/edit.vue'
import adminMessageIndex from '../components/admin/messages/index.vue'
import adminUserIndex from '../components/admin/users/index.vue'
// pages
import homePageIndex from '../components/pages/home/index.vue'
//login
import login from '../components/auth/login.vue'

import notFound from '../components/notFound.vue'


const routes = [
     // admin
     {
          path: '/admin/home',
          name: 'adminHome',
          component: homeAdminIndex,
          meta: {
               requiresAuth:true
          }
     },
     {
          path: '/admin/about',
          name: 'adminAbout',
          component: adminAboutIndex,
          meta: {
               requiresAuth:true
          }
     },
     {
          path: '/admin/projects',
          name: 'adminProject',
          component: adminProjectIndex,
          meta: {
               requiresAuth:true
          }
     },
     {
          path: '/admin/projects/new',
          name: 'adminProjectNew',
          component: adminProjectNew,
          meta: {
               requiresAuth:true
          }
     },
     {
          path: '/admin/projects/edit/:id',
          name: 'adminProjectEdit',
          component: adminProjectEdit,
          meta: {
               requiresAuth:true
          },
     },
     {
          path: '/admin/messages',
          name: 'adminMessageIndex',
          component: adminMessageIndex,
          meta: {
               requiresAuth:true
          },
     },
     {
          path: '/admin/users',
          name: 'adminUserIndex',
          component: adminUserIndex,
          meta: {
               requiresAuth:true
          },
     },

     // pages
     {
          path: '/',
          name: 'Home',
          component: homePageIndex,
          meta: {
               requiresAuth:false
          }
     },

     //login
     {
          path: '/login',
          name: 'Login',
          component: login,
          meta: {
               requiresAuth:false
          }
     },

     // notFound
     {
          path: '/:pathMatch(.*)*',
          name: 'notFound',
          component: notFound,
          meta: {
               requiresAuth:false
          }
     }
]

const router = createRouter({
     history: createWebHistory(),
     routes,
})

router.beforeEach((to, from) => {
     if (to.meta.requiresAuth && !localStorage.getItem('token')) {
          return { name: 'Login' }
     }

     if(to.meta.requiresAuth == false && localStorage.getItem('token')){
          return { name: 'adminHome'}
     }
})

export default router;