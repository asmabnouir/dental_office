import Vue from 'vue';
import Router from 'vue-router';
import Index from './pages/Index.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import Profile from './pages/Profile.vue';
import MainNavbar from './layout/MainNavbar.vue';
import MainFooter from './layout/MainFooter.vue';
import Store from './store';
Vue.use(Router);

 const router = new Router({
  linkExactActiveClass: 'active',
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'index',
      components: { default: Index, header: MainNavbar, footer: MainFooter },
      props: {
        header: { colorOnScroll: 400 },
        footer: { backgroundColor: 'black' }
      }
    },
    
    {
      path: '/login',
      name: 'login',
      components: { default: Login, header: MainNavbar },
      meta: {
        requiresAuth: false
    },
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/register',
      name: 'register',
      meta: {
        requiresAuth: false
    },
      components: { default: Register, header: MainNavbar },
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/profile',
      name: 'profile',
      components: { default: Profile, header: MainNavbar, footer: MainFooter },
      meta: {
        requiresAuth: true
    },
        props: {
          header: { colorOnScroll: 400 },
          footer: { backgroundColor: 'black' }
        }

    }
  ],
  scrollBehavior: to => {
    if (to.hash) {
      return { selector: to.hash };
    } else {
      return { x: 0, y: 0 };
    }
  }
});

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const token = Store.state.token;

  if(requiresAuth && !token) {
      next('/login');
 // } else if(to.path == '/login' && token) {
     // next('/');
  } else {
      next();
  }
});
export default router;
