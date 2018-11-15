
export default {
  namespaced: true,
  state: {
    groupsData: [],
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
    },
  },
  mutations: {
    FETCH(state, data) {
      console.log(data)
      let groups = data.groups.data;
      let tasks = data.tasks.data;
      console.log(groups)
      let groupsArray = (id)=>{
        let res = [];
        groups.filter(group => group.group_id === id).forEach(group => {
          group.children = groupsArray(group.id)
          tasks.filter(task => task.group_id === group.id).forEach(task=>{
            task.isLeaf = true;
            task.title = task.name;
            group.children.push(task);
          });
          group.isLeaf = false;
          group.title = group.name;
          res.push(group);
        });
        return res;
      };
      state.groupsData = groupsArray(null);
      state.groups = groups;
    }
  },
  actions: {
    fetch({commit}, project_id) {
      project_id = 1;
      return axios
        .all([
          axios.get(`${project_id}/tasks`),
          axios.get(`${project_id}/groups`)
        ])
        .then(axios.spread((tasks, groups) => {
          commit("FETCH", {tasks, groups});
        }))
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
