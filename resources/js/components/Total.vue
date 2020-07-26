<template>
  <span>{{TotalStore.data.total}}</span>
</template>
<script>
import TotalStore from "./TotalStore";

export default {
  data() {
    return {
      TotalStore,
    };
  },
  methods: {
    getTotal() {
      axios
        .get("total")
        .then((response) => {
          TotalStore.data.total = response.data;
        })
        .catch((error) => {
          //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
    },
  },
  created: function () {
    this.getTotal();
  },
};
</script>