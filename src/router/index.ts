import { createRouter, createWebHistory } from 'vue-router'

import Wordle from '@/components/Wordle.vue'
import Wordle_V2 from '@/components/Wordle_V2.vue'
import Wordle_V3 from '@/components/Wordle_V3.vue'
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
      path: '/Wordle_V2',
      component: Wordle_V2
    },
    {
      path: '/Wordle_V3',
      component: Wordle_V3
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
