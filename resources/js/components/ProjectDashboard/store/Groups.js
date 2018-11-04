
export default {
  state: {
    groups: []
  },
  mutations: {
    FETCH(state, groups) {
      state.groups = groups;
    }
  },
  actions: {
    fetch({}, project_id) {
      return axios
        .get(groups)
        .then(response => commit("FETCH", response.data))
        .catch();
    },
    deleteGroup({}, id) {
      axios
        .delete(`${groups}/${id}`)
        .then(() => this.dispatch("fetch"))
        .catch();
    },
    edit({}, group) {
      axios
        .put(`${groups}/${group.id}`, {
          name: group.name,
          group_id: groupsStore.group_id
        })
        .then(() => this.dispatch("fetch"));
    },
    addGroup({}, name, parent_id, project_id) {
      axios.post(`${groups}`, {
        name: name,
        project_id: project_id,
        group_id: parent_id
      });
    }
  }
}
