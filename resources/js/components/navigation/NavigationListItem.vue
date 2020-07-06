<template>
    <span class="px-4 py-2 m-2 border-b-2 border-blue-400 flex-1 relative text-center select-non cursor-pointer select-none" @click="toggleTooltip()">
        <span v-if="!hover_links">
            <a :href="route" class="outline-none font-normal hover:text-blue-400">
                <i :class="icon"></i>
                <span class="block w-full"><slot></slot></span>
            </a>
        </span>
        <span v-else-if="hover_links">
            <a class="outline-none font-normal hover:text-blue-400" ref="btnRef">
                <i :class="icon"></i>
                <span class="block w-full"><slot></slot></span>
            </a>
        </span>
        <div v-if="hover_links" v-bind:class="{'invisible': !tooltipShow}" ref="toolTipRef" class="absolute top-0 text-red-500 bg-gray-900 text-left hidden md:block">
            <a :href="route" v-if="hover_links && route">
                <div class="hover:bg-blue-500 hover:bg-opacity-25 text-white p-3">
                    <span>
                        <i :class="icon" class="pr-1"></i>
                    </span>
                    <span>
                        <slot></slot>
                    </span>
                </div>
            </a>
            <a :href="link[1]" v-for="link in hover_links">
                <div class="hover:bg-blue-500 hover:bg-opacity-25 text-white p-3">
                    <span>
                        <i :class="icon" class="pr-1"></i>
                    </span>
                    <span>
                        {{ link[0] }}
                    </span>
                </div>
            </a>
        </div>
    </span>
</template>

<script>
    export default {
        props: {
            'route': {type: String, required: false},
            'icon': {type: String, required: true},
            'hover_links': {type: Array, required: false}
        },

        data: function () {
            return {
                tooltipShow: false,
            }
        },

        created() {
            window.addEventListener("click", this.close);
        },

        beforeDestroy() {
            window.removeEventListener("click", this.close);
        },

        methods: {
            toggleTooltip: function () {
                if (this.tooltipShow)
                {
                    this.tooltipShow = false;
                }
                else
                {
                    const button = this.$refs.btnRef;
                    const tooltip = this.$refs.toolTipRef;

                    window.popper.createPopper(button, tooltip, {
                        placement: 'right-start',
                        strategy: 'fixed',
                        modifiers: [
                            {name: 'computeStyles', options: {
                                gpuAcceleration: false
                            }},
                            {name: 'offset', options: {
                                offset: [0, 25]
                            }},
                        ],
                    });

                    this.tooltipShow = true;
                }
            },

            close(e) {
                if (!this.$el.contains(e.target)) {
                    this.tooltipShow = false;
                }
            }
        }
    }
</script>
