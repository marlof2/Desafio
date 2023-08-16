<template>
  <div>
    <span>
      {{ label }}<span v-if="required" class="red--text text-h6"> *</span></span
    >
    <v-menu
      ref="timePickerMenu"
      v-model="timePickerMenu"
      :close-on-content-click="false"
      :nudge-right="40"
      transition="scale-transition"
      offset-y
      max-width="290px"
      min-width="290px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-model="localValue"
          readonly
          v-bind="attrs"
          v-on="on"
          clearable
          outlined
          dense
          :rules="rules"
          :disabled="disabled"
        ></v-text-field>
      </template>
      <v-time-picker
        v-if="timePickerMenu"
        v-model="localValue"
        full-width
        @click:minute="$refs.timePickerMenu.save(localValue)"
        format="24hr"
        :disabled="disabled"
      ></v-time-picker>
    </v-menu>
  </div>
</template>
<script>
export default {
  name: "DatePicker",
  props: {
    value: {
      type: [String, Date],
      default: null,
    },
    rules: {
      type: Array,
      default: () => [],
    },
    required: {
      type: Boolean,
      default: false,
    },
    label: {
      type: String,
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      timePickerMenu: false,
    };
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
  watch: {
    date(val) {
      this.dateFormatted = dateFilter.formatDate(val);
    },
  },
};
</script>
