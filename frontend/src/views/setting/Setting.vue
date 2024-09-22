<script setup lang="ts">
import Layout from "@/components/app/Layout.vue";
import Profile from "./components/Profile.vue";
import Password from "./components/Password.vue";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Separator } from "@/components/ui/separator";
</script>

<template>
  <div class="container my-2 xl:mt-12 mb-24">
    <Layout>
      <Card>
        <CardHeader>
          <CardTitle>Settings</CardTitle>
          <CardDescription>Manage your profile setting.</CardDescription>
          <Separator />
        </CardHeader>
        <CardContent>
          <Tabs default-value="profile" class="flex flex-row">
            <div class="basis-1/4 p-2">
              <TabsList class="flex flex-col h-full justify-start">
                <TabsTrigger value="profile" class="w-full justify-start">
                  Profile
                </TabsTrigger>
                <TabsTrigger value="password" class="w-full justify-start">
                  Password
                </TabsTrigger>
              </TabsList>
            </div>
            <div class="basis-3/4 pb-2">
              <TabsContent value="profile">
                <!--  -->
                <Profile />
              </TabsContent>
              <TabsContent value="password"> <Password /> </TabsContent>
            </div>
          </Tabs>
        </CardContent>
      </Card>
    </Layout>
  </div>
</template>
