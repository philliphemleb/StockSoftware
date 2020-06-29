<template>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th v-for="singleHeader in header" class="px-4 py-2">{{ singleHeader }}</th>
            </tr>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: {
            'header': {type: Array, required: true},
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
