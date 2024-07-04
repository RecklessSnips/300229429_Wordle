import { defineStore } from 'pinia'

export const useAttemptsStore = defineStore('attempts', {
  state() {
    return {
      attempts: 1
    }
  }
})
