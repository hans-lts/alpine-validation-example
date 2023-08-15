import Alpine from 'alpinejs'

Alpine.directive('livewire-validation', (el, { value, modifiers, expression }, { Alpine, effect, cleanup }) => {
    let wireId = el.closest('[wire\\:id]').getAttribute('wire:id');

    Alpine.magic('errors', (el, { Alpine }) => model => {
        return Alpine.$data(el).messages(model, model.endsWith('*'));
    })

    Alpine.magic('hasError', (el, { Alpine }) => model => {
        let state = Alpine.$data(el).models.find(x => x.name === model);
        return state ? state.errors.length > 0 : false;
    })

    Alpine.bind(el, {
        'x-data'() {
            return {
                wireId: null,
                init() {
                    this.wireId = wireId;

                    // Register the validation store only once
                    if(! this.$store['validationErrors']) {
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
                    }
                },
                get errors() {
                    return this.$store.validationErrors.__errors[this.wireId] ?? []
                },
                get models() {
                    let errorList = [];

                    for(const model of this.$store.validationErrors.getWireModels(this.wireId)) {
                        errorList.push({
                            name: model,
                            errors: this.$store.validationErrors.getErrorMessages(this.wireId, model)
                        })
                    }

                    return errorList;
                },
                messages(model, wildcard) {
                    if(wildcard) {
                        let messages = [];
                        let modelPrefix = model.split('*')[0];
                        let models = this.models.filter(model => model.name.startsWith(modelPrefix))

                        for(const model of models) {
                            messages.push(...model.errors)
                        }

                        return messages;
                    }
                    return this.$store.validationErrors.getErrorMessages(this.wireId, model)
                }
            }
        }
    })
})
