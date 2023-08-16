const AUTHENTICATED = (state, authenticated) => {
  
  state.authenticated = authenticated;
};

const PERMISSOES = (state, permissoes) => {
  state.permissoes = permissoes;
};

export default {
  AUTHENTICATED,
  PERMISSOES,
};
