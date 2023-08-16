<template>
  <div>
    <span>
      {{ label
      }}<span v-if="required" style="font-size: 14px" class="red--text">
        *</span
      ></span
    >
    <v-select
      :rules="rules"
      :items="items"
      v-model="localValue"
      :item-text="itemText"
      :item-value="itemValue"
      dense
      outlined
      :clearable="clearable"
      :disabled="disabled"
      :return-object="returnObject"
      @change="change"
      :multiple="multiple"
    >
    </v-select>
  </div>
</template>
<script>
export default {
  name: "Select",
  props: {
    label: {
      type: String,
      default: "",
    },
    items: {
      type: [Array, Object],
      default: () => [],
    },
    itemText: {
      type: [String, Function],
      default: "",
    },
    itemValue: {
      type: [String, Number, Boolean, Array, Object],
      default: null,
    },
    required: {
      type: Boolean,
      default: false,
    },
    rules: {
      type: Array,
      default: () => [],
    },
    value: {
      type: [String, Number, Boolean, Array, Object],
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    returnObject: {
      type: Boolean,
      default: false,
    },
    multiple: {
      type: Boolean,
      default: false,
    },
    change: {
      type: Function,
      default: () => {},
    },
    clearable: {
      type: Boolean,
      default: true,
    },
  },
  computed: {
    localValue: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },
};
</script>
<style></style>
