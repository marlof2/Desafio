<template>
  <v-btn
    :color="'primary'"
    :to="to ? to : `${currentRoutePath}/cadastrar`"
  >
    {{ label ? label : "Adicionar" }}
    <v-icon v-if="!notIcon" size="22" class="pl-2">mdi-plus</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: "AddButton",
  props: {
    currentRoutePath: String,
    label: String,
    to: null,
    notIcon: Boolean,
  },
};
</script>
