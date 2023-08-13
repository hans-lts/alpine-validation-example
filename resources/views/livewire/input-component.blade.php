<form wire:submit.prevent="save">
    <article>
        <code style="width: 100%; margin-bottom: .5rem;">Id: {{ $this->id }}</code>
        <div class="grid" style="margin-top: .5rem;">
            <label for="firstname">
                First name
                <input wire:model="user.first_name" type="text" id="firstname" name="firstname" placeholder="First name">
            </label>

            <label for="lastname">
                Last name
                <input wire:model="user.last_name" type="text" id="lastname" name="lastname" placeholder="Last name">
            </label>
        </div>
        <div>
            <label>
                Age
                <input wire:model="age" type="text" placeholder="Age" />
            </label>
        </div>
        <div>
            <button type="submit">Submit</button>

            <small>
                <div class="server-message">
                    {{ $message  }}
                </div>

                @foreach($this->getErrorBag()->messages() as $errors)
                    <div style="padding: .25rem 0;">
                        @foreach($errors as $message)
                            <div class="error-text">{{ $message }}</div>
                        @endforeach
                    </div>
                @endforeach
            </small>
        </div>
    </article>
</form>
