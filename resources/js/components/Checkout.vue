<template>

<div>


    <div class="text-center mt-5" v-if="checkout">
        <img src="images/success_tick.png" alt="success_tick">
        <h3>Order completed successfully</h3>
        <h4>Order №{{order_number}}</h4>
        <h4>An automated email was sent to {{email_address}}</h4>
        <a class="btn btn-primary" href="/public/">Go To Home Page</a>
    </div>

    <b-card header="Checkout" header-tag="header" class="shadow-sm" v-if="!checkout">
            
        <b-form @submit="onSubmit">
      
            <b-form-group id="input-group-1" label="Your Name:" label-for="input-2">
                <b-form-input id="input-1" class="shadow-sm" v-model="form.name" required placeholder="Enter name" ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Email address:" label-for="input-2">
                <b-form-input id="input-2" class="shadow-sm" v-model="form.email" type="email" required placeholder="Enter email"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-3" label="Phone number:" label-for="input-3">
                <b-form-input id="input-3" class="shadow-sm" v-model="form.phone" type="tel" required placeholder="Enter phone"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-4" label="" label-for="input-4" >
                <b-form-select class="form-control shadow-sm" id="input-4" v-model="form.selected" :options="order_type" required ></b-form-select>
            </b-form-group>

            <b-form-group id="input-group-5" label="Delivery Address:" label-for="input-5" v-if="form.selected == 'Delivery'">
                <b-form-textarea id="input-5" class="shadow-sm" v-model="form.delivery_address" :required="form.selected == 'Delivery' ? true : false"></b-form-textarea>
            </b-form-group>

            <b-form-group id="input-group-6" label="Comments" label-for="input-6" >
                <b-form-textarea id="input-6" class="shadow-sm" v-model="form.comments"></b-form-textarea>
            </b-form-group>

            <b-row>
            <b-col></b-col>
            <b-col> <b-button type="submit" variant="danger" class="w-100 float-right shadow-sm">Submit</b-button></b-col>

            </b-row>
        </b-form>
    </b-card>

 
    
    
  </div>

</template>

<script>

 export default {

    data(){
      return {
        form: { name: '', email: '', phone: '', delivery_address: '', comments: '', selected: 'Delivery', },
        order_type: [ 'Delivery', 'Pickup'],
        checkout: false,
        order_number: null,
        email_address: null,


      }
    },
       
    mounted() {
   
        },

    methods:{
        onSubmit(evt) {
            evt.preventDefault();

            Swal.fire({title: '',text: 'Loading...',allowEscapeKey: false, allowOutsideClick: false});
            Swal.showLoading();
            const formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('email', this.form.email);
            formData.append('phone', this.form.phone);
            formData.append('delivery_address', this.form.delivery_address);
            formData.append('comments', this.form.comments);
            formData.append('order_type', this.form.selected);
            
            axios.post('order/create' , formData).then(response => {

                if(response.status == 200){
                    this.checkout = true;
                    this.order_number = response.data.order_number
                    this.email_address = response.data.email
                    Swal.close();
                }

          }).catch( error => {
                Swal.fire('Error', error.response.data.message,'error');
            });



      },
    },
     
    created: function(){

    }, 
    
    computed: {
    }

}
</script>