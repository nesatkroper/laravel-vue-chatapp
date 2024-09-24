<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "@/config/axios";
import type { Auth } from "@/types/Auth";
import { useRouter } from "vue-router";
import ThemeToggle from "@/components/app/ThemeToggle.vue";
import { components } from "@/components/utils/components";
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
  navigationMenuTriggerStyle,
} from "@/components/ui/navigation-menu";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import baseUrl from "@/stores/baseUrl";

const router = useRouter();
const user: any = ref<Auth[]>([]);

const logout = async () => {
  await axios.post("/logout");
  localStorage.removeItem("auth_token");
  localStorage.removeItem("id");
  router.push("/login");
};

const getAuth = async () => {
  const response = await axios.get("/user");
  user.value = response.data;
};

onMounted(() => {
  getAuth();
});
</script>

<template>
  <NavigationMenu>
    <NavigationMenuList>
      <NavigationMenuItem>
        <NavigationMenuLink :class="navigationMenuTriggerStyle()">
          <RouterLink to="/" class="hover:text-gray-300">Home</RouterLink>
        </NavigationMenuLink>
      </NavigationMenuItem>
      <NavigationMenuItem>
        <NavigationMenuTrigger>Components</NavigationMenuTrigger>
        <NavigationMenuContent>
          <ul
            class="grid w-[300px] gap-3 p-4 md:w-[400px] md:grid-cols-2 lg:w-[500px]"
          >
            <li v-for="component in components" :key="component.title">
              <NavigationMenuLink as-child>
                <a
                  :href="component.href"
                  class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground"
                >
                  <div class="text-sm font-medium leading-none">
                    {{ component.title }}
                  </div>
                  <p
                    class="line-clamp-2 text-sm leading-snug text-muted-foreground"
                  >
                    {{ component.description }}
                  </p>
                </a>
              </NavigationMenuLink>
            </li>
          </ul>
        </NavigationMenuContent>
      </NavigationMenuItem>
    </NavigationMenuList>
  </NavigationMenu>
  <DropdownMenu>
    <DropdownMenuTrigger>
      <Avatar>
        <AvatarImage :src="`${baseUrl}user/${user.photo}`" alt="@radix-vue" />
        <AvatarFallback>My Profile</AvatarFallback>
      </Avatar>
    </DropdownMenuTrigger>
    <DropdownMenuContent class="shadow-2xl">
      <DropdownMenuLabel>{{ user.name }}</DropdownMenuLabel>
      <DropdownMenuSeparator />
      <DropdownMenuItem>
        <router-link to="/setting">Profile</router-link>
      </DropdownMenuItem>
      <DropdownMenuItem>Billing</DropdownMenuItem>
      <DropdownMenuItem>
        <ThemeToggle />
      </DropdownMenuItem>
      <DropdownMenuSeparator />
      <DropdownMenuItem @click="logout">Logout</DropdownMenuItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
