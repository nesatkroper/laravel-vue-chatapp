<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "@/config/axios";
import type { Auth } from "@/types/Auth";
import type { ContactList } from "@/types/ContactList";
import baseUrl from "@/stores/baseUrl";
import { Card, CardContent } from "@/components/ui/card";
import { Avatar, AvatarImage } from "@/components/ui/avatar";
import { Skeleton } from "@/components/ui/skeleton";

const contact_list: any = ref<Auth[] | ContactList[]>([]);
const loading = ref(true);

const id: any = localStorage.getItem("id");

const getContactList = async () => {
  try {
    const response = await axios.get(`/contact/get/${id}`);
    const res = Object.assign({}, response?.data.data ?? []);
    contact_list.value = res;
    loading.value = false;
  } catch (e) {
    loading.value = true;
  }
};

onMounted(() => {
  getContactList();
});
</script>

<template>
  <Card v-if="loading">
    <CardContent>
      <div class="flex items-center my-4">
        <Skeleton class="h-11 w-11 rounded-full" />
        <div class="space-y-2">
          <Skeleton class="h-4 w-[150px]" />
          <Skeleton class="h-4 w-[100px]" />
        </div>
      </div>
    </CardContent>
  </Card>

  <Card v-else v-for="row in contact_list" class="shadow-lg my-1">
    <CardContent class="p-0 flex">
      <div class="m-2">
        <Avatar>
          <AvatarImage :src="`${baseUrl}user/${row.users[0].photo}`" />
        </Avatar>
      </div>
      <div class="flex-col">
        <p class="font-bold">{{ row.nickname }}</p>
        <p>{{ row.phone }}</p>
      </div>
    </CardContent>
  </Card>
</template>
