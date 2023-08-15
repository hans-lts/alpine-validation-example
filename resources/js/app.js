import './bootstrap';

import Alpine from 'alpinejs'

import validationPlugin from './dist/livewire-validation.js'
Alpine.plugin(validationPlugin)

window.Alpine = Alpine
Alpine.start()
