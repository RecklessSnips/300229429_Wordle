import { createRouter, createWebHistory } from 'vue-router'

import Wordle from '@/components/Wordle.vue'
import Home from '@/components/Home.vue'
import Portfolio from '@/components/Portfolio.vue'
import ScoreBoard from '@/components/ScoreBoard.vue'

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
      path: '/ScoreBoard',
      component: ScoreBoard
    },
    {
      path: '/',
      redirect: 'Home'
    }
  ]
})

export default router
