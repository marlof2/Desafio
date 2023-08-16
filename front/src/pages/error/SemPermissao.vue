<template>
  <v-card class="text-center w-full error-page pa-3">
    <div class="display-2 mt-10">
      Usuário sem permissão para acessar essa funcionalidade.
    </div>
    <div class="mt-3 mb-10">
      Se precisar acessar esta funcionalidade contate o administrador do
      sistema.
    </div>
    <v-btn
      @click="() => this.$router.push({ name: 'pagina-inicial' })"
      block
      large
      color="primary"
      >Voltar para o início</v-btn
    >
  </v-card>
</template>

<style>
.error-page {
  max-width: 500px;
}
</style>
