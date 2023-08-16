const setPending = async (context, value) => {
  context.commit("STORE_REQUETS_PENDING", value);
};


export default {
  setPending
};
