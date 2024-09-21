<script setup lang="ts">
import { ref } from "vue";
import ToggleNav from "@/components/app/ToggleNav.vue";
import Navigation from "@/components/app/Navigation.vue";

const isMenuOpen = ref(false);

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};
</script>
<template>
  <nav
    class="fixed top-0 left-0 right-0 bg-white opacity-95 text-black shadow-xl z-50"
  >
    <div class="container mx-auto flex items-center justify-between px-4 py-2">
      <div class="text-2xl font-semibold">
        <RouterLink to="/" class="text-black hover:text-gray-300"
          >MyApp</RouterLink
        >
      </div>

      <div class="hidden lg:flex space-x-4">
        <Navigation />
      </div>
      <button @click="toggleMenu" class="lg:hidden text-black">
        <svg
          class="w-6 h-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16m-7 6h7"
          ></path>
        </svg>
      </button>
    </div>
    <div v-show="isMenuOpen" class="lg:hidden bg-white">
      <ToggleNav />
    </div>
  </nav>
</template>
