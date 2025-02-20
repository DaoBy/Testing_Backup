<script setup>
defineProps({
  modelValue: [String, Number], // Supports both string and number values
  options: {
    type: Array,
    required: false,
    default: () => []
  }
});

const emit = defineEmits(["update:modelValue"]);
</script>

<template>
  <select
    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full p-2"
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
  >
    <option value="" disabled>Select an option</option>
    <option v-for="option in options" :key="option" :value="option">
      {{ option }}
    </option>
  </select>
</template>
