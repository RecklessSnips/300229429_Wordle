<template>
  <div>
    <h1><span>Top 3 Scoreboard</span></h1>
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
    <button @click="destroyAndRefresh">Destroy</button>
  </div>
</template>

<script lang="ts">
export default {
  name: 'ScoreBoard'
}
</script>

<script lang="ts" setup>
import api from '@/api/api.js'

import { ref, onMounted, watch, onUnmounted } from 'vue'

onMounted(() => {
  fetchMessage()
})

async function fetchMessage() {
  try {
    const session = await api.getMessage()
    const session_object = session.data
    const tbody = document.getElementsByTagName('tbody')[0]
    // Sort the attempts in ascending order
    const session_array = Object.entries(session_object).sort((a, b) => {
      return a[1] - b[1]
    })

    session_array.forEach((player) => {
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
  destroy()
  window.location.reload()
}
</script>
