<script setup lang="ts">
import Header from "./Header.vue";
import Footer from "./Footer.vue";
</script>

<template>
  <div class="overflow-auto no-scrollbar">
    <Header />
    <div class="flex flex-col">
      <div class="mt-16 ms-0">
        <slot></slot>
      </div>
    </div>
    <Footer />
  </div>
</template>
