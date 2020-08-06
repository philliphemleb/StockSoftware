<style scoped>
    .sk-chase {
        width: 40px;
        height: 40px;
        position: absolute;
        animation: sk-chase 2.5s infinite linear both;
        top: 30%;
        bottom: 70%;
        left: 50%;
        right: 50%;
    }

    .sk-chase-dot {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        animation: sk-chase-dot 2.0s infinite ease-in-out both;
    }

    .sk-chase-dot:before {
        content: '';
        display: block;
        width: 25%;
        height: 25%;
        background-color: black;
        border-radius: 100%;
        animation: sk-chase-dot-before 2.0s infinite ease-in-out both;
    }

    .sk-chase-dot:nth-child(1) { animation-delay: -1.1s; }
    .sk-chase-dot:nth-child(2) { animation-delay: -1.0s; }
    .sk-chase-dot:nth-child(3) { animation-delay: -0.9s; }
    .sk-chase-dot:nth-child(4) { animation-delay: -0.8s; }
    .sk-chase-dot:nth-child(5) { animation-delay: -0.7s; }
    .sk-chase-dot:nth-child(6) { animation-delay: -0.6s; }
    .sk-chase-dot:nth-child(1):before { animation-delay: -1.1s; }
    .sk-chase-dot:nth-child(2):before { animation-delay: -1.0s; }
    .sk-chase-dot:nth-child(3):before { animation-delay: -0.9s; }
    .sk-chase-dot:nth-child(4):before { animation-delay: -0.8s; }
    .sk-chase-dot:nth-child(5):before { animation-delay: -0.7s; }
    .sk-chase-dot:nth-child(6):before { animation-delay: -0.6s; }

    @keyframes sk-chase {
        100% { transform: rotate(360deg); }
    }

    @keyframes sk-chase-dot {
        80%, 100% { transform: rotate(360deg); }
    }

    @keyframes sk-chase-dot-before {
        50% {
            transform: scale(0.4);
        } 100%, 0% {
              transform: scale(1.0);
          }
    }
</style>

<template>
    <div id="item-index">
        <div v-if="!loaded">
            <div class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        </div>

        <div v-if="loaded">
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
                </div>
            </div>

            <div class="grid grid-cols-12">
                <item-card v-for="item in items" :key="item.id" :item="item" :size="cardSize"></item-card>
            </div>

            <div class="text-center mt-2">
                <div class="xl:inline-flex text-center text-xl border-b-2 border-blue-500">
                    <button v-for="n in totalItemsBy10" @click="fetchItems(n)" class="hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-l">
                        {{ n }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import http from './http';

    export default {
        data: function ()
        {
            return {
                search: "",
                items: [],
                cardSize: 3,
                totalItemsBy50: '',
                loaded: false
            }
        },

        methods: {
            fetchItems: async function (skip = 0) {
                if (skip !== 0)
                {
                    skip = (skip - 1) * 10;
                }

                this.loaded = false;
                await http.getItems(this.search, skip).then(response => {
                   this.items = response.items;
                    this.totalItemsBy50 = Math.floor(response.totalItems / 50);
                    this.loaded = true;
                })
                .catch(error => console.log(error));
            },
        },

        mounted() {
            this.fetchItems();
        }
    }
</script>
