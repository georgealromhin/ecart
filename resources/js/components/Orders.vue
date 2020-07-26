<template>
  <div>
    <b-card class="shadow-sm">
      <template v-slot:header>
        <b-row>
          <b-col>
            <h4 class="mb-0">
              <b-icon-inbox></b-icon-inbox>Orders
            </h4>
          </b-col>
          <b-col>
            <b-button variant="dark" class="float-right" @click="refreshTable()">
              <b-icon-bootstrap-reboot></b-icon-bootstrap-reboot>Refresh
            </b-button>
          </b-col>
        </b-row>
      </template>

      <b-row class="mt-2">
        <b-col>
          Show
          <b-form-select
            class="form-control w-25"
            v-model="perPage"
            id="perPageSelect"
            size="sm"
            :options="pageOptions"
          ></b-form-select>entries
        </b-col>
        <b-col>
          <label class="sr-only" for="inlineFormInputGroup">Search</label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text bg-transparent">
                <i class="fas fa-search"></i>
              </div>
            </div>
            <input
              type="text"
              v-model="filter"
              class="form-control form-control-sm"
              id="inlineFormInputGroup"
              placeholder="Search"
            />
          </div>
        </b-col>
      </b-row>

      <b-table
        id="my-table"
        class="mt-2"
        :items="items"
        :per-page="perPage"
        :current-page="currentPage"
        :fields="fields"
        outlined
        bordered
        hover
        striped
        responsive
        :filter="filter"
        @filtered="onFiltered"
      >
        <template v-slot:cell(status)="row">
          <b-badge variant="warning" v-if="row.item.order_status == 'Pending'">
            <b-icon-stopwatch></b-icon-stopwatch>
            {{row.item.order_status }}
          </b-badge>
          <b-badge variant="success" v-else-if="row.item.order_status == 'Delivered'">
            <b-icon-check-circle></b-icon-check-circle>
            {{row.item.order_status }}
          </b-badge>
          <b-badge variant="danger" v-else>
            <b-icon-x-circle></b-icon-x-circle>
            {{row.item.order_status }}
          </b-badge>
        </template>

        <template v-slot:cell(view)="row">
          <b-link v-bind:href="'order_details/'+ row.item.id" class="text-primary" target="_blank">
            <b-icon-eye></b-icon-eye>View
          </b-link>
        </template>

        <template v-slot:cell(delete)="row">
          <b-link
            href="#"
            class="text-danger"
            @click="deleteOrder(row.item.id)"
            v-if="user_role == 'main'"
          >
            <b-icon-trash></b-icon-trash>Delete
          </b-link>
        </template>
      </b-table>
      <div class="text-center" v-if="!dataLoaded">
        <b-spinner variant="primary"></b-spinner>
      </div>
      <p class="text-center" v-if="totalRows == 0 && dataLoaded">No data available in table</p>

      <b-pagination
        v-model="currentPage"
        :total-rows="totalRows"
        :per-page="perPage"
        align="right"
        first-text="First"
        prev-text="Prev"
        next-text="Next"
        last-text="Last"
        class="mt-1"
      ></b-pagination>
    </b-card>
  </div>
</template>

<script>
export default {
  props: ["user_role"],
  data() {
    return {
      //show: true,
      items: [],
      fields: [
        { key: "order_number", label: "Order №", sortable: true },
        { key: "customer.name", label: "Customer", sortable: true },
        { key: "created_at", label: "Date", sortable: true },
        { key: "total", label: "Total", sortable: true },
        { key: "order_type", label: "Type", sortable: true },
        { key: "status", label: "Status", sortable: true },
        { key: "view", label: "" },
        { key: "delete", label: "" },
      ],
      totalRows: 0,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      filter: null,
      dataLoaded: false,
    };
  },

  mounted() {},

  methods: {
    makeToast(title, text, variant) {
      this.$bvToast.toast(text, {
        title: title,
        variant: variant,
        autoHideDelay: 1000,
        solid: true,
      });
    },

    // fetch data
    getOrders() {
      axios
        .get("orders/all")
        .then((response) => {
          this.items = response.data.data;
          // Set the initial number of items
          this.totalRows = this.items.length;
          this.dataLoaded = true;
        })
        .catch((error) => {
          this.makeToast(
            "Error",
            "Could not load orders, error: " + error.response.status,
            "danger"
          );
        });
    },
    refreshTable() {
      this.getOrders();
    },

    // delete data
    deleteOrder(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0080FF",
        cancelButtonColor: "#FF2645",
        confirmButtonText: "Yes",
        focusCancel: true,
      }).then((result) => {
        if (result.value) {
          axios
            .delete("order/delete/" + id)
            .then((response) => {
              if (response.status == 200) {
                this.makeToast("Deleted", "Order Deleted", "success");
                this.getOrders();
              }
            })
            .catch((error) => {
              this.makeToast(
                "Error",
                "Something went wrong, error: " + error.response.status,
                "danger"
              );
            });
        }
      });
    },

    // update status
    updateStatus(id, status) {},
    // Trigger pagination to update the number of buttons/pages due to filtering
    onFiltered(filteredItems) {
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },

  created: function () {
    this.getOrders();
  },

  computed: {},
};
</script>