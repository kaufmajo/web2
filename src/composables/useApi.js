import { ref } from "vue";

export function useApi() {

  const data = ref([])
  const error = ref(null)

  function get(url) {

    fetch(url)
      .then((res) => res.json())
      .then((json) => (data.value = json))
      .catch((err) => (error.value = err))

    return data;
  }

  async function getOne(url, payload) {

    const request = new Request("http://localhost:8889/api/get_one.php?id=app1", {
      method: "GET",
    });

    const response = await fetch(request);
    const json = await response.json();

    return json;
  }

  function post(url) {

  }

  function put(url) {

  }

  function del(url) {

  }

  return { data, error, get, getOne, post, put, del }
}
