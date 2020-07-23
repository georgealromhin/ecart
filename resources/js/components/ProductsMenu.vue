<template>
    <div>


 <b-nav class="bg-danger justify-content-center shadow-sm rounded mt-5" id="category-header">
    <b-nav-item  v-for="category in categories"  v-bind:key="category.id"  :href="'#'+category.id+category.name"> <span class="text-light"> {{category.name}} </span> </b-nav-item>
  </b-nav>

 <b-row class="mt-2">
        <b-col>
        </b-col>
        <b-col>
          <b-form-input v-model="search" type="search" class="mt-4" id="filterInput" placeholder="Search..." size="sm"></b-form-input>
        </b-col>
      </b-row>
<div  v-for="category in categoryList"  v-bind:key="category.id">

     <h3 class="mt-2" :id="category.id+category.name">{{category.name}}</h3>

<div class="row">
       <div v-for="product in category.products" v-bind:key="product.id" class="col-md-4 d-flex align-items-stretch">
            <div class="card product-card shadow-sm">
               <a :href="'product/'+product.id"><img class="card-img-top product-img" :src="product.image" alt="image"></a> 
            <div class="card-body">
                <h5 class="card-title">{{product.name}}</h5>
                <p class="card-text">{{product.des }}</p>
            </div>
            <div class="card-footer border-0 bg-transparent">
                <div class="row text-center">
                    <div class="col"><button class="btn btn-primary btn-circle p-0" @click="decrement(product)"><i class="fas fa-minus"></i></button> </div>
                    <div class="col">
                        <input type="number" class="count h4 qty-input text-center" min="1" value="1" :id="'qty'+product.id" disabled>
                    </div>
                    <div class="col"><button class="btn btn-primary btn-circle p-0" @click="increment(product)"><i class="fas fa-plus"></i></button></div>
                </div>
                <div class="row">
                    <div class="col-4">
                            <p class="h5 mt-4"><span :id="'price'+product.id">{{product.price}}</span> {{currency}}</p>
                    </div>
                    <div class="col-8"><button class="btn btn-danger w-100 mt-3 border-0 add-to-cart" @click="addToCart(product)" :id="product.id">Add to cart </button></div>
                </div>
            </div>
            
            </div>
        </div>
</div>
        

</div>



    </div>
</template>
<script>
import TotalStore from './TotalStore'

export default {
    props: ['currency'],
    data(){
        return{
            categories:[],
            TotalStore,
            search: '',
        }
    }, 
    methods:{

        makeToast() {
            this.$bvToast.toast('added to cart', {
            noCloseButton: true,
            toaster: 'b-toaster-bottom-center',
            variant: 'success',
            autoHideDelay: 200,
            solid: true,
            appendToast: true
            })
        },
        getCategories() {
            axios.get('menu/products').then(response =>{
                this.categories = response.data.data
        }).catch( error => {
                //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
                 
        },
        addToCart(product){
           var qtyInput = document.getElementById('qty'+product.id) 
           axios.get('cart/store/'+product.id+'/'+qtyInput.value).then(response =>{
               if(response.status == 200){
                 this.makeToast()
                 this.getTotal()
              }

        }).catch( error => {
                //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
        },

        
        increment(product){
            var qtyInput = document.getElementById('qty'+product.id)
            var priceText = document.getElementById('price'+product.id)
            qtyInput.value++
            priceText.innerHTML = parseFloat(product.price) * parseInt(qtyInput.value)
        },
        
        decrement(product){
            var qtyInput = document.getElementById('qty'+product.id)
            var priceText = document.getElementById('price'+product.id)
            if(qtyInput.value >= 2){
                qtyInput.value--
                priceText.innerHTML = parseFloat(product.price) * parseInt(qtyInput.value)
            }
        },
         getTotal(){
            axios.get('total').then(response =>{
            TotalStore.data.total = response.data
        }).catch( error => {
            //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        }); 
        },

    },

   
    created(){
        this.getCategories();
    },
    computed: {
    categoryList() {
    const search = this.search.toLowerCase();
    if (!search) return this.categories;        
     return this.categories.map(category => {
    return {
      category, products: category.products.filter(product => {
        return product.name.toLowerCase().includes(search);
      }),
    }
  });
    }
  },
    
}
</script>