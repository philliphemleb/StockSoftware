<template>
    <tr>
        <td v-for="item in rows" class="border px-4 py-2 break-all">{{ item }}</td>
    </tr>
</template>

<script>
    export default {
        props: {
            'rows': {type: Array, required: true},
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
