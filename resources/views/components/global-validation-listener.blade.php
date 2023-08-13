<div
    x-data="{
        __errors: {},
        init() {
            Livewire.hook('message.processed', (message) => {
                this.__errors[message.component.id] = message.response.serverMemo.errors
            })
        },
        get components() {
            return Object.keys(this.__errors).filter(model => Object.values(this.__errors[model]).length > 0)
        },
        getWireModels(component) {
            return Object.keys(this.__errors[component])
        },
        getErrorMessages(model, component) {
            return this.__errors[component][model]
        },
        hasValidationErrors(component, model) {
            return this.getErrorMessages(component, model).length > 0 ?? false
        }
    }"
>
    <template x-for="component in components" :key="component">
        <div style="margin: 1rem 0;">
            <code>
                <h6><span>Component: </span><span x-text="component"></span></h6>
                <template x-for="(wireModel, index) in getWireModels(component)" :key="component + index">
                    <div style="padding-bottom: .75rem;">
                        [<span x-text="wireModel"></span>]
                        <div style="margin-top: .4rem;">
                            <template x-for="error in getErrorMessages(wireModel, component)">
                                <div>
                                    > <span class="error-text" x-text="error"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </code>
        </div>
    </template>
    <template x-if="!components.length">
        <code>
            > No Livewire errors reported
        </code>
    </template>
</div>
