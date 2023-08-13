
<form wire:submit.prevent="save">
    <article>
        <code style="width: 100%; margin-bottom: .5rem;">Component: {{ $this->id }}</code>
        <div class="grid">
            <small>
                <div>
                    {{ $message  }}
                </div>
                @error('age')
                <div class="error-text">{{ $message }}</div>
                @enderror
            </small>
            <div>
                <label>
                    Update your age
                    <input wire:model="age" type="text" placeholder="Age" />
                </label>

                <button type="submit">Save</button>
            </div>
        </div>
    </article>
</form>
