<template>
    <div class="fixed z-50 top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 grid grid-cols-4 overflow-auto">
        <div class="col-start-2 col-span-2 my-auto text-gray-700 px-5 py-6 bg-white rounded flex flex-wrap">
            <div class="divide-y w-full">
                <div class="font-mono w-full text-center mb-2">
                    <p class="font-bold text-xl text-gray-600">{{ position() }}</p>
                    <p class="text-5xl">{{ this.item.name }}</p>
                    <p class="text-2xl" v-if="this.item.description">{{ this.item.description}}</p>
                    <p v-else class="text-gray-500">{Keine Beschreibung angegeben}</p>
                </div>
                <div class="pt-2 pb-2 w-full flex divide-x">
                    <div class="w-1/2 pr-2">
                        <div v-for="category in item.categories" class="w-1/2 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-1">{{ category.name }}</div>
                    </div>
                    <div class="w-1/2 pl-2">
                        <div v-for="tag in item.tags" class="w-1/2 inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-1">{{ tag.name }}</div>
                    </div>
                </div>
                <div class="pt-5 w-full font-bold text-lg">
                    <div class="w-full flex border-b-2 border-blue-400 mt-2">
                        <p class="w-1/2 text-left">ID (Identifikationsnummer)</p>
                        <p class="w-1/2 text-right border-l-2 border-blue-400">{{ this.item.id }}</p>
                    </div>
                    <div class="w-full flex border-b-2 border-blue-400 mt-2">
                        <p class="w-1/2 text-left">Lagerplatz</p>
                        <input class="w-1/2 text-right border-l-2 border-blue-400" :value="position()">
                    </div>
                    <div class="w-full flex border-b-2 border-blue-400 mt-2">
                        <p class="w-1/2 text-left">Stückzahl</p>
                        <input class="w-1/2 text-right border-l-2 border-blue-400" :value="this.item.amount">
                    </div>
                </div>
                <div class="mt-10 pt-5 w-full font-bold text-lg">
                    <div class="w-full flex border-b-2 border-blue-400 mt-2">
                        <p class="w-1/2 text-left">Kategorien</p>
                        <div class="w-1/2 border-l-2 border-blue-400 flex pl-1">
                            <input class="w-11/12" placeholder="Kategorie eintragen" v-model="categoriesInputField">
                            <button class="w-1/12 text-center text-white font-bold rounded-full">
                                <i class="far fa-plus-square text-blue-400" @click="addCategories()"></i>
                            </button>
                        </div>
                    </div>
                    <div class="w-full flex border-b-2 border-blue-400 mt-2">
                        <p class="w-1/2 text-left">Tags</p>
                        <div class="w-1/2 border-l-2 border-blue-400 flex pl-1">
                            <input class="w-11/12" placeholder="Tags eintragen">
                            <button class="w-1/12 text-center text-white font-bold rounded-full">
                                <i class="far fa-plus-square text-blue-400"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex w-full justify-end mt-6">
                <button @click="$emit('close-click')" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full mr-1">
                    Schließen
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import http from './http';

    export default {
        props: ['item'],

        data: function () {
            return {
                categoriesInputField: ''
            }
        },

        methods: {
            position: function ()
            {
                const shelf = this.item.shelf || 0;
                const row = this.item.row || 0;
                const field = this.item.field || 0;

                return shelf + ', ' + row + ', ' + field;
            },

            addCategories: function ()
            {
                http.updateItem()
            }
        },

        mounted() {
            let categoriesString = '';

            this.item.categories.forEach(category => { categoriesString = categoriesString + (category.name + ',') });
        }
    }
</script>
