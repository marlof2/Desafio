import Vue from "vue";
import Router from "vue-router";
import Jwt from "../api/jwt";

// Routes
import LoginRoutes from "@/modules/login/_routes";
import UsuarioRoutes from "@/modules/usuario/_routes";
import EnderecoRoutes from "@/modules/endereco/_routes";
import PapelRoutes from "@/modules/papel/_routes";

Vue.use(Router);

export const routes = [
  ...LoginRoutes,
  ...UsuarioRoutes,
  ...EnderecoRoutes,
  ...PapelRoutes,

  {
    path: "/",
    redirect: "/autenticar",
  },
  {
    path: "/pagina-inicial",
    name: "pagina-inicial",
    component: () => import("@/modules/index.vue"),
  },
  {
    path: "*",
    name: "error",
    component: () => import("@/pages/error/NotFoundPage.vue"),
    meta: {
      layout: "error",
    },
  },
];

const router = new Router({
  mode: "history",
  base: process.env.BASE_URL || "/",
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) return savedPosition;

    return { x: 0, y: 0 };
  },
  routes,
});

/**
 * Before each route update
 */
router.beforeEach((to, from, next) => {
  if (to.name === "autenticar" && Jwt.getToken()) {
    return next("pagina-inicial");
  }
  if (to.name !== "autenticar" && !Jwt.getToken()) {
    window.localStorage.clear()
    return next("autenticar");
  }

  return next();
});

/**
 * After each route update
 */
router.afterEach((to, from) => { });

export default router;
