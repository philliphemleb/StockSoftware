<template>
    <li class="px-4 py-2 m-2 border-b-2 border-blue-400 flex-1 text-center select-non cursor-pointer">
        <a :href="route" class="outline-none font-normal hover:text-blue-400">
            <i :class="icon"></i>
            <span class="block"><slot></slot></span>
        </a>
    </li>
</template>

<script>
    export default {
        props: ['route', 'icon'],

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
