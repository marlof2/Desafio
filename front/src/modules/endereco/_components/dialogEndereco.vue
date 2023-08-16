<template>
  <Dialog
    v-model="dialog"
    :maxWidth="'50vw'"
    :title="'Adicionar Endereço'"
    :closeClick="close"
    :showBtnCancel="false"
    :showBtnSave="false"
  >
    <v-container>
      <v-row>
        <v-col cols="12" sm="6">
          <TextField v-model="form.logradouro" :label="'Logradouro'" />
        </v-col>
        <v-col cols="12" sm="6">
          <TextField v-model="form.cep" :label="'CEP'" v-mask="'##.###-###'" />
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <Button
            :onClick="
              () => {
                buscarCidadao();
              }
            "
            :label="'Pesquisar'"
          />
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" sm="12" md="12">
          <DataTableGeneric
            :headersProp="headesEndereco"
            :dataProp="arrayEndereco"
            :customColumn="'acao'"
            :showSelectPagination="false"
            :colunmCustom="['cep']"
          >
            <template v-slot:cep="{ item }">
              {{ item.cep | cep }}
            </template>
            <template v-slot:customColumn="{ item }">
              <IconButton
                :onClick="() => addEndereco(item)"
                :name="'mdi-plus-circle'"
                :tooltipName="'Adicionar'"
                :btnColor="'green'"
              />
            </template>
          </DataTableGeneric>
        </v-col>
      </v-row>
    </v-container>
  </Dialog>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import store from "../_store";
import storeUserEndereco from "../../userEndereco/_store";
import Dialog from "../../../components/UI/Dialog.vue";
import Button from "../../../components/UI/Button.vue";
import TextField from "../../../components/Inputs/TextField.vue";
import DataTableGeneric from "../../../components/UI/DataTableGeneric.vue";
import IconButton from "../../../components/UI/IconButton.vue";

export default {
  components: {
    Dialog,
    Button,
    TextField,
    DataTableGeneric,
    IconButton,
  },
  props: {
    dialog: {
      type: Boolean,
      default: false,
    },
    closeClick: {
      type: Function,
      default: () => {},
    },
    user_id: {
      type: Number,
    },
  },
  data() {
    return {
      required: [(v) => !!v || "Campo obrigatório"],
      form: {
        logradouro: null,
        cep: null,
        user_id:null
      },
      headesEndereco: [
        { text: "Logradouro", value: "logradouro", align: "left" },
        { text: "Cep", value: "cep", align: "left" },
        { text: "AÇÃO", value: "acao" },
      ],
      arrayEndereco: [],
    };
  },
  async created() {
    this.form.user_id = this.user_id
  },
  computed: {
    ...mapGetters({
      getItemEndereco: "$_endereco/getItems",
    }),
  },
  methods: {
    ...mapActions({
      getEndereco: "$_endereco/getItems",
      createUserEndereco: "$_userEndereco/createItem",
      deleteUserEndereco: "$_userEndereco/deleteItem",
    }),
    disabledFilds() {
      return this.$route.name == "usuario-detalhar"
    },
    close() {
      this.closeClick();
      this.arrayEndereco = [];
    },
    async getEnderecoUser(data) {
      await this.getEndereco({
        logradouro: data.logradouro,
        cep: data.cep,
        limit: "-1",
        user_id: data.user_id,
      });
    },
    async buscarCidadao() {
      if (this.form.cep) {
        this.form.cep = this.form.cep.replace(/[()\ \s.-]+/g, "");
      }

      await this.getEnderecoUser(this.form);
    },
    async addEndereco(item) {
      const { status } = await this.createUserEndereco({
        user_id: this.form.user_id,
        endereco_id: item.id,
      });
      if (status == 201) {
        this.$emit("setData", { reload: true, user_id:this.form.user_id });
        await this.getEnderecoUser(this.form);
        Swal.messageToast("Adicionado com suesso.", "success");
      }
    },
  },
  beforeCreate() {
    const STORE_ENDERECO = "$_endereco";
    if (!(STORE_ENDERECO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_ENDERECO, store);
    const STORE_USER_ENDERECO = "$_userEndereco";
    if (!(STORE_USER_ENDERECO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER_ENDERECO, storeUserEndereco);
  },
  watch: {
    getItemEndereco(items) {
      this.arrayEndereco = items;
    },
  },
};
</script>

<style scoped></style>
