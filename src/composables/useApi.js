import { reactive, toRefs } from "vue";

export function useApi() {

  const data = reactive({
    rows: [],
    item: {},
    error: null,
    fetching: true,
    message: "",
    result: null
  });

  async function fetchMe(request) {

    data.message = ""
    data.error = null
    data.fetching = true

    try {
      const response = await fetch(request);
      const json = await response.json();
      data.message = "Successful."
      data.result = json;
    } catch (errors) {
      data.error = errors;
      data.message = "Error."
    } finally {
      data.fetching = false;
    }
  }

  async function get() {

    const request = new Request(`http://localhost:8889/api/get.php`, {
      method: "GET",
    });

    await fetchMe(request);
    data.rows = data.result

    return { ...toRefs(data) };
  }

  async function getOne(item) {

    const request = new Request(`http://localhost:8889/api/get_one.php?id=${item.id}`, {
      method: "GET",
    });

    await fetchMe(request);
    data.item = data.result

    return { ...toRefs(data) };
  }

  async function post(item) {

    const request = new Request(`http://localhost:8889/api/post.php`, {
      method: "POST",
      body: JSON.stringify(item),
    });

    await fetchMe(request);
    data.item = data.result

    return { ...toRefs(data) };
  }

  async function put(item) {

    const request = new Request(`http://localhost:8889/api/put.php`, {
      method: "PUT",
      body: JSON.stringify(item),
    });

    await fetchMe(request);
    data.item = data.result

    return { ...toRefs(data) };
  }

  async function del(item) {

    const request = new Request(`http://localhost:8889/api/delete.php`, {
      method: "DELETE",
      body: JSON.stringify(item),
    });

    await fetchMe(request);
    data.item = data.result

    return { ...toRefs(data) };
  }

  return { get, getOne, post, put, del, data }
}
