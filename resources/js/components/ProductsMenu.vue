<template>
  <div>
    <b-nav class="bg-danger justify-content-center shadow-sm rounded mt-5" id="category-header">
      <b-nav-item
        v-for="category in categories"
        v-bind:key="category.id"
        :href="'#'+category.id+category.name"
      >
        <span class="text-light">{{category.name}}</span>
      </b-nav-item>
    </b-nav>

    <b-row class="mt-2" v-if="categories.length > 0">
      <b-col></b-col>
      <b-col>
        <label class="sr-only" for="inlineFormInputGroup">Search</label>
        <div class="input-group mb-2 mt-4">
          <div class="input-group-prepend">
            <div class="input-group-text bg-transparent">
              <i class="fas fa-search"></i>
            </div>
          </div>
          <input
            type="text"
            v-model="search"
            class="form-control"
            id="inlineFormInputGroup"
            placeholder="Search"
          />
        </div>
      </b-col>
    </b-row>
    <div v-for="category in categoryList" v-bind:key="category.id">
      <h3 class="mt-2" :id="category.id+category.name">{{category.name}}</h3>

      <div class="row">
        <div
          v-for="product in category.products"
          v-bind:key="product.id"
          class="col-md-4 d-flex align-items-stretch"
        >
          <div class="card product-card shadow-sm">
            <div class="img-container" @click="showModal(product)">
              <img
                class="card-img-top product-img img-hover cursor-pointer"
                :src="product.image"
                alt="image"
              />
              <div class="img-icon">
                <i class="fas fa-search-plus fa-2x"></i>
              </div>
            </div>

            <div class="card-body">
              <h5 class="card-title">{{product.name}}</h5>
              <p class="card-text">{{product.des }}</p>
            </div>
            <div class="card-footer border-0 bg-transparent">
              <div class="row text-center">
                <div class="col">
                  <button class="btn btn-primary btn-circle p-0" @click="decrement(product, false)">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <div class="col">
                  <input
                    type="number"
                    class="count h4 qty-input text-center"
                    min="1"
                    value="1"
                    :id="'qty'+product.id"
                    disabled
                  />
                </div>
                <div class="col">
                  <button class="btn btn-primary btn-circle p-0" @click="increment(product, false)">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <p class="h5 mt-4">
                    <span :id="'price'+product.id">{{product.price}}</span>
                    {{currency}}
                  </p>
                </div>
                <div class="col-8">
                  <button
                    class="btn btn-danger w-100 mt-3 border-0 add-to-cart"
                    @click="addToCart(product, false)"
                    :id="product.id"
                  >Add to cart</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <b-modal ref="product-modal" size="lg" centered hide-footer :title="prodcutName">
      <b-row>
        <b-col cols="5">
          <img class="product-img shadow" :src="prodcutImage" :alt="prodcutName" />
        </b-col>
        <b-col cols="7">
          <p>{{ prodcutDes }}</p>
          <div style="position:absolute;bottom:0;">
            <div class="row text-center">
              <div class="col">
                <button
                  class="btn btn-primary btn-circle p-0"
                  @click="decrement(productlist, true)"
                >
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="col">
                <input
                  type="number"
                  class="count h4 qty-input text-center"
                  min="1"
                  value="1"
                  :id="'qty-modal'+prodcutId"
                  disabled
                />
              </div>
              <div class="col">
                <button
                  class="btn btn-primary btn-circle p-0"
                  @click="increment(productlist, true)"
                >
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <p class="h5 mt-4">
                  <span :id="'price-modal'+prodcutId">{{prodcutPrice}}</span>
                  {{currency}}
                </p>
              </div>
              <div class="col-8">
                <button
                  class="btn btn-danger w-100 mt-3 border-0 add-to-cart"
                  @click="addToCart(productlist, true)"
                  :id="prodcutId"
                >Add to cart</button>
              </div>
            </div>
          </div>
        </b-col>
      </b-row>
    </b-modal>
  </div>
</template>
<script>
import TotalStore from "./TotalStore";

export default {
  props: ["currency"],
  data() {
    return {
      categories: [],
      TotalStore,
      search: "",
      productlist: "",
      prodcutId: "",
      prodcutName: "",
      prodcutPrice: "",
      prodcutDes: "",
      prodcutImage: "",
    };
  },
  methods: {
    makeToast() {
      this.$bvToast.toast("added to cart", {
        noCloseButton: true,
        toaster: "b-toaster-bottom-center",
        variant: "success",
        autoHideDelay: 200,
        solid: true,
        appendToast: true,
      });
    },
    getCategories() {
      axios
        .get("menu/products")
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
    },
    addToCart(product, isModal) {
      var qtyInput = document.getElementById("qty" + product.id);
      if (isModal) {
        qtyInput = document.getElementById("qty-modal" + product.id);
      }

      axios
        .get("cart/store/" + product.id + "/" + qtyInput.value)
        .then((response) => {
          if (response.status == 200) {
            this.makeToast();
            this.getTotal();
          }
        })
        .catch((error) => {
          //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
    },

    showModal(product) {
      this.productlist = product;
      this.prodcutId = product.id;
      this.prodcutName = product.name;
      this.prodcutPrice = product.price;
      this.prodcutDes = product.des;
      this.prodcutImage = product.image;
      this.$refs["product-modal"].show();
    },
    hideModal() {
      this.$refs["product-modal"].hide();
    },
    increment(product, isModal) {
      var qtyInput = document.getElementById("qty" + product.id);
      var priceText = document.getElementById("price" + product.id);

      if (isModal) {
        qtyInput = document.getElementById("qty-modal" + product.id);
        priceText = document.getElementById("price-modal" + product.id);
      }

      qtyInput.value++;
      priceText.innerHTML =
        parseFloat(product.price) * parseInt(qtyInput.value);
    },

    decrement(product, isModal) {
      var qtyInput = document.getElementById("qty" + product.id);
      var priceText = document.getElementById("price" + product.id);

      if (isModal) {
        qtyInput = document.getElementById("qty-modal" + product.id);
        priceText = document.getElementById("price-modal" + product.id);
      }

      if (qtyInput.value >= 2) {
        qtyInput.value--;
        priceText.innerHTML =
          parseFloat(product.price) * parseInt(qtyInput.value);
      }
    },

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

  created() {
    this.getCategories();
  },
  computed: {
    categoryList() {
      const search = this.search.toLowerCase();
      if (!search) return this.categories;
      return this.categories.map((category) => {
        return {
          category,
          products: category.products.filter((product) => {
            return product.name.toLowerCase().includes(search);
          }),
        };
      });
    },
  },
};
</script>