<template>
    <div>
        <form :action="route">
            <input v-if="method !== 'GET'" type='hidden' name='_method' :value='method'>
            <input v-if="csrf_token" type='hidden' name='_token' :value='csrf_token'>
            <div class="flex items-center border-b border-b-2 border-blue-500 py-2">
                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    :type="input_type" id="search-input" name="search-input" :placeholder="placeholder">
                <button class="flex-shrink-0 bg-blue-500 mr-1 hover:bg-gray-900 border-blue-500 hover:border-gray-900 text-sm border-4 text-white py-1 px-2 rounded fas fa-search" type="submit"></button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            'route': {type: String, required: true},
            'method': {type: String, required: false, default: "GET"},
            'csrf_token': {type: String, required: false},
            'placeholder': {type: String, required: false},
            'input_type': {type: String, required: false, default: "text"},
        },

        data: function () {
            return {

            }
        },

        methods: {
            test: function () {

            }
        }
    }
</script>
