import Alpine from 'alpinejs'

Alpine.store('validationErrors', {
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
        return Object.keys(this.__errors[component] ?? [])
    },
    getErrorMessages(component, model) {
        if(!this.__errors[component]) {
            return []
        }
        return this.__errors[component][model] ?? []
    },
    hasValidationErrors(component, model) {
        return this.getErrorMessages(component, model).length > 0 ?? false
    }
})

Alpine.directive('shares-validation', (el, { value, modifiers, expression }, { Alpine, effect, cleanup }) => {

    Alpine.magic('errors', (el, { Alpine }) => model => {
        return Alpine.$data(el).messages(model);
    })

    Alpine.magic('hasError', (el, { Alpine }) => model => {
        let state = Alpine.$data(el).models.find(x => x.name === model);
        return state ? state.errors.length > 0 : false;
    })

    Alpine.bind(el, {
        'x-data'() {
            return {
                wireComponent: null,
                init() {
                    this.wireComponent = el.closest('[wire\\:id]').getAttribute('wire:id');
                },
                get errors() {
                    return this.$store.validationErrors.__errors[this.wireComponent] ?? []
                },
                get models() {
                    let errorList = [];

                    for(const model of this.$store.validationErrors.getWireModels(this.wireComponent)) {
                        errorList.push({
                            name: model,
                            errors: this.$store.validationErrors.getErrorMessages(this.wireComponent, model)
                        })
                    }

                    return errorList;
                },
                messages(model) {
                    return this.$store.validationErrors.getErrorMessages(this.wireComponent, model)
                }
            }
        }
    })
})
