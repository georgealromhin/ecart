<template>
  <div>
    <b-card class="shadow-sm">
      <template v-slot:header>
        <b-row>
          <b-col>
            <h4 class="mb-0">
              <b-icon-archive></b-icon-archive>Products
            </h4>
          </b-col>
          <b-col>
            <b-button
              id="show-btn"
              variant="primary"
              class="float-right"
              v-if="user_role == 'main'"
              @click="showModal(true, null)"
            >+ Add New Product</b-button>
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
        <template v-slot:cell(image)="row">
          <b-img
            rounded="circle"
            center
            v-bind="imageProps2"
            fluid
            :src="row.item.image"
            alt="Image"
          ></b-img>
        </template>

        <template v-slot:cell(status_check)="row">
          <b-link
            href="#"
            class="text-danger"
            v-if="row.item.status == 'hidden' && user_role == 'main'"
            @click="updateStatus(row.item.id, row.item.status)"
          >
            <b-icon-play-fill></b-icon-play-fill>Paused
          </b-link>
          <b-link
            href="#"
            class="text-primary"
            v-if="row.item.status == 'visible' && user_role == 'main'"
            @click="updateStatus(row.item.id, row.item.status)"
          >
            <b-icon-pause-fill></b-icon-pause-fill>Pause
          </b-link>
        </template>

        <template v-slot:cell(edit)="row">
          <b-link
            href="#"
            class="text-primary"
            @click="showModal(false, row.item, row.item)"
            v-if="user_role == 'main'"
          >
            <b-icon-pencil-square></b-icon-pencil-square>Edit
          </b-link>
        </template>

        <template v-slot:cell(delete)="row">
          <b-link
            href="#"
            class="text-danger"
            @click="deleteProduct(row.item.id)"
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

    <!-- Modal -->
    <b-modal ref="product-modal" size="lg" centered hide-footer :title="modalTitle">
      <b-form @submit="onSubmit">
        <b-row>
          <b-col cols="3">
            <b-img
              center
              v-bind="imageProps"
              fluid
              :src="imageUrl"
              alt="Image 1"
              class="thumbnail-img"
            ></b-img>
            <b-form-file
              v-model="form.image"
              placeholder
              @change="openImage"
              @drop="openImage"
              drop-placeholder="Drop file here..."
              accept="image/*"
            ></b-form-file>
            <b-button variant="dark" size="sm" class="mt-2 w-100" @click="resetImage">Reset image</b-button>
          </b-col>
          <b-col cols="9">
            <b-form-group
              id="input-group-2"
              label="Category:"
              label-for="select-category"
              class="mt-3"
            >
              <select
                name="select-category"
                id="select-category"
                class="form-control"
                v-model="form.category_id"
                required
              >
                <option
                  v-for="category in categories"
                  v-bind:key="category.id"
                  :value="category.id"
                >{{category.name}}</option>
              </select>
            </b-form-group>

            <b-form-group
              id="input-group-2"
              :label="'Product Name: ' + nameTextLength+'/255'"
              label-for="input-name"
              class="mt-3"
            >
              <b-form-input
                id="input-name"
                v-model="form.name"
                maxlength="255"
                v-on:keyup="nameTextLength = form.name.length"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Price" label-for="input-price">
              <b-form-input
                type="number"
                min="0"
                step="0.1"
                value="0"
                id="input-price"
                v-model="form.price"
                required
              ></b-form-input>
            </b-form-group>

            <b-form-group
              id="input-group-2"
              :label="'Description: ' + desTextLength+'/255'"
              label-for="input-des"
            >
              <b-form-textarea
                id="input-des"
                v-model="form.des"
                rows="4"
                maxlength="255"
                v-on:keyup="desTextLength = form.des.length"
              ></b-form-textarea>
            </b-form-group>

            <b-form-input id="input-id" v-model="form.id" hidden></b-form-input>

            <b-row class="mt-2">
              <b-col>
                <b-button variant="danger" @click="hideModal()" class="w-100">Close</b-button>
              </b-col>
              <b-col>
                <b-button type="submit" variant="primary" class="w-100">Save</b-button>
              </b-col>
            </b-row>
          </b-col>
        </b-row>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: ["user_role"],
  data() {
    return {
      imageProps: { width: 200, height: 200 },
      imageProps2: { width: 35, height: 35 },
      form: {
        id: null,
        name: null,
        price: null,
        des: null,
        image: null,
        category_id: null,
      },
      //show: true,
      items: [],
      categories: [],
      fields: [
        { key: "image", label: "Image", sortable: false },
        { key: "name", label: "Product", sortable: true },
        { key: "price", label: "Price", sortable: true },
        { key: "category.name", label: "Category", sortable: true },
        { key: "status_check", label: "Status", sortable: false },
        { key: "edit", label: "" },
        { key: "delete", label: "" },
      ],
      totalRows: 0,
      currentPage: 1,
      perPage: 10,
      pageOptions: [10, 25, 50, 100],
      filter: null,
      modalTitle: null,
      formEdit: false,
      imageUrl: "images/thumbnail_image.jpg",
      imagePath: null,
      dataLoaded: false,
      desTextLength: 0,
      nameTextLength: 0,
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

    openImage(e) {
      this.imagePath = e.target.files[0];
      this.imageUrl = URL.createObjectURL(this.imagePath);
    },
    resetImage() {
      this.imageUrl = "images/thumbnail_image.jpg";
      this.imagePath = null;
      this.form.image = null;
    },
    resetForm() {
      this.form.name = null;
      this.form.price = null;
      this.form.des = null;
      this.form.category_id = null;

      this.resetImage();
    },

    showModal(add, item) {
      if (add) {
        this.resetForm();
        this.modalTitle = "Add New Peoduct";
        this.formEdit = false;
        this.desTextLength = 0;
        this.nameTextLength = 0;
      } else {
        this.form.id = item.id;
        this.imageUrl = item.image;
        this.form.name = item.name;
        this.form.price = item.price;
        this.form.des = item.des;
        this.form.category_id = item.category_id;
        this.modalTitle = "Edit Product";
        this.formEdit = true;
        this.form.des != null
          ? (this.desTextLength = this.form.des.length)
          : (this.desTextLength = 0);
        this.form.name != null
          ? (this.nameTextLength = this.form.name.length)
          : (this.nameTextLength = 0);
      }
      this.$refs["product-modal"].show();
    },
    hideModal() {
      this.$refs["product-modal"].hide();
    },
    // submit form (add data)
    onSubmit(evt) {
      evt.preventDefault();
      const formData = new FormData();
      formData.append("id", this.form.id);
      formData.append("image", this.imagePath);
      formData.append("name", this.form.name);
      formData.append("price", this.form.price);
      formData.append("des", this.form.des);
      formData.append("category_id", this.form.category_id);
      formData.append("current_image", this.imageUrl);

      if (this.formEdit) {
        axios
          .post("product/update", formData)
          .then((response) => {
            if (response.status == 200) {
              this.makeToast("Updated", "Product Updated", "success");
              this.hideModal();
              this.getProducts();
            }
          })
          .catch((error) => {
            this.makeToast(
              "Error",
              "Something went wrong, error: " + error.response.status,
              "danger"
            );
          });
      } else {
        axios
          .post("product/create", formData)
          .then((response) => {
            if (response.status == 200) {
              this.makeToast("Added", "New Product Added", "success");
              this.hideModal();
              this.getProducts();
              this.resetForm();
              //reset form
              evt.target.reset();
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
    },

    // fetch data
    getProducts() {
      axios
        .get("products/all")
        .then((response) => {
          this.items = response.data.data;
          // Set the initial number of items
          this.totalRows = this.items.length;
          this.dataLoaded = true;
        })
        .catch((error) => {
          this.makeToast(
            "Error",
            "Could not load products, error: " + error.response.status,
            "danger"
          );
        });
    },
    // fetch categories
    getCategories() {
      axios
        .get("categories/all")
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          this.makeToast(
            "Error",
            "Could not load categories, error: " + error.response.status,
            "danger"
          );
        });
    },

    // delete data
    deleteProduct(id) {
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
            .delete("product/delete/" + id)
            .then((response) => {
              if (response.status == 200) {
                this.makeToast("Deleted", "Product Deleted", "success");
                this.getProducts();
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
    updateStatus(id, status) {
      var _status = "visible";
      if (status == "visible") {
        _status = "hidden";
      }
      axios
        .put("product_status/update/" + _status + "/" + id)
        .then((response) => {
          if (response.status == 200) {
            this.makeToast(
              "Status Changed",
              "Product Status has been changed",
              "success"
            );
            this.getProducts();
          }
        })
        .catch((error) => {
          this.makeToast(
            "Error",
            "Something went wrong, error: " + error.response.status,
            "danger"
          );
        });
    },
    // Trigger pagination to update the number of buttons/pages due to filtering
    onFiltered(filteredItems) {
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },

  created: function () {
    this.getProducts();
    this.getCategories();
  },

  computed: {},
};
</script>