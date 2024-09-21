// stores/auth.js (using Pinia as an example)
import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    isLoggedIn: false,
  }),
  actions: {
    login() {
      const action = localStorage.getItem("auth_token");
      if (action == null) this.isLoggedIn = true;
    },
    logout() {
      this.isLoggedIn = false;
    },
  },
});
