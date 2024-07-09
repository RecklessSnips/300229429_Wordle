import axios from 'axios'

const apiClient = axios.create({
  baseURL: 'http://localhost:8080',
  withCredentials: true,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
})

export default {
  getMessage() {
    return apiClient.get('/player.php')
  },
  sendMessage(player) {
    console.log(player)
    // const attempts = JSON.stringify({ attempt })
    // console.log(attempts)
    return apiClient.post('/player.php', player)
  },
  destroySession() {
    return apiClient.get('/quit.php')
  },
  postAttempts(attempts) {
    apiClient.post('/attempts.php', JSON.stringify({ attempts }))
  },
  getAttempts() {
    return apiClient.get('/attempts.php')
  }
}
