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
            <item-modal v-if="showModal" v-on:close-click="toggleModal()" :item="selectedItem"></item-modal>

            <div class="flex flex-row border-b border-b-2 border-blue-500 py-2">
                <label class="appearance-none bg-transparent border-none w-full text-gray-700 mr-r py-1 px-2 leading-tight">
                    <input
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none focus:font-bold self-center"
                        type="text" v-model="search" placeholder="Artikel suchen" @keyup.enter="fetchItems">
                </label>
                <button @click="fetchItems" class="flex-shrink-0 bg-blue-500 mr-1 hover:bg-gray-900 border-blue-500 hover:border-gray-900 text-sm border-4 text-white py-1 px-2 rounded fas fa-search" type="submit"></button>
            </div>

            <div>
                <item-list v-for="item in items" :key="item.id" :item="item" v-on:item-details="toggleModal(item)"></item-list>
            </div>

            <div class="text-center mt-2">
                <div class="xl:inline-flex text-center text-xl border-b-2 border-blue-500">
                    <button v-for="n in totalItemsBy50" @click="fetchItems(n)" class="hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-l">
                        {{ n }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import http from './http';
    import itemList from './List';
    import itemModal from './Modal';

    export default {

        components: {itemList, itemModal},

        data: function ()
        {
            return {
                search: "",
                items: [],
                totalItemsBy50: 0,
                loaded: false,
                selectedItem: null,
                showModal: false
            }
        },

        methods: {
            fetchItems: async function (paginationSkip)
            {
                this.loaded = false;

                if (paginationSkip !== 0)
                {
                    paginationSkip = (paginationSkip - 1) * 50;
                }

                await http.fetchItems(this.search, paginationSkip).then(response =>
                {
                    this.items = response.items;
                    this.totalItemsBy50 = Math.floor(Math.ceil(response.totalItems / 50));

                    this.loaded = true;
                })
                .catch(error => console.log(error));
            },

            toggleModal: function (item)
            {
                if (this.showModal)
                {
                    this.showModal = false;
                    return;
                }

                this.selectedItem = item;
                this.showModal = true;
            }
        },

        mounted()
        {
            this.fetchItems(0);
        }
    }
</script>

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
