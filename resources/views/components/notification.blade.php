<notification inline-template>
    <div class="toast" v-bind:class="{ show: active, fade: active }" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="width: 100vw;">
        <div class="toast-header">
            <strong class="mr-auto">Status-Meldung</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ $slot }}
        </div>
    </div>
</notification>
