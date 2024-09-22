<script setup lang="ts">
import { useRouter } from "vue-router";
import { ref } from "vue";
import type { Auth } from "@/types/Auth";
import axios from "@/config/axios";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Checkbox } from "@/components/ui/checkbox";
import { Separator } from "@/components/ui/separator";

const router = useRouter();
const auth: any = ref<Auth[]>([]);
const showPass = ref(false);

const navigateToLogin = () => {
  router.push("/login");
};

function isShowPass() {
  showPass.value = !showPass.value;
}

const clear = () => {
  auth.value.password_confirmation = null;
  auth.value.password = null;
};

const handleRegister = async () => {
  if (auth.value.password != auth.value.password_confirmation) {
    alert("Password not match");
    clear();
  } else {
    try {
      const response = await axios.post("/register", {
        name: auth.value.name,
        email: auth.value.email,
        password: auth.value.password,
        password_confirmation: auth.value.password_confirmation,
      });
      localStorage.setItem("auth_token", response.data.access_token);
      router.push("/");
    } catch (err) {
      alert("Error" + err);
      clear();
    }
  }
};
</script>

<template>
  <div class="flex justify-center items-center h-[80vh]">
    <div class="text-center w-full md:w-[30rem]">
      <Card class="shadow-none md:shadow-2xl">
        <CardHeader>
          <CardTitle>Create an account</CardTitle>
          <CardDescription class="hidden md:block"
            >Enter your email below to create your account</CardDescription
          >
        </CardHeader>
        <CardContent>
          <form @submit.prevent="handleRegister">
            <div class="grid w-full items-start gap-1.5 text-start my-4">
              <Label>Name</Label>
              <Input v-model="auth.name" type="text" placeholder="Name" />
            </div>
            <div class="grid w-full items-start gap-1.5 text-start my-4">
              <Label>Email</Label>
              <Input v-model="auth.email" type="email" placeholder="Email" />
            </div>
            <div class="grid w-full items-start gap-1.5 text-start my-4">
              <Label>Password</Label>
              <Input
                v-model="auth.password"
                :type="showPass ? 'text' : 'password'"
                placeholder="Password"
              />
            </div>
            <div class="grid w-full items-start gap-1.5 text-start my-4">
              <Label>Confirm Password</Label>
              <Input
                v-model="auth.password_confirmation"
                :type="showPass ? 'text' : 'password'"
                placeholder="Confirm Password"
              />
              <div class="flex items-center space-x-2">
                <Checkbox id="terms" @update:checked="isShowPass" />
                <label
                  for="terms"
                  class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                >
                  Show Password
                </label>
              </div>
            </div>
            <div class="grid w-full items-start gap-1.5 text-start my-4">
              <Button type="submit">Register</Button>
            </div>
          </form>
          <Separator label="OR ALREADY HAVE ACCOUNT" />
          <div class="grid w-full items-center gap-1.5 text-center my-4">
            <Button @click="navigateToLogin" class="bg-gray-400">
              Login
            </Button>
          </div>
        </CardContent>
      </Card>
    </div>
  </div>
</template>
