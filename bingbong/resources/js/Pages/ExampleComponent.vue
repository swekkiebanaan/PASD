<!--
  This example requires Tailwind CSS v2.0+

  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
<template>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>

            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <a v-for="product in products" :key="product.id"  class="group">
                    <h3 class="mt-4 text-sm text-gray-700">
                        {{ product.name }}
                    </h3>
                    <p class="mt-1 text-lg font-medium text-gray-900">
                        {{ product.price_in_cents }}
                    </p>
                </a>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    data() {
        return {
            products:[],
            product:{
                product_id:null,
            name:null,
            EAN_13:null,
            vat_rate:null,
            price_in_cents:null,
            quantity:null,

            },

        }
    },
    mounted() {
        this.getProducts();
    },
    methods:{
        getProducts(){
            axios.get('/get-products')
                .then((response) => {

                    this.products = response.data;
                })
                .catch((error) => {

                })

        },
        update(){
            axios.post('/update-products',this.product)
                .then((response) => {


                })
                .catch((error) => {


                })

        },
        create(){
            axios.post('/create-products')
                .then((response) => {


                })
                .catch((error) => {


                })

        },
        delete(){
            axios.delete('/remove-products')
                .then((response) => {

                    // Code for handling the response
                })
                .catch((error) => {

                    // Code for handling the error
                })

        },
    },

}
</script>
