<script setup>
defineProps({
  item: Object
})
</script>

<template>
  <li style="border: 1px solid black; padding: 10px; margin: 0 10px 25px 0;">
    <div>
      {{ item.id }}
    </div>
    <div>
      {{ item.name }}
    </div>
    <div>
      {{ item.technology }}
    </div>
    <div>
      {{ item.docker }}
    </div>
    <div>
      {{ item.port }}
    </div>
    <div>
      {{ item.url }}
    </div>
    <div>
      <button @click="$emit('deleteItem', item)">Delete</button> <button @click="$emit('loadItem', item)">Edit</button>
    </div>
  </li>
</template>

<style scoped></style>
