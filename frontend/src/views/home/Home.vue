<script setup lang="ts">
//@ts-ignore
import { ref, onMounted } from "vue";
import Layout from "@/components/app/Layout.vue";
import axios from "@/config/axios";
import type { Auth } from "@/types/Auth";

//
import HomeSheet from "@/views/home/components/HomeSheet.vue";
import HomeContent from "@/views/home/components/HomeContent.vue";
import { Sheet, SheetTrigger } from "@/components/ui/sheet";
import { Button } from "@/components/ui/button";
import { AlignJustify } from "lucide-vue-next";

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
    <Sheet>
      <div class="flex">
        <div class="w-[70px] h-[90vh] bg-gray-200">
          <SheetTrigger>
            <Button class="bg-gray-400 w-[60px] mt-4 mx-[5px]">
              <AlignJustify class="w-6 h-6" />
            </Button>
          </SheetTrigger>
        </div>
        <div class="w-full h-[90vh]">
          <HomeContent />
        </div>
        <HomeSheet />
      </div>
    </Sheet>
  </Layout>
</template>
