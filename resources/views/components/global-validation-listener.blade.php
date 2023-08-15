<div x-data>
    <template x-for="component in $store.validationErrors.components" :key="component">
        <div style="margin: 1rem 0;">
            <code>
                <h6><span>Component: </span><span x-text="component"></span></h6>
                <template x-for="(wireModel, index) in $store.validationErrors.getWireModels(component)" :key="component + index">
                    <div style="padding-bottom: .75rem;">
                        [<span x-text="wireModel"></span>]
                        <div style="margin-top: .4rem;">
                            <template x-for="error in $store.validationErrors.getErrorMessages(component, wireModel)">
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
    <template x-if="!$store.validationErrors.components.length">
        <code>
            > No Livewire errors reported
        </code>
    </template>
</div>
