import { createRouter, createWebHistory } from 'vue-router';
import store from "@/store";

// Routes
import AuthRoutes from './auth';
import Contacts from './contacts';

// Templates
import Home from "@/views/Home.vue";
import Dashboard from "@/views/page/Dashboard.vue";

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
  ...AuthRoutes,
  ...Contacts
];

const router = createRouter({
  history: createWebHistory(),
  routes
})

//Begin Navigation Guard script
router.beforeEach((to, from, next) => {

  // If logged in
  if(store.getters["auth/authenticated"]) {
    if(to.name == "admin.login") {
      return next({ name: "dashboard" });
    }
  } else {
    if(to.name === "admin.login") {
        next();
    } else {
        return next({ name: "admin.login" });
    }
  }

  next();
});
//End Navigation Guard script

export default router
