<script setup lang="ts">
//@ts-ignore
import { ref, onMounted } from "vue";
import Layout from "@/components/app/Layout.vue";
import axios from "@/config/axios";
import type { Auth } from "@/types/Auth";

const user: any = ref<Auth[]>([]);

const getAuth = async () => {
  const response = await axios.get("/user");
  user.value = response.data;
  console.log(user.value.name);
};

onMounted(() => {
  getAuth();
});
</script>

<template>
  <Layout>
    <h1>this props</h1>
    <h1>name is {{ user.name }}</h1>
  </Layout>
</template>
