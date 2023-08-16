<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Visualização de Feriado</div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2">
      <v-row class="pa-1">
        <ShowData
          :cols="12"
          :sm="12"
          :md="3"
          :label="'Data'"
          :data="form?.data  | dateformat"
        />
        <ShowData
          :cols="12"
          :sm="12"
          :md="3"
          :label="'Feriado'"
          :data="form?.descricao"
        />
      </v-row>

      <v-card-actions>
        <v-spacer></v-spacer>
        <FormButton
          :background="'secundary'"
          :label="'Voltar'"
          dark
          @click="$router.go(-1)"
        />
      </v-card-actions>
    </v-card>
  </div>
</template>
  <script>
import { mapActions, mapGetters } from "vuex";
import store from "../_store";
import { constants } from "../_constants";
import ShowData from "../../../components/UI/ShowData.vue";
import FormButton from "../../../components/UI/FormButton.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
export default {
  name: "feriadosShow",
  components: {
    FormButton,
    Breadcrumbs,
    ShowData,
  },
  beforeCreate() {
    const STORE_FERIADOS = "$_feriados";
    if (!(STORE_FERIADOS in this.$store._modules.root._children))
      this.$store.registerModule(STORE_FERIADOS, store);
  },
  data() {
    return {
      form: { ...constants.form },
      breadcrumbs: [...constants.breadcrumbsShow],
    };
  },
  async mounted() {
    await this.itemById(this.$route.params.id);
  },
  computed: {
    ...mapGetters({
      getItemById: "$_feriados/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_feriados/getItemById",
    }),
  },
  watch: {
    getItemById(item) {
      if (this.$route.params.id != undefined) {
        let keys = Object.keys(this.form);
        keys.forEach((i) => {
          this.form[i] = item[i];
        });
      }
    },
  },
};
</script>
  <style lang="scss" scoped></style>
  