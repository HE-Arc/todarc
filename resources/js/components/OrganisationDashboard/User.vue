<template>
  <div class="card text-center">
    <h4 class="card-header">{{ name }}</h4>
    <div class="card-body">
      <ul>
        <li v-for="task in tasks">{{ task.name }}</li>
      </ul>
    </div>
    <div class="card-footer">
    </div>
  </div>
</template>

<script>
  module.exports =
  {
    props: {
      name: String,
      tasks: Array
    }
  }
</script>

<style lang="scss" scoped>

</style>
