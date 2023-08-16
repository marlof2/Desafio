import Vue from 'vue'

Vue.filter('cep', (number) => {
  number = typeof number != 'string' ? number.toString() : number;
  number = number.replace(/\D/g,"");
  number = number.replace(/^(\d{2})(\d{3})(\d{3})/, '$1.$2-$3');

  return number;
})
