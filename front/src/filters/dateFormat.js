import Vue from "vue";
import moment from "moment";

Vue.filter("dateformat", (date) => {
  if (!date) return "";
  return moment(date).format("DD/MM/YYYY");
});

Vue.filter("dateFormatMonth", (date) => {
  if (!date) return "";
  return moment(date).format("MM/YYYY");
});
Vue.filter("formathourdate", (date) => {
  if (!date) return null;

  return moment(date).format("DD/MM/YYYY HH:mm:ss")
});
