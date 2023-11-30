import './bootstrap';

import Alpine from 'alpinejs'

import WireValidation from 'wire-validation'
Alpine.plugin(WireValidation)

window.Alpine = Alpine
Alpine.start()
