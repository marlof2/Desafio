import Vue from "vue";
Vue.filter("formatTelefoneFixo", (telefone) => {
    const textoAtual = telefone;
    const parte1 = textoAtual.slice(0, 2);
    const parte2 = textoAtual.slice(2, 6);
    const parte3 = textoAtual.slice(6, 10);
    return `(${parte1}) ${parte2}-${parte3}`;
});
