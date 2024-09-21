<script setup lang="ts">
import { ref, onMounted } from "vue";
import { Switch } from "@/components/ui/switch";
import { Label } from "@/components/ui/label";

const theme = ref("light");

const toggleTheme = () => {
  theme.value = theme.value === "light" ? "dark" : "light";
  document.documentElement.classList.toggle("dark", theme.value === "dark");
};

// Load the theme based on user's system preference or previous selection
onMounted(() => {
  const userTheme = localStorage.getItem("theme") || "light";
  theme.value = userTheme;
  document.documentElement.classList.toggle("dark", userTheme === "dark");
});
</script>

<template>
  <div>
    <Label for="airplane-mode">{{
      theme === "dark" ? "Light " : " Dark "
    }}</Label>
    <Switch id="airplane-mode" @update:checked="toggleTheme" />
  </div>
</template>
