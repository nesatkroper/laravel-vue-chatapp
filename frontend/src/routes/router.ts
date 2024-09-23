import { createRouter, createWebHistory } from "vue-router";
import { ref } from "vue";
import NotFound from "@/views/404/NotFound.vue";
const routes = [
  {
    path: "/register",
    component: () => import("@/views/auth/Register.vue"),
    name: "register",
  },
  {
    path: "/login",
    component: () => import("../views/auth/Login.vue"),
    name: "login",
  },
  {
    path: "/",
    component: () => import("@/views/home/Home.vue"),
    name: "home",
    meta: { requiresAuth: true },
  },
  {
    path: "/setting",
    component: () => import("@/views/setting/Setting.vue"),
    name: "profile",
    meta: { requiresAuth: true },
  },
  {
    path: "/:pathMatch(.*)*",
    component: NotFound,
    name: "404",
    meta: { requiresAuth: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("auth_token");

  const action = ref(false);
  if (token != null) action.value = true;

  if (to.matched.some((record) => record.meta.requiresAuth) && !token) {
    next("/login");
  } else if ((to.name == "login" || to.name == "register") && token) {
    next("/");
  } else {
    next();
  }
});

export default router;
