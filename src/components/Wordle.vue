<template>
  <div class="container">
    <div>
      <div v-for="row in inputWord" class="row">
        <div v-for="word in row" class="word_box">
          <div class="word">{{ word }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'Wordle'
}
</script>

<script lang="ts" setup>
import { ref, onMounted, watch, computed } from 'vue'

let currentRow = ref(0)
let currentCol = ref(0)
let answer = ref('apple')

onMounted(() => {
  window.addEventListener('keydown', handleKeydown)
})

const inputWord = ref(Array.from({ length: 6 }, () => Array(5).fill('')))

watch(currentRow, (newValue, oldValue) => {
  console.log('Row', newValue, oldValue)
})

watch(currentCol, (newValue, oldValue) => {
  console.log('Col', newValue, oldValue)
})

const handleKeydown = (event: KeyboardEvent) => {
  const key = event.key
  if (/^[a-zA-Z]$/.test(key) && currentCol.value < 5) {
    inputWord.value[currentRow.value][currentCol.value] = key.toUpperCase()
    currentCol.value++
  } else if (key === 'Backspace' && currentCol.value > 0) {
    inputWord.value[currentRow.value][--currentCol.value] = ''
  } else if (key === 'Enter') {
    if (currentCol.value < 5) {
      alert('Too Short')
    } else {
      if (inputWord.value[currentRow.value].join('') === answer.value.toUpperCase()) {
        alert('Congrats!')
        resetBoard()
        resetRowCol()
      } else if (currentRow.value < 5) {
        alert('Opps')
        currentRow.value++
        currentCol.value = 0
      } else {
        alert('You lost!')
        resetBoard()
        resetRowCol()
      }
    }
  }
}

const resetRowCol = () => {
  currentRow.value = 0
  currentCol.value = 0
}

const resetBoard = () => {
  inputWord.value.forEach((arr, row) => {
    arr.forEach((_, col) => {
      inputWord.value[row][col] = ''
    })
  })
}

/*
 [
  "aqwer", "azxsd", "anvbm", "ahgfd", "aopqw",
  "btyui", "bgfds", "bmkli", "bvncs", "bqwde",
  "cfgds", "czxvb", "ctyui", "cmklo", "cplmk",
  "dfgtr", "dvcxz", "dmnkl", "dqwsa", "dplok",
  "efghj", "evcxz", "emnbv", "eqwpl", "ezxsd"
]
 */
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  font-size: 2rem;
}
.row {
  margin: 20px auto;
}
.word_box {
  width: 50px;
  height: 50px;
  border: 1px bisque solid;
  margin: auto 5px;

  display: inline-block;
}
.word {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}
</style>
