<template>
  <v-app>
    <Overlay v-if="requestPending" />
    <v-app-bar color="primary" dark absolute class="">
      <v-app-bar-nav-icon
        @click="drawer = true"
        v-if="hidden()"
      ></v-app-bar-nav-icon>
      <v-toolbar-title>Desafio</v-toolbar-title>
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" absolute temporary v-if="hidden()">
      <v-list>
        <router-link
          v-for="(item, index) in items"
          :key="index"
          :to="item.link"
        >
          <v-list-item>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item>
        </router-link>
        <v-list-item @click="logout()">
          <v-list-item-title>Sair</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-container class="d-flex justify-center mt-10">
      <v-main class="mt-10">
        <router-view />
      </v-main>
    </v-container>
  </v-app>
</template>

<script>
import Button from "./components/UI/Button.vue";
import storeRequest from "@/modules/request/_store";
import storeLogin from "@/modules/login/_store";
import Overlay from "./components/UI/Overlay.vue";
import { mapActions, mapGetters } from "vuex";
export default {
  name: "App",
  components: {
    Button,
    Overlay,
  },
  created() {},
  methods: {
    ...mapActions({
      logout: "$_login/logout",
    }),
    hidden() {
      if (localStorage.getItem("token") === null) {
        return false;
      }
      return true;
    },
  },
  data: () => ({
    drawer: false,
    items: [
      {
        title: "Página inicial",
        link: "/pagina-inicial",
      },
      {
        title: "Usuário",
        link: "/usuario",
      },
      {
        title: "Endereço",
        link: "/endereco",
      },
      {
        title: "Perfil",
        link: "/papel",
      },
    ],
  }),
  computed: {
    ...mapGetters({
      requestPending: "$_request/requestsPending",
    }),
  },
  beforeCreate() {
    const STORE_REQUEST = "$_request";
    if (!(STORE_REQUEST in this.$store._modules.root._children))
      this.$store.registerModule(STORE_REQUEST, storeRequest);
    const STORE_LOGIN = "$_login";
    if (!(STORE_LOGIN in this.$store._modules.root._children))
      this.$store.registerModule(STORE_LOGIN, storeLogin);
  },
};
</script>
<style scoped>
a {
  text-decoration: none;
}
</style>
