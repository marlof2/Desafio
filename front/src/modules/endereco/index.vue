<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Endereço</div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2 elevation-2">
      <HeaderGeneric class="mb-3">
        <template v-slot:addButton>
          <v-row class="">
            <v-col cols="12" sm="12" md="6">
              <AddButton :currentRoutePath="$router.currentRoute.path" />
            </v-col>
          </v-row>
        </template>
        <template v-slot:buttons>
          <v-col cols="12" sm="12" md="6">
            <v-text-field
              v-model="buscar"
              append-icon="mdi-magnify"
              @click:append="search"
              @keyup.enter="search"
              hide-details
              dense
              clearable
              outlined
              placeholder="Buscar"
            ></v-text-field>
          </v-col>
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
        :colunmCustom="['cep']"
      >
        <template v-slot:cep="{ item }">
          {{ item.cep | cep}}
        </template>
        <template v-slot:customColumn="{ item }">
          <IconButton
            :onClick="() => navigateToEdit(item)"
            :name="'mdi-square-edit-outline'"
            :tooltipName="'Editar'"
            :btnColor="'green'"
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

export default {
  components: {
    Breadcrumbs,
    DataTableGeneric,
    HeaderGeneric,
    IconButton,
    AddButton,
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
      buscar: null,
    };
  },
  beforeCreate() {
    const STORE_ENDERECO = "$_endereco";
    if (!(STORE_ENDERECO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_ENDERECO, store);
  },
  async mounted() {
    await this.search();
  },
  computed: {
    ...mapGetters({
      getItemsFeriados: "$_endereco/getItems",
    }),
  },
  methods: {
    ...mapActions({
      getEndereco: "$_endereco/getItems",
      deleteItem: "$_endereco/deleteItem",
    }),
    async handlePageChange(paginate) {
      return await this.getEndereco({
        search: this.buscar,
        page: paginate.page,
        per_page: paginate.perPages,
      });
    },
    async search() {
      await this.getEndereco({ search: this.buscar, });
    },
    navigateToEdit(item) {
      return this.$router.push({
        name: "endereco-editar",
        params: {id:item.id},
      });
    },
    deleteItemTable(item) {
      Swal.deleteMessage(`${item.logradouro}`).then(async (result) => {
        if (result.isConfirmed) {
          const resp = await this.deleteItem(item.id);
          if (!resp) return false;
          await this.getEndereco();
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
