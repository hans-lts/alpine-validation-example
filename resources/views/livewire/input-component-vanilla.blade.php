<form wire:submit.prevent="save">
    <article>
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


            <div class="server-message">
                {{ $message  }}
            </div>
            <h5 style="margin-top:2rem; white-space: nowrap"><img src="/livewire.svg" style="height: 35px; padding-bottom: 5px; margin-right: .15rem;"/> Livewire</h5>
            @foreach($errors->keys() as $key)
                <code>
                    [<span>{{ $key }}</span>]
                    @foreach($errors->get($key) as $error)
                        <div style="margin-top: .4rem;">
                            <div>
                                > <span class="error-text">{{ $error }}</span>
                            </div>
                        </div>
                    @endforeach
                </code>
            @endforeach
            @if(!$errors->any())
                <code>
                    > No Livewire errors reported
                </code>
            @endif
        </div>
    </article>
</form>
