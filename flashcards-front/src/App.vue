<script setup>
import { RouterLink, RouterView } from 'vue-router'
import ServerConnectionWrapper from './components/wrappers/ServerConnectionWrapper.vue';
</script>

<template>
  <div class="theme-light">
    <ServerConnectionWrapper>
      <RouterView />
    </ServerConnectionWrapper>
  </div>
</template>

<style scoped>
</style>
