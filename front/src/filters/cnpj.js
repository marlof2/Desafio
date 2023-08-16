import Vue from 'vue'

Vue.filter('cnpj', (number) => {
  number = typeof number != 'string' ? number.toString() : number;
  number = number.replace(/\D/g,""); 
  number = number.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');

  return number;
})
