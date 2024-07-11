<template>
  <div class="container">
    <h1><span>Top 5 Scoreboard</span></h1>
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
    <Button label="Clean Board" severity="danger" @click="destroyAndRefresh"></Button>
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
onMounted(() => {
  fetchMessage()
})

const congrats = () => {
  toast.add({
    severity: 'success',
    summary: 'Info',
    detail: 'Score Board has been reset',
    life: 2000
  })
}

async function fetchMessage() {
  try {
    const session = await api.getMessage()
    const session_object = session.data
    console.log(session_object)
    const tbody = document.getElementsByTagName('tbody')[0]
    // Filter out 'Attempt_Number' and then sort the attempts in ascending order
    const session_array = Object.entries(session_object)
      .filter((player) => player[0] !== 'Attempt_Number' && player[0] !== 'answer')
      .sort((a, b) => a[1] - b[1])

    // Only keep the top 5 attempts
    const top_5 = session_array.slice(0, 5)

    top_5.forEach((player) => {
      if (player[0] == 'Attempt_Number' || player[0] == 'answer') {
        return
      }
      // Create the table elements
      const tr = document.createElement('tr')
      const td_key = document.createElement('td')
      const td_value = document.createElement('td')

      td_key.innerText = player[0].substring(8)
      td_value.innerText = player[1]

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
</script>

<style scoped>
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
</style>
