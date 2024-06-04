<template>
  <div class="container">
    <div class="header">
      <div>
        <Toast position="top-center"/>
        <Button label="Give Up"  @click="giveUp"></Button>
      </div>
    </div>
    <div>
      <div>
        <div v-for="row in inputWord" class="row">
          <div v-for="word in row" class="word_box">
            <div class="word">{{ word }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="info">
      Life left: {{ life }}
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
import { useToast } from "primevue/usetoast";
const toast = useToast();

let currentRow = ref(0)
let currentCol = ref(0)
let answer = ref('apple')
let life = ref(6)

onMounted(() => {
  window.addEventListener('keydown', handleKeydown)
  isValidWord('example').then(isValid => console.log(isValid));
})

const inputWord = ref(Array.from({ length: 6 }, () => Array(5).fill('')))

watch(currentRow, (newValue, oldValue) => {
  console.log('Row', newValue, oldValue)
})

watch(currentCol, (newValue, oldValue) => {
  console.log('Col', newValue, oldValue)
})

const giveUp = () => {
  toast.add({severity: 'info', summary: 'Info', detail: 'Guess is not that easy huh?', life: 1000})
  resetRowCol()
  resetBoard()
}

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
      checkBoard()
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

const checkBoard = () => {
  let word = inputWord.value[currentRow.value]
  let index = ref([0, 0, 0, 0, 0])
  for(let i = 0; i < word.length; i++){
      if(word[i] === answer.value[i].toUpperCase()){
        index.value[i] = 1;
      }else{
        console.log(answer.value)
        console.log(word[i])
        if(answer.value.toUpperCase().includes(word[i])){
          index.value[i] = 0;
        }else{
          index.value[i] = -1;
        }
      }
  }
  console.log(index.value)
}

async function isValidWord(word: string) {
  const response = await fetch(`https://api.datamuse.com/words?sp=${word}&md=d&max=1`);
  const data = await response.json();
  return data.length > 0 && 'defs' in data[0];
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
.header{
  margin-bottom: 30rem;
  margin-right: 10rem;
}
.info{
  margin-bottom: 30rem;
  margin-left: 9rem;
}
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
