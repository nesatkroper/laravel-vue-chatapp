<script setup lang="ts">
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
</script>

<template>
  <Card>
    <CardHeader>
      <CardTitle>Account</CardTitle>
      <CardDescription>
        Change your account setting here. After saving, you'll be logged out.
      </CardDescription>
    </CardHeader>
    <CardContent class="space-y-2">
      <div class="space-y-1">
        <Label for="current">Current password</Label>
        <Input id="current" type="password" />
      </div>
      <div class="space-y-1">
        <Label for="new">New password</Label>
        <Input id="new" type="password" />
      </div>
    </CardContent>
    <CardFooter>
      <Button>Save password</Button>
    </CardFooter>
  </Card>
</template>
