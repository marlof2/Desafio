import api from "../_api";

const authenticate = async (context, object) => {
  const result = await api.authenticate(object);
  context.commit("AUTHENTICATED", result);
};

const permissoes = async (context, id) => {
  const result = await api.permissoes(id);
  context.commit("PERMISSOES", result);
};


const logout = async (context) => {
  const result = await api.logout();
  if (result) {
    context.commit("AUTHENTICATED", []);
  }
  return result;
};

export default {
  authenticate,
  permissoes,
  logout,
};
