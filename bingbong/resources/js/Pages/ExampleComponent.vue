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
    <header class="bg-indigo-600">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
            <div class="w-full py-6 flex items-center justify-between border-b border-indigo-500 lg:border-none">
                <div class="flex items-center">
                    <a href="#">
                        <span class="sr-only">Workflow</span>
                        <img class="h-10 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=white" alt="" />
                    </a>
                    <div class="hidden ml-10 space-x-8 lg:block">
                        <a v-for="link in navigation" :key="link.name" :href="link.href" class="text-base font-medium text-white hover:text-indigo-50">
                            {{ link.name }}
                        </a>
                    </div>
                </div>
                <div class="ml-10 space-x-4">
                    <a href="#" class="inline-block bg-indigo-500 py-2 px-4 border border-transparent rounded-md text-base font-medium text-white hover:bg-opacity-75">Sign in</a>
                    <a href="#" class="inline-block bg-white py-2 px-4 border border-transparent rounded-md text-base font-medium text-indigo-600 hover:bg-indigo-50">Sign up</a>
                </div>
            </div>
            <div class="py-4 flex flex-wrap justify-center space-x-6 lg:hidden">
                <a v-for="link in navigation" :key="link.name" :href="link.href" class="text-base font-medium text-white hover:text-indigo-50">
                    {{ link.name }}
                </a>
            </div>
        </nav>
    </header>

    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Products</h2>
            <label class="pr-20" >Add new product</label>
            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <div class="w-1/2">

                    <input type="number" v-model="product_id" class="h-14 w-1/7  rounded-lg z-0 focus:shadow focus:outline-none " placeholder="product id" >
                    <input type="text" v-model="name" class="h-14 w-1/7  rounded-lg z-0 focus:shadow focus:outline-none" placeholder="name">
                    <input type="number" v-model="ean_13" class="h-14 w-1/7  rounded-lg z-0 focus:shadow focus:outline-none" placeholder="EAN 13">
                    <input type="number" v-model="vat_rate" class="h-14 w-1/7  rounded-lg z-0 focus:shadow focus:outline-none" placeholder="vat rate">
                    <input type="number" v-model="price_in_cents" class="h-14 w-1/7  rounded-lg z-0 focus:shadow focus:outline-none" placeholder="price in cents">
                    <input type="number" v-model="quantity" class="h-14 w-1/7  rounded-lg z-0 focus:shadow focus:outline-none" placeholder="quantity">
                    <input type="text" v-model="image" class="h-14 w-1/7  rounded-lg z-0 focus:shadow focus:outline-none" placeholder="image url">
                    <button type="button" @click="create" class="h-14 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">Create</button>
                </div>
                <a v-for="product in products" :key="product.id"  class="group">
                    <div >
                        <img :src="product.image"   width="150" height="150" />
                    </div>
                    <h3 class="mt-4 text-sm text-gray-700">
                        {{ product.name }}
                    </h3>
                    <p class="mt-1 text-lg font-medium text-gray-900">
                        Price in cents:{{ product.price_in_cents }}
                    </p>
                    <div class=" bg-gray-200">
                        <div class="relative">
                            <div class="absolute top-4 left-3"> <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i> </div>
                            <input type="number" v-model="product.price_in_cents" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" >
                            <div class="absolute top-2 right-2">
                                <button type="button" @click="update(product)" class="h-15 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">Update Price</button> </div>
                        </div>
                    </div>

                    <p class="mt-1 text-lg font-medium text-gray-900">
                        Quantity:{{product.quantity }}
                    </p>
                    <div class=" bg-gray-200">
                        <div class="relative">
                            <div class="absolute top-4 left-3"> <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i> </div>
                            <input type="text" v-model="product.quantity" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" >
                            <div class="absolute top-2 right-2">
                                <button type="button" @click="update(product)" class="h-15 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">Update Quantity</button> </div>
                        </div>
                        <button type="button" @click="deletus(product)" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Remove
                        </button>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
const navigation = [
    { name: 'Solutions', href: '#' },
    { name: 'Pricing', href: '#' },
    { name: 'Docs', href: '#' },
    { name: 'Company', href: '#' },
]

export default {
    data() {
        return {
            products:[],
            product_id : null,
            name : null,
            ean_13 : null,
            vat_rate : null,
            price_in_cents : null,
            quantity : null,
            image : null,


        }
    },
    setup() {
        return {
            navigation,
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
        update(product){
            axios.post('/update-products/'+product.id,product)
                .then((response) => {

                })
                .catch((error) => {


                })

        },
        create(){
            axios.post('/create-products',{
                    product_id: this.product_id,
                    name: this.name,
                    EAN_13: this.ean_13,
                    vat_rate: this.vat_rate,
                    price_in_cents: this.price_in_cents,
                    quantity: this.quantity,
                    image: this.image,
                }

            )
                .then((response) => {
                    this.getProducts();

                })
                .catch((error) => {


                })

        },
        deletus(product){
            axios.delete('/remove-products/'+product.id,product)
                .then((response) => {

                    this.getProducts();
                })
                .catch((error) => {

                    // Code for handling the error
                })

        },
    },

}
</script>
