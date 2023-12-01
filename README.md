## Sharing Livewire validation data with AlpineJS

I build this project to be a proof of concept for sharing Livewire validation state with AlpineJS components.
`.env` and prebuilt assets are included to ease the project startup process, feel free to change as needed.

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

## Overview

The local component demonstrates a Livewire component tracking and handling its own error states. There is a 'global' bit
of code that is used to dispatch the error messages to the proper components, however.

Here's the meat of it:

```javascript
document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook('commit', ({component, commit, respond, succeed, fail}) => {
        succeed(({snapshot, effect}) => {
            let alpineComponent = Alpine.$data(component.el);

            if (alpineComponent.processValidation) {
                alpineComponent.processValidation(JSON.parse(snapshot).memo.errors);
            }
        })
    })
});
```
> Reference: [Livewire docs - Commit Hooks](https://livewire.laravel.com/docs/javascript#commit-hooks)

It's pretty simple, actually. This block of code will catch Livewire messages after they've been processed forward the 
message to the corresponding component with an updated validation state. If the errors are empty, there's no validation
errors.

In the Livewire component, we've added the `x-wire-errors` attribute which enables all the features from the package.
You can read what's available at the [repo's README](https://github.com/hans-lts/alpine-validation#readme).

The real important bit is to set the listener on the **root Livewire element**. Like so:

```html
<div wire:id="wIhowMna8Zh2UxDqhWeq" x-data x-wire-errors>
    <~-- The rest of the component -->
</div>
```

In the demo, the Age field will be evaluated after the user blurs the input and a message will be displayed next to
the input field label.
