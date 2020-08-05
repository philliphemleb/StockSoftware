<template>
    <div id="item-index">
        <div class="flex flex-row border-b border-b-2 border-blue-500 py-2">
            <input
                class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:font-bold self-center"
                type="text" v-model="search">
            <button @click="fetchItems" class="flex-shrink-0 bg-blue-500 mr-1 hover:bg-gray-900 border-blue-500 hover:border-gray-900 text-sm border-4 text-white py-1 px-2 rounded fas fa-search" type="submit"></button>
        </div>

        <div class="text-right mt-2">
            <div class="text-center text-xl hidden xl:inline-flex border-b-2 border-blue-500">
                <button @click="cardSize = 1" class="hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-l">
                    <i class="fas fa-dice-one"></i>
                </button>
                <button @click="cardSize = 2" class="hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-l">
                    <i class="fas fa-dice-two"></i>
                </button>
                <button @click="cardSize = 3" class="hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-l">
                    <i class="fas fa-dice-three"></i>
                </button>
                <button @click="cardSize = 4" class="hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-l">
                    <i class="fas fa-dice-four"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-12">
            <item-card v-for="item in items" :key="item.id" :item="item" :size="cardSize"></item-card>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data: function ()
        {
            return {
                search: "",
                items: [],
                cardSize: 3,
            }
        },

        methods: {
            fetchItems: function ()
            {
                axios.get("http://192.168.0.26/StockSoftware/public/item?search=" + this.search)
                    .then(response => this.items = response.data)
                    .catch(error => console.log(error));
            },
        },

        mounted() {
            this.fetchItems();
        }
    }
</script>
