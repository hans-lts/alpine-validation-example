
<form wire:submit.prevent="save">
    <article>
        <code style="width: 100%; margin-bottom: .5rem;">Component: {{ $this->id }}</code>
        <div>
            <label>
                Update your age
                <input wire:model="age" type="text" placeholder="Age" />
            </label>

            <button type="submit">Submit</button>

            <small>
                <div style="font-size: 1.25rem;">
                    {{ $message  }}
                </div>
                @error('age')
                <div class="error-text">{{ $message }}</div>
                @enderror
            </small>
        </div>
    </article>
</form>
