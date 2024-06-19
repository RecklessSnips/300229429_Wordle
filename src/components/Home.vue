<template>
  <div>
    <div class="main">
      <div class="info">
        <h1>Overview</h1>
      </div>

      <div class="assignment a1">
        <div class="description">
          <h2>Assignment 1 - Personal Portfolio</h2>
          <p>We designed our personal portfolio page in this assignment.</p>
          <p>
            It contains four sections: <span style="text-decoration: underline">education</span>,
            <span style="text-decoration: underline">skills</span>,
            <span style="text-decoration: underline">experience</span>,
            <span style="text-decoration: underline">project</span>.
          </p>
          <p>Each part is properly styled with <span style="color: gold">CSS</span> properties</p>
        </div>
        <div class="place_holder">
          <img src="/images/img11.png" alt="" width="560px" height="370px" />
        </div>
      </div>
      <div class="assignment a2">
        <div class="place_holder">
          <img src="/images/img12.png" alt="" width="560px" height="370px" />
        </div>
        <div class="description">
          <h2>Assignment 2 - Wordle</h2>
          <p>Instead of Yatzy, we chose to implement the game --- <strong>Wordle</strong></p>
          <p>Wordle is a game where player has 6 chances to use keyboard to enter</p>
          <p>
            a 5 character length <span style="text-decoration: underline">English word</span>. The
            game will prompt useful information
          </p>
          <p>to the player if the word is correct: when player type enter after finish</p>
          <p>
            inputing a word, a
            <span style="background-color: rgb(235, 79, 237)">background color</span> will
            displayed. If it's <span style="color: green">green</span>, it means
          </p>
          <p>
            the word is in the correct position; if it's
            <span style="color: rgb(238, 210, 29)">yellow</span>, the character is correct
          </p>
          <p>
            but false position; if it's <span style="color: rgb(94, 94, 94)">gray</span>, this
            character doesn't exist in the word.
          </p>
        </div>
      </div>
      <div class="assignment a3"></div>
      <div class="assignment a4"></div>
    </div>
    <div class="footer"></div>
  </div>
</template>

<script lang="ts">
export default {
  name: 'Home'
}
</script>

<script lang="ts" setup>
import { RouterView } from 'vue-router'
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  background-color: gainsboro;
  border-radius: 10px;
  font-size: 1.5rem;
  padding: 20px 0;
  position: sticky;
  top: 0;
}

.links > a {
  margin-right: 4rem;
}

.links > a:hover {
  color: orchid;
}

a {
  text-decoration: none;
}

.github:hover {
  color: orchid;
}

.info {
  text-align: center;
}

.assignment {
  display: flex;
  justify-content: space-evenly;
}

.assignment a1 {
  text-align: center;
}
</style>
