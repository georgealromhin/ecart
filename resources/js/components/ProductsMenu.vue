<template>
    <div>


 <b-nav class="bg-danger justify-content-center shadow-sm rounded mt-5" id="category-header">
    <b-nav-item  v-for="category in categories"  v-bind:key="category.id"  :href="'#'+category.id+category.name"> <span class="text-light"> {{category.name}} </span> </b-nav-item>
  </b-nav>

 
<div  v-for="category in categories"  v-bind:key="category.id">

     <h3 class="mt-5" :id="category.id+category.name">{{category.name}}</h3>
<hr>

<div class="row">
       <div v-for="product in category.products" v-bind:key="product.id" class="col-md-4 d-flex align-items-stretch">
            <div class="card product-card shadow-sm">
                <img class="card-img-top product-img" :src="product.image" alt="image">
            <div class="card-body">
                <h5 class="card-title">{{product.name}}</h5>
                <p class="card-text">{{product.des }}</p>
            </div>
            <div class="card-footer border-0 bg-transparent">
                <div class="row text-center">
                    <div class="col"><button class="btn btn-primary btn-circle p-0" @click="decrement(product)"><i class="fas fa-minus"></i></button> </div>
                    <div class="col"><input type="number" class="count h4 qty-input text-center" min="1" disabled v-model="form[product.id]">
                    </div>
                    <div class="col"><button class="btn btn-primary btn-circle p-0" @click="increment(product)"><i class="fas fa-plus"></i></button></div>
                </div>
                <div class="row">
                    <div class="col-4"><span style="position: absolute;top:50%;left:50%;">{{priceValue[product.id]}}</span></div>
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
    data(){
        return{
            categories:[],
            form: {},
            priceValue: {},
            qtyInitalValue: 1,
            TotalStore,

        }
    }, 
    methods:{

        makeToast() {
            this.$bvToast.toast('added to cart', {
            noCloseButton: true,
            variant: 'success',
            autoHideDelay: 200,
            solid: true,
            appendToast: true
            })
        },
        getCategories() {
            axios.get('menu/products').then(response =>{
                this.categories = response.data.data
                // inital value for quantity input 
                // if you know another way to iniate a v-model input, please HELP ME!!!
                this.categories.forEach(element => {
                    element.products.forEach(elem => {
                        this.form[elem.id] = 1
                        this.priceValue[elem.id] = elem.price
                    });
                });

        }).catch( error => {
                //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
                 
        },
        addToCart(product){
           axios.get('cart/store/'+product.id+'/'+this.form[product.id]).then(response =>{
               if(response.status == 200){
                 this.makeToast()
                 this.getTotal()
              }

        }).catch( error => {
                //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        });
        },

        
        increment(product){
           this.form[product.id]++
           this.priceValue[product.id] = parseInt(this.form[product.id]) * product.price

            console.log(this.form[product.id])
            console.log( this.priceValue[product.id])
        },
        decrement(product){
            if(this.form[product.id] >= 2){
                this.form[product.id]--
                this.priceValue[product.id] = parseInt(this.form[product.id]) * product.price
            }
           

            console.log(this.form[product.id])
            console.log( this.priceValue[product.id])
        },
         getTotal(){
            axios.get('total').then(response =>{
            TotalStore.data.total = response.data
            //console.log('get total is working: '+TotalStore.data.total )
        }).catch( error => {
            //this.makeToast('Error','Could not load categories, error: '+ error.response.status, 'danger')
        }); 
        }

    },

   
    created(){
        this.getCategories();
        this.getTotal()
    },
    
}
</script>