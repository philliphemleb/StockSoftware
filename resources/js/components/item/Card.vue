<template>
    <div class="rounded border border-gray-600 shadow-lg md:border-0 mt-3 mx-3 flex flex-wrap col-span-12 lg:col-span-6"
         v-bind:class="{'xl:col-span-12': this.size === 1, 'xl:col-span-6': this.size === 2, 'xl:col-span-4': this.size === 3, 'xl:col-span-3': this.size === 4}">
        <div class="px-2 pt-6 text-center w-full self-start">
            <p v-for="n in 2" v-if="item.categories[n] !== undefined" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-1 w-1/2">
                <span>{{ item.categories[n].name }}</span>
            </p>
        </div>

        <div class="px-3 text-gray-700 text-base mb-3 w-full self-center text-center">
            <p class="font-bold text-xl mb-2">{{ this.item.name }}</p>
            <p v-if="this.item.description">{{ this.item.description }}</p>
            <p v-else class="text-gray-500">{Keine Beschreibung angegeben}</p>
        </div>

        <div class="px-3 pb-6 flex w-full self-end">
            <button class="w-1/2 bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full mr-1">
                {Info}
            </button>
            <button class="w-1/2 bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-4 rounded-full ml-1">
                {Löschen}
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['item', 'size'],

        data: function () {
            return {

            }
        },
    }
</script>
