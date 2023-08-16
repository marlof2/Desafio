const routeMain = "endereco";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];


const form = {
  id: null,
  logradouro: null,
  cep: null,
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
    text: "Endereço",
    disabled: false,
    href: "#",
  },
  {
    text: "Início",
  },
];


const breadcrumbsForm = [
  {
    text: "Endereço",
    disabled: false,
    to: "/endereco",
    exact: true,
  },
  {
    text: "Cadastrar",
  },
];

const breadcrumbsShow = [
  {
    text: "endereco",
    disabled: false,
    to: "/endereco",
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
  { text: "LOGRADOURO", value: "logradouro", align: "left" },
  { text: "CEP", value: "cep", align: "left" },
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
