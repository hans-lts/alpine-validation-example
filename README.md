## Sharing Livewire validation data with AlpineJS

I build this project to be a proof of concept for sharing Livewire validation state with AlpineJS components.
`.env` and prebuilt assets are included to ease the project startup process, feel free to change as needed.

Included are two examples - one featuring validation sharing on a component level and the other featuring global error
state tracking.

## Installation

Clone the repo to a local folder and install the composer dependencies.

```bash
> composer install
```

Next, install the NPM dependencies

```bash
> npm i
> npm run build
```

Lastly, start up the Laravel server and access the site from your browser.

```bash
> php artisan serve

  INFO  Server running on [http://127.0.0.1:8000].

  Press Ctrl+C to stop the server
```

## Local component

The local component demonstrates a Livewire component tracking and handling its own error states. There is a 'global' bit
of code that is used to dispatch the error messages to the proper components, however.

Here's the meat of it:

```javascript
Livewire.hook('message.processed', (message, component) => {
    let errors = message.response.serverMemo.errors
    component.el.dispatchEvent(new CustomEvent('validation-error', {
        detail: errors
    }))
})
```
> Reference: [Livewire docs - Lifecycle Hooks](https://laravel-livewire.com/docs/2.x/lifecycle-hooks#js-hooks)

Pretty simple, actually. This block of code will catch Livewire messages after they've been processed forward the 
message to the corresponding component with an updated validation state. If the errors are empty, there's no validation
errors.

In the Livewire components there's some Alpine that decides what to do with that updated error state. This component 
is really for demo purposes and could be swapped in for any number of use cases.

The real important bit is to set the listener on the **root Livewire element**. Like so:

```html
<div 
    wire:id="wIhowMna8Zh2UxDqhWeq" 
    x-data="{
        handleTheErrorState(errors) {
            // ...
        }
    }"
    @validation-error="handleTheErrorState($event)" 
>
    <~-- The rest of the component -->
</div>
```

In the demo, the Age field will be evaluated after the user blurs the input and a message will be displayed next to
the input field label.

## Global component

The global component works much like the local component in that it takes a Livewire hook and processes the component
errors, if any. The difference is that instead of forwarding the error messages on to the individual components, it stores
all the error states at the top level. Mileage may vary on this method but, I wanted to demonstrate the possibilities.

This component also demonstrates a Livewire component using Eloquent models with nested validation requirements.

The best part of all this code is that no backend changes were needed.
