<template>
  <v-col
    :class="classProp"
    :cols="cols"
    :sm="sm"
    :md="md"
    :offset-sm="offset_sm"
    :offset-md="offset_md"
  >
    <span class="data">
      <h4>{{ label }}</h4>
      <span v-if="isData">{{ data | dateformat }}</span>
      <span v-if="isDataWithHour">{{ data | formatdatehour }}</span>
      <span v-if="isDataWithHourBr">{{ data | formatDateHourBR }}</span>
      <span v-if="isRangedData"
        >{{ data.data_inicio | dateformat }} A
        {{ data.data_fim | dateformat }}</span
      >
      <span
        class="text-uppercase"
        v-if="
          data !== null &&
          typeof data != 'boolean' &&
          !isData &&
          !isRangedData &&
          !isMoney &&
          !isDataWithHourBr &&
          !isDataWithHour
        "
      >
        {{ data }}
      </span>
      <span
        class="text-uppercase"
        v-if="
          data !== null &&
          typeof data != 'boolean' &&
          !isData &&
          !isRangedData &&
          isMoney
        "
      >
        {{
          parseFloat(data)
            | formatCurrency({
              label: "REAL",
              decimalDigits: 2,
              decimalSeparator: ".",
              thousandsSeparator: ",",
              currencySymbol: this.prefixValue,
              currencySymbolNumberOfSpaces: 0,
              currencySymbolPosition: "left",
            })
        }}
      </span>
      <span v-if="data === false"> Não </span>
      <span v-if="data === true"> Sim </span>
    </span>
  </v-col>
</template>
<script>
export default {
  props: {
    label: {
      type: String,
      default: "",
    },
    data: {
      type: [String, Boolean, Number, Function, Date, Object],
      default: null,
    },
    isMoney: {
      type: Boolean,
      default: false,
    },
    prefixValue: {
      type: String,
      default: "R$ ",
    },
    cols: {
      type: Number,
      default: 12,
    },
    sm: {
      type: Number,
      default: 12,
    },
    md: {
      type: Number,
      default: 12,
    },
    offset_sm: {
      type: Number,
      default: 0,
    },
    offset_md: {
      type: Number,
      default: 0,
    },
    isData: {
      type: Boolean,
      default: false,
    },
    isDataWithHour: {
      type: Boolean,
      default: false,
    },
    isDataWithHourBr: {
      type: Boolean,
      default: false,
    },
    isRangedData: {
      type: Boolean,
      default: false,
    },
    classProp: {
      type: String,
      default: "py-2",
    },
  },
};
</script>
<style scoped>
h3 {
  font-weight: normal;
}
</style>
