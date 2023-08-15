<article
    x-data="{
        errors: [],
        wireModels: [],
        showMessage: false,
        component: @js($this->id),
        getErrorMessages(model) {
            return this.errors[model] ?? []
        },
        hasValidationErrors(model) {
            return this.getErrorMessages(model).length > 0 ?? false
        },
        processValidation({detail}) {
            this.errors = detail
            this.wireModels = Object.keys(detail);

            this.showMessage = this.wireModels.length
        }
    }"
    @validation-error="processValidation($event)"
>
    <nav>
        <ul>
            <li>
                <h5 style="margin-bottom: 0; white-space: nowrap"><img src="/livewire.svg" style="height: 35px; padding-bottom: 5px; margin-right: .15rem;"/> Livewire</h5>
            </li>
        </ul>
        <ul>
            <li>
                <code>Id: {{ $this->id }}</code>
            </li>
        </ul>
    </nav>

    <form wire:submit.prevent="save">
        <label>
            Update your age <small><span x-cloak x-show="showMessage" class="error-text">(error)</span></small>
            <input
                wire:model="age"
                type="text"
                placeholder="Age"
            />
        </label>

        <button type="submit">Submit</button>

        <small>
            <div class="server-message">
                {{ $message  }}
            </div>
            @error('age')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </small>
    </form>

    <div style="margin-top: 2rem;">
        <h5><img src="/alpine.svg" style="height: 35px; width: 35px; padding-bottom: 5px; margin-right: .15rem;"/> Alpine <small>(nested)</small></h5>
        <template  x-if="wireModels.length" >
            <template x-for="wireModel in wireModels" :key="wireModel">
                <div style="margin: 1rem 0;">
                    <code>
                        [<span x-text="wireModel"></span>]
                        <div style="margin-top: .4rem;">
                            <template x-for="error in errors[wireModel]">
                                <div>
                                    > <span class="error-text" x-text="error"></span>
                                </div>
                            </template>
                        </div>
                    </code>
                </div>
            </template>
        </template>
        <template x-if="!wireModels.length">
            <code>
                > No Livewire errors reported
            </code>
        </template>
    </div>
</article>
