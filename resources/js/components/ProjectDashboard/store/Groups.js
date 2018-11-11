
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
    FETCH_GROUPS(state, groups) {
      state.groups = groups;
    }
  },
  actions: {
    fetchGroups({commit}, project_id) {
      project_id = 1;
      return axios
        .get(`${project_id}/groups`)
        .then(response => commit("FETCH_GROUPS", response.data))
        .catch();
    },
    deleteGroup({}, id) {
      axios
        .delete(`${groups}/${id}`)
        .then(() => this.dispatch("fetchGroups"))
        .catch();
    },
    edit({}, group) {
      axios
        .put(`${groups}/${group.id}`, {
          name: group.name,
          group_id: groupsStore.group_id
        })
        .then(() => this.dispatch("fetchGroups"));
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
