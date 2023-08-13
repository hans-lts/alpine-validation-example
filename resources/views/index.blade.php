<x-app title="Local component">
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.processed', (message, component) => {
                let errors = message.response.serverMemo.errors
                component.el.dispatchEvent(new CustomEvent('validation-error', {
                    detail: errors
                }))
            })
        });
    </script>

    <div class="grid">
        <livewire:input-component-with-alpine />
        <livewire:input-component-with-alpine />
    </div>
</x-app>
