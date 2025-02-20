<script setup>
import { ref, computed, onMounted } from 'vue'
import { useApi } from '../composables/useApi';
import IndexItem from './IndexItem.vue'

const { data, get, getOne, post, put, del } = useApi();

const filterBy = ref('');

onMounted(() => {
  get();
})

const filteredData = computed(() => {
  return filterBy.value
    ? data.rows.filter((item) => item.id.includes(filterBy.value))
    : data.rows;
});

function loadItem(item) {
  window.scrollTo(0, 0);
  getOne(item);
}

function updateItem() {
  let item = data.rows.find((item) => item.id === data.item.id);
  if (item) {
    put(data.item);
  } else {
    post(data.item);
  }
  data.item = {};
}

function deleteItem(item) {
  if (confirm('Are you sure you want to delete this item?')) {
    del(item);
  }
}

</script>

<template>
  <div v-if="data.rows.length">
    <div>
      {{ data.message }}
    </div>
    <div style="margin-bottom: 25px;">
      <form @submit.prevent="updateItem">
        <div style="margin-bottom: 25px;">
          <input v-model="filterBy" placeholder="Filter ...">
        </div>
        <div>
          <input v-model="data.item.id" placeholder="ID" required>
        </div>
        <div>
          <input v-model="data.item.name" placeholder="Name">
        </div>
        <div>
          <input v-model="data.item.technology" placeholder="Technology">
        </div>
        <div>
          <input v-model="data.item.docker" placeholder="Docker">
        </div>
        <div>
          <input v-model="data.item.port" placeholder="Ports">
        </div>
        <div>
          <input v-model="data.item.url" placeholder="Url">
        </div>
        <div>
          <button>Update</button>
        </div>
      </form>
    </div>
    <div>
      <ul style="list-style: none; padding: 0; margin: 0;">
        <template v-for="item in filteredData" :key="item.id">
          <IndexItem :item="item" @delete-item="deleteItem" @load-item="loadItem" />
        </template>
      </ul>
    </div>
  </div>
  <div v-else>
    <h1>Oh no ... there is no data 😢</h1>
  </div>

</template>

<style scoped></style>
