<form wire:submit="save" x-data x-livewire-validation>
    <article>
        <code style="width: 100%; margin-bottom: .5rem;">Id: {{ $this->id }}</code>
        <div class="grid" style="margin-top: .5rem;">
            <label for="firstname">
                First name <small class="error-text" x-show="$hasError('user.first_name')">(error)</small>
                <input wire:model.live="user.first_name" type="text" id="firstname" name="firstname" placeholder="First name">
            </label>

            <label for="lastname">
                Last name <small class="error-text" x-show="$hasError('user.last_name')">(error)</small>
                <input wire:model.live="user.last_name" type="text" id="lastname" name="lastname" placeholder="Last name">
            </label>
        </div>
        <div>
            <label>
                Age <small class="error-text" x-show="$hasError('age')">(error)</small>
                <input wire:model.live="age" type="text" placeholder="Age" />
            </label>
        </div>
        <div>
            <button type="submit">Submit</button>

            <small>
                <div class="server-message">
                    {{ $message  }}
                </div>
                <template x-for="model in models" :key="model.name">
                    <div style="padding: .25rem 0;">
                        <template x-for="message in model.errors">
                            <div class="error-text" x-text="message"></div>
                        </template>
                    </div>
                </template>
            </small>
        </div>
    </article>
</form>
