<div
    x-data="{
        __errors: {},
        init() {
            window.errors = {}
            this.__errors = window.errors;
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
        },
        processValidation({target, detail}) {
            let wireComponent = target.getAttribute('wire:id')
            this.__errors[wireComponent] = detail
        }
    }"
    @validation-error.window="processValidation($event)"
>
    <template x-for="component in components" :key="component">
        <div style="margin: 1rem 0;">
            <code style="width: 100%">
                <h6><span>Component: </span><span x-text="component"></span></h6>
                <template x-for="(wireModel, index) in getWireModels(component)" :key="component + index">
                    <div>
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
            No Livewire errors reported
        </code>
    </template>
</div>
