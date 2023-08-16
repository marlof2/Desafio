export default [
  {
    path: "/endereco",
    name: "endereco",
    component: () => import("@/modules/endereco"),
  },
  {
    path: "/endereco/cadastrar",
    name: "endereco-cadastrar",
    component: () => import("@/modules/endereco/_components/form"),
  },
  {
    path: "/endereco/editar/:id",
    name: "endereco-editar",
    component: () => import("@/modules/endereco/_components/form"),
  },
  {
    path: "/endereco/visualizar/:id",
    name: "endereco-visualizar",
    component: () => import("@/modules/endereco/_components/show"),
  },
];
