import { createRouter, createWebHistory } from 'vue-router'

import Wordle from '@/components/Wordle.vue'
import Home from '@/components/Home.vue'
import Portfolio from '@/components/Portfolio.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/Wordle',
      component: Wordle
    },
    {
      path: '/Home',
      component: Home
    },
    {
      path: '/Portfolio',
      component: Portfolio
    },
    {
      path: '/',
      redirect: 'Home'
    }
  ]
})

export default router
