<script setup lang="ts">
import {
  ResizableHandle,
  ResizablePanel,
  ResizablePanelGroup,
} from "@/components/ui/resizable";
import { Button } from "@/components/ui/button";
import HomeSearchContact from "@/views/home/components/HomeSearchContact.vue";
import HomeAddContact from "@/views/home/components/HomeAddContact.vue";
import { Dialog, DialogTrigger } from "@/components/ui/dialog";
</script>

<template>
  <div>
    <ResizablePanelGroup direction="horizontal">
      <ResizablePanel :default-size="25">
        <div class="h-[90vh] p-3">
          <HomeSearchContact />
          <!--  -->
          <Dialog>
            <DialogTrigger>
              <Button class="absolute bottom-[65px] start-[80px]">+</Button>
            </DialogTrigger>
            <HomeAddContact />
          </Dialog>
        </div>
      </ResizablePanel>
      <ResizableHandle with-handle />
      <ResizablePanel>
        <div class="h-[90vh]"></div>
      </ResizablePanel>
    </ResizablePanelGroup>
  </div>
</template>
