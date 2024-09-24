<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "@/config/axios";
import type { Auth } from "@/types/Auth";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import baseUrl from "@/stores/baseUrl";
import { Label } from "@/components/ui/label";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";
import {
  DateFormatter,
  type DateValue,
  getLocalTimeZone,
} from "@internationalized/date";
import { Calendar as CalendarIcon } from "lucide-vue-next";
import { Calendar } from "@/components/ui/calendar";
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover";
import { cn } from "@/lib/utils";

const df = new DateFormatter("en-US", {
  dateStyle: "long",
});

const user: any = ref<Auth[]>([]);
const selectFile = ref("");
const datetime = ref<DateValue>();

const getAuth = async () => {
  const response = await axios.get("/user");
  user.value = response?.data ?? [];
};

const handleFileChange = (event: any) => {
  const file = event.target.files[0];
  selectFile.value = file;

  if (file) {
    const reader = new FileReader();
    reader.onload = (event: any) => {
      user.value.imgUrl = event.target.result;
      const photo: any = document.getElementById("photo");
      photo.style.display = "none";
    };
    reader.readAsDataURL(file);
  }
};

const handleUpdateProfile = async (id: number) => {
  if (!selectFile.value) {
    alert("Please select a photo to create.");
    return;
  } else {
    try {
      await axios.post(
        `/user/profile/${id}`,
        {
          photo: selectFile.value,
          name: user.value.name,
          bio: user.value.bio,
          gender: user.value.gender,
          phone: user.value.phone,
          dob: datetime.value,
        },
        {
          withCredentials: false,
          headers: {
            "Content-Type": "multipart/form-data",
            "X-HTTP-Method-Override": "PUT",
          },
        }
      );
      user.value = [];
      getAuth();
    } catch (e) {
      console.error(e);
    }
  }
};

onMounted(() => {
  getAuth();
});
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle> {{ user.name }}</CardTitle>
      <CardDescription v-if="user.username">
        @{{ user.username }}
      </CardDescription>
      <CardDescription> {{ user.bio }} </CardDescription>
    </CardHeader>
    <CardContent class="space-y-2">
      <form @submit.prevent="handleUpdateProfile(user.id)">
        <div class="space-y-1 mb-2">
          <Label for="name">Profile Photo</Label>
          <div class="flex flex-row">
            <img
              v-if="user.photo"
              :src="`${baseUrl}user/${user.photo}`"
              alt="profile"
              class="h-[100px] rounded-lg"
            />
            <img
              v-else
              src="@/assets/images/default-image.png"
              alt="profile"
              class="h-[100px] rounded-lg"
            />
            <img
              v-if="user.imgUrl"
              :src="user.imgUrl"
              alt="profile"
              class="h-[100px] rounded-lg"
            />
            <img
              v-else
              src="@/assets/images/default-image.png"
              alt="profile"
              class="h-[100px] rounded-lg"
            />
          </div>
          <Input type="file" v-model="selectFile" @change="handleFileChange" />
        </div>
        <div class="space-y-1 mb-2">
          <Label>Name </Label>
          <Input v-model="user.name" />
        </div>
        <div class="space-y-1 mb-2">
          <Label>Bio : {{ user.bio }}</Label>
          <Input v-model="user.bio" />
        </div>
        <div class="space-y-1 mb-2">
          <Label>Gender </Label>
          <RadioGroup v-model="user.gender" default-value="male">
            <div class="flex items-center space-x-2">
              <RadioGroupItem id="r1" value="male" />
              <Label for="r1">Male</Label>
            </div>
            <div class="flex items-center space-x-2">
              <RadioGroupItem id="r2" value="female" />
              <Label for="r2">Female</Label>
            </div>
          </RadioGroup>
        </div>
        <div class="space-y-1 mb-2">
          <Label>Phone </Label>
          <Input v-model="user.phone" />
        </div>
        <div class="space-y-1 mb-2 flex flex-col">
          <Label>Date of Birth : {{ user.dob }}</Label>
          <Popover>
            <PopoverTrigger as-child>
              <Button
                variant="outline"
                :class="
                  cn(
                    'w-full justify-start text-left font-normal',
                    !datetime && 'text-muted-foreground'
                  )
                "
              >
                <CalendarIcon class="mr-2 h-4 w-4" />
                {{
                  datetime
                    ? df.format(datetime.toDate(getLocalTimeZone()))
                    : "Pick a date"
                }}
              </Button>
            </PopoverTrigger>
            <PopoverContent class="w-auto p-0">
              <Calendar v-model="datetime" initial-focus />
            </PopoverContent>
          </Popover>
        </div>
        <Button type="submit" class="mt-4">Save changes</Button>
      </form>
    </CardContent>
  </Card>
</template>
