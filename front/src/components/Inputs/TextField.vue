<template>
  <div>
    <label
      >{{ label
      }}<span v-if="required" style="fontsize: 14px" class="red--text">
        *</span
      ></label
    >
    <v-text-field
      :rules="rules"
      dense
      outlined
      clearable
      v-model="localValue"
      :maxlength="maxlength"
      :disabled="disabled"
      :type="type"
      :placeholder="placeholder"
    ></v-text-field>
  </div>
</template>
<script>
export default {
  name: "TextField",
  props: {
    rules: {
      type: Array,
      default: () => [],
    },
    label: {
      type: String,
      default: "",
    },
    value: {
      type: [String, Number],
      default: "",
    },
    required: {
      type: Boolean,
      default: false,
    },
    maxlength: {
      type: Number,
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    type: {
      type: String,
      default: 'text',
    },
    placeholder: {
      type: String,
      default: undefined,
    },
  },
  mounted(){
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
