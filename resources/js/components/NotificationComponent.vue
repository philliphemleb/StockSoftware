<script>
    export default {
        mounted() {
            window.jQuery(this.$el).toast();
        },

        data: function () {
            return {
                active: true,
            }
        },
    }
</script>
