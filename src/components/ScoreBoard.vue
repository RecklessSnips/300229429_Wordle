<template>
  <div class="scoreboard">
    <div class="container">
      <div>
        <h1>
          <span>{{ current_player }}'s Top 5 Scoreboard</span>
        </h1>
        <Toast position="top-center" />
        <table border="1" cellspacing="0" width="500">
          <caption>
            Table
          </caption>
          <thead align="center">
            <tr>
              <td>Attempt Number</td>
              <td>Attempts</td>
            </tr>
          </thead>
          <tbody align="center"></tbody>
        </table>

        <div class="button-group">
          <Button
            label="Clean Board"
            severity="danger"
            outlined
            @click="destroyAndRefresh"
          ></Button>
          <Button label="Submit" severity="info" outlined @click="submit"></Button>
        </div>
      </div>
    </div>
    <div class="container">
      <div>
        <h1>
          <span>Global Scoreboard</span>
        </h1>
        <Toast position="top-center" />
        <table id="globalScoreBoard" border="1" cellspacing="0" width="500">
          <caption>
            Table
          </caption>
          <thead align="center">
            <tr>
              <td>Player</td>
              <td>Attempt Number</td>
              <td>Attempts</td>
            </tr>
          </thead>
          <tbody align="center"></tbody>
        </table>
        <div class="button-group">
          <Button label="Delete Self" severity="danger" outlined @click="deleteSelf"></Button>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'ScoreBoard'
}
</script>

<script lang="ts" setup>
import api from '@/api/api.js'
import { useToast } from 'primevue/usetoast'
import { ref, onMounted, watch, onUnmounted } from 'vue'
const toast = useToast()
let current_player = ref('')
let bestScore = {
  player: '',
  attempt_number: 0,
  attempts: 0
}
let scores = ref([])

onMounted(() => {
  getCurrentUser()
  fetchMessage()
  fetchScore()
})

const congrats = () => {
  toast.add({
    severity: 'success',
    summary: 'Info',
    detail: 'Score Board has been reset',
    life: 2000
  })
}

const noTable = () => {
  toast.add({
    severity: 'warn',
    summary: 'warn',
    detail: 'No data to submit!',
    life: 1500
  })
}

const stored = () => {
  toast.add({
    severity: 'success',
    summary: 'success',
    detail: 'Score submitted!',
    life: 1500
  })
}

const deleted = () => {
  toast.add({
    severity: 'success',
    summary: 'success',
    detail: 'Deleted!',
    life: 1500
  })
}

const notExist = () => {
  toast.add({
    severity: 'warn',
    summary: 'warn',
    detail: 'Player not in the Score Board!',
    life: 1500
  })
}

const getCurrentUser = async () => {
  let user = await api.getCurrentUser()
  if (user.data != '') {
    current_player.value = user.data
  } else {
    current_player.value = 'Anonymous'
    api.setCurrentUser({ current_player: current_player.value })
  }
}

/*
Helper function to retriev the nickname from the session name:
Player_Dooku: 3
Player_Anonymous: 1
Player_Ahsoka: 2
Retrive the Dooku, Anonymous, Ahsoka...
 */
function extractPlayerName(str: string) {
  const regex = /Player_(.*?):/
  const match = str.match(regex)
  if (match && match[1]) {
    // get the value only
    return match[1]
  }
  return null
}

async function fetchMessage() {
  try {
    const session = await api.getMessage()
    const session_object = session.data
    console.log(session_object)
    const tbody = document.getElementsByTagName('tbody')[0]
    // Filter out 'Attempt_Number' and then sort the attempts in ascending order
    let current_player_attempts = 'Att_num_' + current_player.value
    const session_array = Object.entries(session_object)
      .filter(
        (player) =>
          !player[0].includes('Att_num_') &&
          player[0].includes(current_player.value) &&
          player[0] !== 'answer' &&
          player[0] !== 'currentUser'
      )
      .sort((a, b) => a[1].substring(2) - b[1].substring(2))

    console.log(session_array)
    // Only keep the top 5 attempts
    const top_5 = session_array.slice(0, 5)

    top_5.forEach((player) => {
      // Only display current player's scores
      if (extractPlayerName(player[0]) !== current_player.value) {
        return
      }
      // Create the table elements
      const tr = document.createElement('tr')
      const td_key = document.createElement('td')
      const td_value = document.createElement('td')

      td_key.innerText = player[1].substring(0, 1)
      td_value.innerText = player[1].substring(2)

      tr.appendChild(td_key)
      tr.appendChild(td_value)

      tbody.appendChild(tr)
    })
  } catch (error) {
    console.error('Error fetching message:', error)
  }
}

function destroy() {
  api.destroySession()
}

function destroyAndRefresh() {
  congrats()
  destroy()
  setTimeout(() => {
    window.location.reload()
  }, 2000)
}

const submit = async () => {
  // First fow, the best attempt
  const firstRow = document.querySelector('tbody tr')
  if (firstRow == null) {
    noTable()
    return
  }
  const firstRowData = firstRow.querySelectorAll('td')
  bestScore.player = current_player.value
  bestScore.attempt_number = parseInt(firstRowData[0].innerText, 10)
  bestScore.attempts = parseInt(firstRowData[1].innerText, 10)
  console.log(bestScore)
  const response = await api.submitScore(bestScore)
  if (response.data['score stored']) {
    stored()
    // getGlobalScore()
    fetchScore()
    setTimeout(() => {
      window.location.reload()
    }, 1000)
  } else {
    alert('Unknown error!')
  }
}

async function fetchScore() {
  try {
    const response = await api.getGlobalScore()
    scores.value = response.data
    const tbody = document.getElementById('globalScoreBoard')
    scores.value.sort((a, b) => a['attempts'] - b['attempts'])
    scores.value.forEach((player) => {
      // Create the table elements
      const tr = document.createElement('tr')
      const td_player = document.createElement('td')
      const td_attNum = document.createElement('td')
      const td_attempts = document.createElement('td')

      td_player.innerText = player['nick_name']
      td_attNum.innerText = player['attempt_number']
      td_attempts.innerText = player['attempts']

      tr.appendChild(td_player)
      tr.appendChild(td_attNum)
      tr.appendChild(td_attempts)

      tbody.appendChild(tr)
    })
  } catch (error) {
    console.error('Error fetching message:', error)
  }
}

const deleteSelf = async () => {
  const response = await api.deleteSelf({ current_player: current_player.value })
  if (response.data.exists == true) {
    deleted()
    setTimeout(() => {
      window.location.reload()
    }, 1500)
  } else if (response.data.notExist == true) {
    notExist()
  }
}
</script>

<style scoped>
.scoreboard {
  display: flex;
  justify-content: space-evenly;
}
.container {
  margin-bottom: 30rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  height: 100vh;
}

h1 {
  text-align: center;
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  color: crimson;
}

table {
  margin: 20px 0;
  border-collapse: collapse;
  width: 500px;
}

table,
th,
td {
  border: 2px solid black;
}

th,
td {
  padding: 10px;
  text-align: center;
}

caption {
  caption-side: top;
  font-weight: bold;
  margin-bottom: 10px;
}

button {
  margin-top: 20px;
}

.button-group {
  display: flex;
  justify-content: space-evenly;
}
</style>
