import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),
  },
  {
    path: '/orders',
    name: 'Order',
    component: () => import('../views/Order.vue'),
  },
  {
    path: '/orders-date',
    name: 'orders-date',
    component: () => import('../views/OrderDate.vue'),
  },
  {
    path: '/orders-id',
    name: 'orders-id',
    component: () => import('../views/OrderId.vue'),
  },
  {
    path: '/exit',
    name: 'exit',
    component: () => import('../views/Home.vue'),
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
