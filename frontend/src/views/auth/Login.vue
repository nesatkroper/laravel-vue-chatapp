<script setup lang="ts">
import { ref } from "vue";
import type { Auth } from "@/types/Auth";
import { useRouter } from "vue-router";
import axios from "@/config/axios";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Checkbox } from "@/components/ui/checkbox";
import { Separator } from "@/components/ui/separator";

const router = useRouter();
const auth: any = ref<Auth[]>([]);
const showPass = ref(false);

const navigateToRegister = () => {
  router.push("/register");
};

function isShowPass() {
  showPass.value = !showPass.value;
}

const clear = () => {
  auth.value.email = null;
  auth.value.password = null;
};

const getAuth = async () => {
  const response = await axios.get("/user");
  auth.value = response?.data;
  localStorage.setItem("id", response.data.id);
};

const handleLogin = async () => {
  if (auth.value.email == undefined || auth.value.password == undefined) {
    alert("Error: Please enter a valid email and password");
  } else {
    try {
      const response = await axios.post("/login", {
        email: auth.value.email,
        password: auth.value.password,
      });
      localStorage.setItem("auth_token", response.data.access_token);
      getAuth();
      router.push("/");
    } catch (err: any) {
      alert("Error: " + err);
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
          <CardTitle>Login an account</CardTitle>
          <CardDescription class="hidden md:block"
            >Enter your email below to login your account</CardDescription
          >
        </CardHeader>
        <CardContent>
          <form @submit.prevent="handleLogin">
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
              <Button type="submit">Login</Button>
            </div>
          </form>
          <Separator label="DON'T HAVE ACCOUNT" />
          <div class="grid w-full items-start gap-1.5 text-start my-4">
            <Button @click="navigateToRegister" class="bg-gray-400">
              Register
            </Button>
          </div>
        </CardContent>
      </Card>
    </div>
  </div>
</template>
