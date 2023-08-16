import Vue from "vue";
import moment from "moment";
Vue.filter("hourformat", (hour) => {
  if (!hour) return "";
  return moment(hour, 'HHmmss').format("H:mm:ss")
});
