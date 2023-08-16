import cryptografia from "../seguranca"

const mixinCheckPermission = {
  check(codigo) {
    if (!JSON.parse(cryptografia.descryptografar(localStorage.getItem("permissions")).includes(codigo))) {
      return false
    } else {
      return true
    }
  }
}

export default mixinCheckPermission;
