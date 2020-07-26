<template>
  <div>
    <div v-if="totalRows > 0">
      <h3>Your Order</h3>
      <b-table id="my-table" :items="items" :fields="fields" outlined bordered hover responsive>
        <template v-slot:cell(qty)="row">
          <b-row class="text-center">
            <b-col>
              <b-button
                class="btn btn-primary btn-circle p-0"
                @click="addToCart(row.item.product.id, -1)"
              >
                <b-icon-dash></b-icon-dash>
              </b-button>
            </b-col>
            <b-col>
              <!-- <b-form-input id="qty-input" type="number" class="count h4 qty-input text-center" :value="row.item.qty"></b-form-input> -->
              <p>{{row.item.qty}}</p>
            </b-col>
            <b-col>
              <b-button
                class="btn btn-primary btn-circle p-0"
                @click="addToCart(row.item.product.id, 1)"
              >
                <b-icon-plus></b-icon-plus>
              </b-button>
            </b-col>
          </b-row>
        </template>

        <template v-slot:cell(price)="row">
          <p>{{row.item.price}} {{currency}}</p>
        </template>

        <template v-slot:cell(delete)="row">
          <b-link href="#" class="text-danger" @click="deleteItem(row.item.product.id)">
            <b-icon-trash></b-icon-trash>Remove
          </b-link>
        </template>
      </b-table>
      <b-row>
        <b-col></b-col>
        <b-col>
          <b-link href="checkout" class="btn btn-danger btn-lg w-100">
            Checkout
            <b-icon-arrow-right-circle></b-icon-arrow-right-circle>
          </b-link>
        </b-col>
      </b-row>
    </div>

    <div class="text-center mt-5" v-if="!dataLoaded">
      <b-spinner variant="danger" type="grow" label="Spinning"></b-spinner>
    </div>

    <h4 class="text-center mt-5" v-if="dataLoaded && totalRows == 0">Cart is Empty</h4>
  </div>
</template>

<script>
import TotalStore from "./TotalStore";

export default {
  props: ["currency"],
  data() {
    return {
      items: [],
      fields: [
        { key: "product.name", label: "Name", sortable: true },
        { key: "qty", label: "Quantity", sortable: true },
        { key: "price", label: "Price", sortable: false },
        { key: "delete", label: "" },
      ],
      dataLoaded: false,
      totalRows: 0,
      TotalStore,
    };
  },
  methods: {
    makeToast(title, text, variant) {},
    // fetch data
    getCartItems() {
      axios
        .get("cart/all")
        .then((response) => {
          this.items = response.data.data;
          this.totalRows = this.items.length;
          this.dataLoaded = true;
        })
        .catch((error) => {
          //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
    },
    deleteItem(id) {
      axios
        .delete("cart/remove/" + id)
        .then((response) => {
          this.getCartItems();
          this.getTotal();
          this.items = response.data.data;
        })
        .catch((error) => {
          //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
    },
    addToCart(id, qty) {
      axios
        .get("cart/store/" + id + "/" + qty)
        .then((response) => {
          this.getCartItems();
          this.getTotal();
        })
        .catch((error) => {
          //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
    },
    getTotal() {
      axios
        .get("total")
        .then((response) => {
          TotalStore.data.total = response.data;
          //console.log('get total is working: '+TotalStore.data.total )
        })
        .catch((error) => {
          //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
    },
  },
  created: function () {
    this.getCartItems();
    this.getTotal();
  },
};
</script>