<script lang="ts" setup>
import Wordle from '@/components/Wordle.vue'
import Home from '@/components/Home.vue'
</script>

<template>
  <div class="header">
    <div>
      <span style="margin-left: 10rem"
        ><a class="github" href="https://github.com/RecklessSnips/300229429_Wordle" target="_blank"
          >CSI 3140</a
        ></span
      >
    </div>
    <div class="links">
      <RouterLink to="/Home">Home</RouterLink>
      <RouterLink to="/Portfolio">Portfolio</RouterLink>
      <RouterLink to="/Wordle">Wordle</RouterLink>
    </div>
  </div>
  <div>
    <RouterView></RouterView>
  </div>
</template>

<style scoped>
.container {
  height: 100vh;
}
.header {
  display: flex;
  justify-content: space-between;
  background-color: gainsboro;
  border-radius: 10px;
  font-size: 1.5rem;
  padding: 20px 0;
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
</style>
