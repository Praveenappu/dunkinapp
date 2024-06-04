import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import UserView from '../views/USERS/UserView.vue'
import UserAdd from '../views/USERS/UserAdd.vue'
import UserUpdate from '../views/USERS/UserUpdate.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/userview',
      name: 'user',
      component: UserView,
      beforeEnter: (to, from, next) =>{
        let auth = localStorage.getItem('auth');
        if(auth){
          next();
        }else{
          next('/');
        }
        next();
      }
      
    },
    {
      path: '/userview/add',
      name: 'useradd',
      component: UserAdd,
      beforeEnter: (to, from, next) =>{
        let auth = localStorage.getItem('auth');
        if(auth){
          next();
        }else{
          next('/');
        }
        next();
      }
    },
    {
      path: '/userview/:id/update',
      name: 'userupdate',
      component: UserUpdate,
      beforeEnter: (to, from, next) =>{
        let auth = localStorage.getItem('auth');
        if(auth){
          next();
        }else{
          next('/');
        }
        next();
      }
    },
    
  ]
})

export default router
