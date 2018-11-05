
export default {
  namespaced: true,
  state: {
    groups: []
  },
  getters: {
    group(state){
      return id => state.groups.find(group => {
        return group.id === id
      });
    },
    subGroups(state){
      return id => state.groups.filter(group => {
        return group.group_id === id
      });
    }
  },
  mutations: {
    FETCH(state, groups) {
      state.groups = groups;
    }
  },
  actions: {
    fetch({commit}, project_id) {
      project_id = 1;
      return axios
        .get(`${project_id}/groups`)
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
