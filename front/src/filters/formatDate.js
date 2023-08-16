const newDate = new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
.toISOString()
.substr(0, 10);

const formatDate = (date) => {
  if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
}
const formatDateDB = (date) => {
  if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${year}/${month}/${day}`;
}
const formatDateMonth = (date) => {
  if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${month}/${year}`;
}
export default {
  newDate,
  formatDate,
  formatDateMonth,
  formatDateDB,
}
