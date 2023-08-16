import Vue from 'vue'

Vue.filter('rg', (number) => {
  number = number.replace(/\D/g,""); 
  number =number.replace(/(\d{2})(\d{3})(\d{3})(\d{2})$/,"$1.$2.$3-$4"); 


  return number;
})
