import Vue from "vue";

Vue.filter("jsonformat", (value) => {
  if (!value) return null;
  return JSON.stringify(value, null, 2);
});
