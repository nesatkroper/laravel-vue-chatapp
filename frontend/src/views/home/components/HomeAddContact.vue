<script setup lang="ts">
import { ref } from "vue";
import axios from "@/config/axios";
import type { ContactList } from "@/types/ContactList";
import {
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

const contact: any = ref<ContactList[]>([]);

const handleAddContact = async () => {
  if (contact.value.phone == undefined || contact.value.nickname == undefined) {
    alert("Please enter a phone number");
  } else {
    try {
      const response = await axios.post("/contact.add", {
        //
      });
      console.log(contact.value.phone);
    } catch (e) {
      console.error(e);
    }
  }
};
</script>

<template>
  <DialogContent class="w-[400px]">
    <form @submit.prevent="handleAddContact">
      <DialogHeader>
        <DialogTitle>Add New Contact Number</DialogTitle>
        <DialogDescription>
          <div class="grid w-full items-center gap-1.5 my-4">
            <Label>Phone Number</Label>
            <div class="flex">
              <Input
                type="text"
                placeholder="+855"
                class="w-[60px] me-1"
                disabled
              />
              <Input
                v-model="contact.phone"
                type="number"
                placeholder="012 123 456"
              />
            </div>
          </div>
          <div class="grid w-full items-center gap-1.5 my-4">
            <Label for="email">Contact Name</Label>
            <Input
              v-model="contact.nickname"
              type="text"
              placeholder="nickname"
            />
            <p>{{ contact.nickname }}</p>
          </div>
        </DialogDescription>
      </DialogHeader>
      <DialogClose>
        <Button type="submit">Add Contact</Button>
      </DialogClose>
    </form>
  </DialogContent>
</template>
