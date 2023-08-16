<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Usuários</div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2 mb-5 elevation-2">
      <v-card-title primary-title> Filtro </v-card-title>
      <div class="pa-5">
        <v-row>
          <v-col cols="12" sm="12" md="3">
            <TextField v-model="name" :label="'Nome'" :maxlength="100" />
          </v-col>
          <v-col cols="12" sm="12" md="3">
            <TextField v-model="cpf" :label="'CPF'" v-mask="'###.###.###-##'" />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="12" md="3">
            <TextField
              v-model="data_inicio"
              :label="'Data Inicial'"
              :type="'date'"
            />
          </v-col>
          <v-col cols="12" sm="12" md="3">
            <TextField
              v-model="data_fim"
              :label="'Data final'"
              :type="'date'"
            />
          </v-col>
        </v-row>

        <v-row>
          <v-col>
            <Button
              :label="'Filtrar'"
              :color="'grey'"
              :onClick="
                () => {
                  search();
                }
              "
            />
          </v-col>
        </v-row>
      </div>
    </v-card>
    <v-card class="pa-2 elevation-2">
      <HeaderGeneric class="mb-3">
        <template v-slot:addButton>
          <v-row class="">
            <v-col cols="12" sm="12" md="6">
              <AddButton
                :currentRoutePath="$router.currentRoute.path"
                :disabled="disabledFilds"
              />
            </v-col>
          </v-row>
        </template>
      </HeaderGeneric>
      <DataTableGeneric
        :headersProp="headers"
        :dataProp="items"
        :lastPageProp="paginate.lastPage"
        :pageProp="paginate.page"
        :itemsPerPageProp="paginate.perPages"
        @handlePageChange="handlePageChange"
        @handleSearch="search"
        :customItemsProp="customItemsProp"
        :customColumn="'acao'"
        :showSelectPagination="false"
        :colunmCustom="['created_at', 'cpf']"
      >
        <template v-slot:created_at="{ item }">
          {{ item.created_at | formatdatebr }}
        </template>
        <template v-slot:cpf="{ item }">
          {{ item.cpf | cpf }}
        </template>
        <template v-slot:customColumn="{ item }">
          <IconButton
            :onClick="() => navigateToEdit(item)"
            :name="'mdi-square-edit-outline'"
            :tooltipName="'Editar'"
            :btnColor="'grey'"
          />
          <IconButton
            :onClick="() => detalhar(item)"
            :name="'mdi-text-account'"
            :tooltipName="'Detalhar'"
            :btnColor="'blue'"
          />
          <IconButton
            :onClick="() => deleteItemTable(item)"
            :name="'mdi-delete-outline'"
            :tooltipName="'Deletar'"
            :btnColor="'red'"
          />
        </template>
      </DataTableGeneric>
    </v-card>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import store from "./_store";
import Breadcrumbs from "../../components/UI/Breadcrumbs.vue";
import DataTableGeneric from "../../components/UI/DataTableGeneric.vue";
import HeaderGeneric from "../../components/UI/HeaderGeneric.vue";
import IconButton from "../../components/UI/IconButton.vue";
import AddButton from "../../components/UI/AddButton.vue";
import { constants } from "./_constants";
import TextField from "@/components/Inputs/TextField.vue";
import Button from "@/components/UI/Button.vue";

export default {
  components: {
    Breadcrumbs,
    DataTableGeneric,
    HeaderGeneric,
    IconButton,
    AddButton,
    TextField,
    Button,
  },
  data() {
    return {
      breadcrumbs: [...constants.breadcrumbsIndex],
      customItemsProp: [...constants.customItemsProp],
      headers: [...constants.headers],
      paginate: {
        ...constants.paginate,
      },
      permissions: { ...constants.permissions },
      items: [],
      name: null,
      cpf: null,
      data_inicio: null,
      data_fim: null,
    };
  },
  beforeCreate() {
    const STORE_USUARIO = "$_usuario";
    if (!(STORE_USUARIO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USUARIO, store);
  },
  async mounted() {
    await this.search();
  },
  computed: {
    ...mapGetters({
      getItemsFeriados: "$_usuario/getItems",
    }),
  },
  methods: {
    ...mapActions({
      getUsuario: "$_usuario/getItems",
      deleteItem: "$_usuario/deleteItem",
    }),
    disabledFilds() {
      return this.$route.name == "usuario-detalhar";
    },
    async handlePageChange(paginate) {
      if (this.cpf) {
        this.cpf = this.cpf.replace(/[()\ \s.-]+/g, "");
      }
      return await this.getUsuario({
        name: this.name,
        cpf: this.cpf,
        data_inicio: this.data_inicio,
        data_fim: this.data_fim,
        page: paginate.page,
        per_page: paginate.perPages,
      });
    },
    async search() {
      if (this.cpf) {
        this.cpf = this.cpf.replace(/[()\ \s.-]+/g, "");
      }
      await this.getUsuario({
        name: this.name,
        cpf: this.cpf,
        data_inicio: this.data_inicio,
        data_fim: this.data_fim,
      });
    },
    navigateToEdit(item) {
      return this.$router.push({
        path: this.$router.currentRoute.path + `/editar/${item.id}`,
      });
    },
    detalhar(item) {
      return this.$router.push({
        name: "usuario-detalhar",
        params: { id: item.id },
      });
    },
    deleteItemTable(item) {
      Swal.deleteMessage(`${item.name}`).then(async (result) => {
        if (result.isConfirmed) {
          const resp = await this.deleteItem(item.id);
          if (!resp) return false;
          await this.getUsuario();
          Swal.message(resp.data.success);
        }
      });
    },
  },
  watch: {
    getItemsFeriados(value) {
      this.items = value.data;
      this.paginate.totalPages = value.total;
      this.paginate.page = value.current_page;
      this.paginate.lastPage = value.last_page;
    },
  },
};
</script>
