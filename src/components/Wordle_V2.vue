<template>
  <div class="subheader">
    <div class="info1">Life left: {{ life }}</div>
    <div class="info2">Attempts: {{ php_attempts }}</div>
  </div>
  <div class="container">
    <div class="header">
      <div>
        <Toast position="top-center" />
        <Dialog
          v-model:visible="visible"
          modal
          header="You Lost!"
          :style="{ width: '20%', height: '20%' }"
          ><p>
            The answer was: <span style="color: rgb(255, 200, 1)">{{ oldAnswer }}</span>
          </p></Dialog
        >
        <Button label="Give Up" severity="danger" @click="giveUp"></Button>
      </div>
    </div>
    <div>
      <div class="hint">Press any key!</div>
      <div>
        <div v-for="row in inputWord" class="row">
          <div v-for="word in row" class="word_box">
            <div class="word">{{ word }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'Wordle_V2'
}
</script>

<script lang="ts" setup>
import api from '@/api/api.js'
import { ref, onMounted, watch, onUnmounted } from 'vue'
import { useToast } from 'primevue/usetoast'
import { useConfirm } from 'primevue/useconfirm'
const toast = useToast()
const confirm = useConfirm()

let currentRow = ref(0)
let currentCol = ref(0)
let visible = ref(false)
let php_attempts = ref(0)
const words = ref('')

let answer = ref('')
let oldAnswer = ref('')
let index = ref([0, 0, 0, 0, 0])
let life = ref(6)

onMounted(() => {
  window.addEventListener('keydown', handleKeydown)
  fetchWord()
  fetchMessage()
})

const inputWord = ref(Array.from({ length: 6 }, () => Array(5).fill('')))

/*
  Assign the old answer to the popup window,
  Test if the word is genered properly
*/
watch(answer, (newValue, oldValue) => {
  oldAnswer.value = oldValue
  console.log('Answer is: ', newValue)
})

const fetchWord = async () => {
  try {
    const response = await api.getWord()
    answer.value = response.data.answer
  } catch (error) {
    console.error('Error fetching word:', error)
  }
}

const giveUp = () => {
  getWord()
  visible.value = true
  resetRowCol()
  resetBoard()
  life.value = 6
}

const congrats = () => {
  toast.add({
    severity: 'success',
    summary: 'Info',
    detail: 'Congrats! You win the game! (Game will restart in 3 seconds)',
    life: 3000
  })
}

const popUp = () => {
  toast.add({
    severity: 'info',
    summary: 'info',
    detail: 'Opps, try again',
    life: 2000
  })
}

const lose = () => {
  toast.add({
    severity: 'error',
    summary: 'Info',
    detail: 'You lost!',
    life: 2000
  })
}

const warning = () => {
  toast.add({
    severity: 'warn',
    summary: 'warn',
    detail: 'Too Short',
    life: 1500
  })
}

const invalid = () => {
  toast.add({
    severity: 'warn',
    summary: 'warn',
    detail: 'Invalid English Word',
    life: 1800
  })
}

const handleKeydown = async (event: KeyboardEvent) => {
  const key = event.key
  if (/^[a-zA-Z]$/.test(key) && currentCol.value < 5) {
    inputWord.value[currentRow.value][currentCol.value] = key.toUpperCase()
    currentCol.value++
  } else if (key === 'Backspace' && currentCol.value > 0) {
    inputWord.value[currentRow.value][--currentCol.value] = ''
  } else if (key === 'Enter') {
    if (currentCol.value < 5) {
      warning()
    } else {
      // Sending the input word to the php server
      const word = inputWord.value[currentRow.value].join('')
      const response = await api.checkWord({
        word,
        answer: answer.value,
        currentRow: currentRow.value,
        currentCol: currentCol.value
      })
      // Updates the index array
      index.value = response.data.index
      evaluateBoard()
      if (response.data.result === 'win') {
        congrats()
        let player = {
          a_number: php_attempts.value,
          a_attempts: 7 - life.value
        }
        api.sendMessage(player)
        api.postAttempts(1)
        setTimeout(() => {
          resetBoard()
          resetRowCol()
          fetchMessage()
        }, 3000)
      } else if (response.data.result === 'lose') {
        lose()
        api.postAttempts(1)
        setTimeout(() => {
          resetBoard()
          resetRowCol()
          fetchMessage()
          life.value = 6
        }, 3000)
      } else {
        popUp()
        currentRow.value++
        currentCol.value = 0
        life.value--
        index.value = response.data.index
      }
    }
  }
}

const evaluateBoard = () => {
  index.value.forEach((value, i) => {
    // Use .row to select class and :nth-child to specify which child
    const box = document.querySelector(
      `.row:nth-child(${currentRow.value + 1}) .word_box:nth-child(${i + 1})`
    )
    if (box) {
      switch (value) {
        case 1:
          box.classList.add('green')
          break
        case 0:
          box.classList.add('yellow')
          break
        case -1:
          box.classList.add('gray')
          break
      }
    }
  })
}

const resetRowCol = () => {
  currentRow.value = 0
  currentCol.value = 0
}

const resetBoard = () => {
  life.value = 6
  inputWord.value.forEach((arr, row) => {
    arr.forEach((_, col) => {
      inputWord.value[row][col] = ''
    })
  })
  const boxes = document.querySelectorAll('.word_box')
  boxes.forEach((box) => {
    box.classList.remove('green', 'yellow', 'gray')
  })
  fetchWord()
}

async function fetchMessage() {
  try {
    const session = await api.getAttempts()
    if ('Attempt_Number' in session.data) {
      const attempts_object = session.data['Attempt_Number']
      php_attempts.value = attempts_object
    } else {
      php_attempts.value = 1
      return
    }
  } catch (error) {
    console.error('Error fetching message:', error)
  }
}

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown)
})
</script>

<style scoped>
.header {
  margin-bottom: 30rem;
  margin-right: 5rem;
}
.info1 {
  display: inline;
  margin-right: 200px;
  font-size: 150%;
  font-style: oblique;
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  font-weight: bold;
}
.info2 {
  display: inline;
  margin-left: 200px;
  font-size: 150%;
  font-style: oblique;
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  font-weight: bold;
}

.subheader {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 40px;
  padding: 0 20px;
}
.container {
  display: flex;
  justify-content: center;
  align-items: start;
  height: 100vh;
  font-size: 2rem;
  margin-top: 4rem;
}
.hint {
  text-align: center;
}
.row {
  display: flex;
  justify-content: center;
  margin: 20px auto;
}
.word_box {
  width: 50px;
  height: 50px;
  border: 1px rgb(242, 195, 138) solid;
  margin: auto 5px;
  display: inline-block;
}
.word {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.green {
  background-color: aquamarine;
  animation: flip 1s ease forwards;
}

.yellow {
  background-color: gold;
  animation: flip 1s ease forwards;
}

.gray {
  background-color: gray;
  animation: flip 1s ease forwards;
}

@keyframes flip {
  from {
    transform: scale(1.3);
  }
  to {
    transform: scale(1);
  }
}
</style>
