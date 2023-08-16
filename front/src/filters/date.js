import moment from "moment";

//retorna o primeiro dia do mês anterior ao atual
export const firstDayOfLastMonth = () => {
  return moment()
    .year(new Date().getFullYear())
    .month(new Date().getMonth() - 1)
    .startOf("month")
    .format("YYYY-MM-DD");
};

//retorna o último dia do mês anterior ao atual
export const lastDayOfLastMonth = () => {
  return moment()
    .year(new Date().getFullYear())
    .month(new Date().getMonth() - 1)
    .endOf("month")
    .format("YYYY-MM-DD");
};
