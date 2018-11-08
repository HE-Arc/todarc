
export default {
  namespaced: true,
  state: {
    tasks: []
  },
  getters: {
    task(state){
      return id => state.tasks.find(task => {
        return task.id === id
      });
    }
  },
  mutations: {
    FETCH_TASKS(state, tasks) {
      state.tasks = tasks;
    }
  },
  actions: {
    fetchTasks({commit}, project_id) {
      project_id = 1;
      return axios
        .get(`${project_id}/tasks`)
        .then(response => commit("FETCH_TASKS", response.data))
        .catch();
    },
    deleteTask({}, id) {
      axios
        .delete(`${tasks}/${id}`)
        .then(() => this.dispatch("fetchTasks"))
        .catch();
    },
    edit({}, task) {
      axios
        .put(`${tasks}/${task.id}`, {
          name: task.name
        })
        .then(() => this.dispatch("fetchTasks"));
    },
    addTask({}, name, project_id, group_id) {
      axios.post(`${tasks}`, {
        name:name,
        project_id:project_id,
        group_id:group_id
      });
    }
  }
}