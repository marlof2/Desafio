import Vue from "vue";
import moment from "moment";

Vue.filter("formatdatexml", (date) => {
  if (!date) return null;
  const data = new Date(
    date.replace(/^(\d{4})(\d\d)(\d\d)(\d\d)(\d\d)(\d\d)$/, "$4:$5:$6 $2/$3/$1")
  );
  return  moment(data).format("DD/MM/YYYY HH:mm:ss");
});
