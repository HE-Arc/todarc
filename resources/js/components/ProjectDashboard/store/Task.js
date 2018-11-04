
export default {
  state: {
    tasks: []
  },
  mutations: {
    FETCH(state, tasks) {
      state.tasks = tasks;
    }
  },
  actions: {
    fetch({}, id) {
      return axios
        .get(tasks)
        .then(response => commit("FETCH", response.data))
        .catch();
    },
    deleteTask({}, id) {
      axios
        .delete(`${tasks}/${id}`)
        .then(() => this.dispatch("fetch"))
        .catch();
    },
    edit({}, task) {
      axios
        .put(`${tasks}/${task.id}`, {
          name: task.name
        })
        .then(() => this.dispatch("fetch"));
    },
    addTask({}, name) {
      axios.post(`${tasks}`, {
        task: task
      });
    }
  }
}