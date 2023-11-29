import './bootstrap';

import Alpine from 'alpinejs'

import validationStorePlugin from './dist/livewire-validation-store.js'
import validationPlugin from './dist/livewire-validation.js'

Alpine.plugin(validationStorePlugin)
Alpine.plugin(validationPlugin)

window.Alpine = Alpine
Alpine.start()
