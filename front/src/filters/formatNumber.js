import Vue from "vue";
Vue.filter("formatnumber", function (value) {
  if (!value) {
    return 0;
  }
  return Number(value).toLocaleString();
});

Vue.filter("formatNumberField", function (value) {
  let val = (value / 1);
  return `${val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`;
});

export function formatNumberField(value) {
  let val = (value / 1);
  return `${val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}`;
}
