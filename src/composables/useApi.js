import { reactive, ref, toRefs } from "vue";

export function useApi() {

  const state = reactive({
    data: [],
    item: {},
    error: null,
    fetching: true,
    message: ""
  });

  const data = ref([])

  const error = ref(null)

  function get(url) {

    fetch(url)
      .then((res) => res.json())
      .then((json) => (data.value = json))
      .catch((err) => (error.value = err))
  }

 function getOne(item) {

    const request = new Request(`http://localhost:8889/api/get_one.php?id=${item.id}`, {
      method: "GET",
    });

    const fetchData = async () => {
      try {
        const response = await fetch(request);
        const json = await response.json();
        state.item = json;
        state.message = "Successful."
      } catch (errors) {
        state.error = errors;
      } finally {
        state.fetching = false;
      }
    }

    fetchData();

    return { ...toRefs(state) };
  }



  return { data, error, get, getOne, state }
}
