<article

    x-data="{
        init() {
            // Get the wire:id attribute
            // In cases where the Alpine component is not on the root of the
            // Livewire element we will search for the closest one and track that
            this.id = $el.__livewire.id ?? Alpine.findClosest(el, i => i.__livewire.id)

            Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
                succeed(({ snapshot, effect }) => {
                    // Only check updates from our component
                    if(component.id === this.id) {
                        this.errors = JSON.parse(snapshot).memo.errors;
                    }
                })
            })
        },
        id: null,
        errors: {},
        get models() {
            return Object.keys(this.errors ?? {})
        },
        getErrors(model) {
            return this.errors[model] ?? []
        }
    }"
>
    <nav>
        <ul>
            <li>
                <h5 style="margin-bottom: 0; white-space: nowrap"><img src="/livewire.svg" style="height: 35px; padding-bottom: 5px; margin-right: .15rem;"/> Livewire</h5>
            </li>
        </ul>
        <ul>
            <li>
                <code>Id: <span x-text="id">Loading...</span></code>
            </li>
        </ul>
    </nav>

    <form wire:submit="save">
        <label>
            Update your age <small><span x-cloak x-show="!!Object.keys(errors).length" class="error-text">(error)</span></small>
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
    <div style="margin-top: 2rem;" wire:ignore>
        <h5><img src="/alpine.svg" style="height: 35px; width: 35px; padding-bottom: 5px; margin-right: .15rem;"/> Alpine</h5>
        <template x-for="(model, index) in models" :key="index">
            <div style="margin: 1rem 0;">
                <code>
                    [<span x-text="model"></span>]
                    <div style="margin-top: .4rem;">
                        <template x-for="(message, index) in getErrors(model)" :key="index">
                            <div :id="index">
                                > <span class="error-text" x-text="message"></span>
                            </div>
                        </template>
                    </div>
                </code>
            </div>
        </template>
        <code x-cloak x-show="!Object.keys(errors).length">
            > No Livewire errors reported
        </code>
    </div>
</article>
