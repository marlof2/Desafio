export default [
  {
    path: "/usuario",
    name: "usuario",
    component: () => import("@/modules/usuario"),
  },
  {
    path: "/usuario/cadastrar",
    name: "usuario-cadastrar",
    component: () => import("@/modules/usuario/_components/form"),
  },
  {
    path: "/usuario/editar/:id",
    name: "usuario-editar",
    component: () => import("@/modules/usuario/_components/form"),
  },
  {
    path: "/usuario/detalhar/:id",
    name: "usuario-detalhar",
    component: () => import("@/modules/usuario/_components/form"),
  },
];
