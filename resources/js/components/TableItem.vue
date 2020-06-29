<template>
    <tr>
        <td v-for="item in items" class="border px-4 py-2 break-all">{{ item }}</td>
        <td v-if="htmlRow" class="border px-4 py-2 break-all" v-html="htmlRow"></td>
    </tr>
</template>

<script>
    export default {
        props: {
            'items': {type: Array, required: true},
            'htmlRow': {type: String, required: false},
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
