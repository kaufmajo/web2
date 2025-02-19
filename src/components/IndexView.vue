<script setup>
import { ref, computed, watch } from 'vue'
import { useApi } from '../composables/useApi';
import IndexItem from './IndexItem.vue'
//import appdata from './../../data/apps.json'

const { state, data, error, get, getOne } = useApi();
get('http://localhost:8889/api/get.php');
//const data = ref(appdata)

const formFilter = ref('');

const formItem = ref({
  id: "",
  name: "",
  description: "",
  technology: "",
  docker: false,
  ports: "",
  url: ""
});

const filteredData = computed(() => {
  return formFilter.value ? data.value.filter((item) => item.id.includes(formFilter.value)) : data.value;
});

function updateItem() {
  let item = data.value.find((item) => item.id === formItem.value.id);
  if (item) {
    Object.assign(item, formItem.value)
  } else {
    data.value.push(Object.assign({}, formItem.value))
  }
  formItem.value = {};
}

function loadItem(item) {

  getOne(item);

  window.scrollTo(0, 0);
}

watch(() => state.item, (newItem) => {
  formItem.value = newItem;
});

function deleteItem(item) {
  if (confirm('Are you sure you want to delete this item?')) {
    data.value.splice(data.value.indexOf(item), 1);
  }
}

</script>

<template>
  <div v-if="data.length">
    <div style="margin-bottom: 25px;">
      <form @submit.prevent="updateItem">
        <div style="margin-bottom: 25px;">
          <input v-model="formFilter" placeholder="Filter ...">
        </div>
        <div>
          <input v-model="formItem.id" placeholder="ID" required>
        </div>
        <div>
          <input v-model="formItem.name" placeholder="Name">
        </div>
        <div>
          <input v-model="formItem.technology" placeholder="Technology">
        </div>
        <div>
          <input v-model="formItem.docker" placeholder="Docker">
        </div>
        <div>
          <input v-model="formItem.port" placeholder="Ports">
        </div>
        <div>
          <input v-model="formItem.url" placeholder="Url">
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
