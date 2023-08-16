// import dataName from "../../solicitacao_processo/_api/dataNameToPair";

const setErrors = async (context, errors) => {
  context.commit("SET_ERRORS", errors);
};

const destroyErrors = async context => {
  context.commit("SET_ERRORS", []);
};

// const setErrorsNotAcceptable = async (context, data) => {
//   let errors = {
//     title: "ERRO DE PREENCHIMENTO",
//     type: "error",
//     errors: []
//   };

  // Object.entries(data).forEach(async element => {
  //   let feature = element[0].split(".");
  //   // const indexField = (feature.length - 1);
  //   // const nameField = dataName[feature[indexField]] !== undefined ? dataName[feature[indexField]] : '';

  //   // errors.errors.push({
  //   //   feature: feature[0],
  //   //   field: feature.length > 1 ? `${feature[0]} - ${nameField}` : feature[0],
  //   //   referenceId: feature.length > 1 ? feature[indexField] : feature[0],
  //   //   type: element[1]
  //   // });
  // });
//   errors.message = `${errors.errors.length} campo(s) não preenchido(s). Clique no(s) item(ns) da listagem para alcança-lo(s) e corrigí-lo(s).`;
//   context.commit("SET_ERRORS", errors);
// };


export default {
  setErrors,
  destroyErrors,
  // setErrorsNotAcceptable
};
