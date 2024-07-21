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
    apiClient.post('/player.php', player)
  },
  destroySession() {
    return apiClient.get('/quit.php')
  },
  postAttempts(data) {
    console.log(data)
    apiClient.post('/attempts.php', data)
  },
  getAttempts() {
    return apiClient.get('/attempts.php')
  },
  checkWord(word) {
    return apiClient.post('/checkWord.php', word)
  },
  getWord() {
    return apiClient.get('/word.php')
  },
  checkUserExist(nickname) {
    return apiClient.post('/db/check_user.php', nickname)
  },
  register(nickname) {
    return apiClient.post('/db/register.php', nickname)
  },
  login(nickname) {
    return apiClient.post('/db/login.php', nickname)
  },
  getCurrentUser() {
    return apiClient.get('/currentUser.php')
  },
  setCurrentUser(user) {
    return apiClient.post('/currentUser.php', user)
  },
  submitScore(score) {
    return apiClient.post('/db/submit.php', score)
  },
  getGlobalScore() {
    return apiClient.get('/db/globalScore.php')
  },
  deleteSelf(player) {
    return apiClient.post('/db/deleteScore.php', player)
  }
}
