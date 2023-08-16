import Vue from "vue";
import moment from "moment";

Vue.filter("formatdatehour", (date) => {
  if (!date) return null;

  return moment(date).format("DD-MM-YYYY HH:mm:ss");
});

Vue.filter("formatdatebr", (date) => {
  if (!date) return null;

  return moment(date).format("DD/MM/YYYY");
});

Vue.filter("formatDateHourBR", (date) => {
  if (!date) return null;

  if (date.length) {
    let _fullDate = null;

    if (date.includes("-")) {
      const [year, month, day] = date.slice(0, 10).split("-");
      _fullDate = new Date(year, month - 1, day);
    }
    if (date.includes("/")) {
      const [day, month, year] = date.slice(0, 10).split("/");
      _fullDate = new Date(year, month - 1, day);
    }

    const [hh, mm] = date.slice(11).split(":");

    const formatedDate = moment(_fullDate).format("DD/MM/YYYY");
    return `${formatedDate} às ${hh}:${mm}`;
  }

  const _date = moment(date).format("DD/MM/YYYY");
  const hour = moment(date).format("HH:mm:ss");
  return `${_date} às ${hour}`;
});

Vue.filter("formatYMDH", (date) => {
  if (!date) return null;

  return moment(date).format("YYYY-MM-DD HH:mm");
});

export function formatYMDH(date) {
  if (!date) return null;
  if (date.length) {
    const [day, month, year] = date.slice(0, 10).split("/");
    const [hh, mm] = date.slice(11).split(":");

    const _date = new Date(year, month - 1, day, hh, mm);

    return moment(_date).format("YYYY-MM-DD HH:mm");
  }
  return moment(date).format("YYYY-MM-DD HH:mm");
}

export function formatDateAndHour(date) {
  if (!date) return null;
  return moment(date).format("DD/MM/YYYY HH:mm");
}

export function formatDateHourBR(date) {
  if (!date) return null;

  if (date.length) {
    let _fullDate = null;

    if (date.includes("-")) {
      const [year, month, day] = date.slice(0, 10).split("-");
      _fullDate = new Date(year, month - 1, day);
    }
    if (date.includes("/")) {
      const [day, month, year] = date.slice(0, 10).split("/");
      _fullDate = new Date(year, month - 1, day);
    }

    const [hh, mm] = date.slice(11).split(":");

    const formatedDate = moment(_fullDate).format("DD/MM/YYYY");
    return `${formatedDate} às ${hh}:${mm}`;
  }

  const _date = moment(date).format("DD/MM/YYYY");
  const hour = moment(date).format("HH:mm:ss");
  return `${_date} às ${hour}`;
};
