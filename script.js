const { createApp } = Vue;

createApp({
  data() {
    return {
      apiUrl: 'server.php',
      title: 'ToDoList',
      list: [],
      newTodo: '',
    };
  },
  methods: {
    getList() {
      axios.get(this.apiUrl).then((result) => {
        this.list = result.data;
      });
    },
    addTask() {
      // Il dato che invio al server, per essere accettato da PHP come se provenisse da un form, quindi devo crearlo dentro un FormData

      const data = new FormData();
      data.append('todoItem', this.newTodo);

      axios.post(this.apiUrl, data).then((result) => {
        this.list = result.data;
        this.newTodo = '';
      });
    },
    removeTask(index) {
      const data = new FormData();
      data.append('indexToDelete', index);

      axios.post(this.apiUrl, data).then((result) => {
        this.list = result.data;
      });
    },
    toggleTask(index) {
      this.list[index].completed = !this.list[index].completed;

      const data = new FormData();
      data.append('indexToToggle', index);

      axios.post(this.apiUrl, data).then((result) => {
        this.list = result.data;
      });
    },
  },
  mounted() {
    this.getList();
  },
}).mount('#app');