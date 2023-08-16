import Vue from "vue";
Vue.filter("formatTelefone", (telefone) => {
    const textoAtual = telefone;
    const parte1 = textoAtual.slice(0, 2);
    const parte2 = textoAtual.slice(2, 7);
    const parte3 = textoAtual.slice(7, 11);
    return `(${parte1}) ${parte2}-${parte3}`;
});
