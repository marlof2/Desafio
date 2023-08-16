const routeMain = "users";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];


const form = {
  id: null,
  name: null,
  cpf: null,
  email: null,
  papel_id: null,
  enderecos:[]
};

const permissions = {
  incluir: "",
  alterar: "",
  excluir: "",
  visualizar: "",
  listar: "",
};

const breadcrumbsIndex = [
  {
    text: "Usuário",
    disabled: false,
    href: "#",
  },
  {
    text: "Início",
  },
];


const breadcrumbsForm = [
  {
    text: "Usuário",
    disabled: false,
    to: "/usuario",
    exact: true,
  },
  {
    text: "Cadastrar",
  },
];

const breadcrumbsShow = [
  {
    text: "usuario",
    disabled: false,
    to: "/usuario",
    exact: true,
  },
  {
    text: "Visualizar",
  },
];


const paginate = {
  totalPages: 0,
  page: 1,
  lastPage: null,
  perPages: 15,
};

const headers = [
  { text: "NOME", value: "name", align: "left" },
  { text: "DATA CADASTRO", value: "created_at", align: "left" },
  { text: "CPF", value: "cpf", align: "left" },
  { text: "EMAIL", value: "email", align: "left" },
  { text: "PEFIL", value: "papel.nome", align: "left" },
  { text: "AÇÃO", value: "acao" },
];

const customItemsProp = [
  {
    id: 1,
    name: "data",
    filter: "dateformat",
  },
];

export const constants = {
  routeMain,
  state,
  form,
  permissions,
  breadcrumbsIndex,
  paginate,
  headers,
  breadcrumbsForm,
  breadcrumbsShow,
  customItemsProp,
};
