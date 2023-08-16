const routeMain = "userendereco";

let state = {};

state[routeMain] = [];
state[`${routeMain}ById`] = [];


const paginate = {
  totalPages: 0,
  page: 1,
  lastPage: null,
  perPages: 15,
};


export const constants = {
  routeMain,
  state,
  paginate,
};
