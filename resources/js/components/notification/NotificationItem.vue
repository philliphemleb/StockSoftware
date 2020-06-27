<template>
    <div class="border-l-4 border-r-4 text-black px-4 py-3 my-4 rounded relative" role="alert"
         :class="typeColorClasses">
        <strong class="font-bold block mr-8">{{ title }}</strong>
        <span class="block sm:inline"><slot></slot></span>
        <span class="absolute top-0 right-0 px-4 py-3" @click="hide">
            <svg class="fill-current h-6 w-6" :class="typeFontClasses" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            'title': {type: String, required: true},
            'type': {type: String, required: true},
        },

        data: function () {
            return {
                inActive: false,
            }
        },

        computed: {
            typeColorClasses: function () {
                return {
                    'hidden': this.inActive === true,
                    'bg-gray-200': this.type === 'info',
                    'border-blue-500': this.type === 'info',
                    'bg-orange-200': this.type === 'warning',
                    'border-orange-500': this.type === 'warning',
                    'bg-red-200': this.type === 'error',
                    'border-red-500': this.type === 'error',
                }
            },
            typeFontClasses: function () {
                return {
                    'text-blue-500': this.type === 'info',
                    'text-orange-500': this.type === 'warning',
                    'text-red-500': this.type === 'error',
                }
            },
        },

        methods: {
            hide: function () {
                this.inActive = true;
            }
        }
    }
</script>
