<template>
    <div class="mt-10 p-1 border-2 border-gray-400 rounded">
        <div class="m-2 grid grid-cols-2">
            <div class="col-span-1 divide-y divide-gray-400 w-auto break-words">
                <h3 class="text-xl"><span class="text-gray-500 text-xs">[{{ item.id }}]</span> {{ item.name }}</h3>
                <h3 class="truncate" v-if="item.description">{{ item.description }}</h3>
                <span class="flex divide-x divide-gray-400">
                    <p class="pr-2">Lagerplatz: {{ item.shelf }} | {{ item.row }} | {{ item.field }}</p>
                    <p class="pl-2">Anzahl: {{ item.amount }}</p>
                </span>
            </div>
            <div class="col-span-1 text-right self-center">
                <button class="bg-blue-700 hover:border-black hover:bg-blue-800 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Info
                </button>
                <button class="bg-white hover:border-black hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Details
                </button>
                <button class="bg-red-700 hover:border-black hover:bg-red-800 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                    Löschen
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['item'],

        data: function () {
            return {

            }
        }
    }
</script>
