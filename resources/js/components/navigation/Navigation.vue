<template>
    <div id="navigation" class="bg-gray-900 fixed w-screen bottom-0 md:w-auto md:inset-y-0 md:left-0">
        <ul class="text-white grid grid-cols-3 md:grid-cols-1">
            <slot></slot>
        </ul>
    </div>
</template>

<script>
    export default {
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
