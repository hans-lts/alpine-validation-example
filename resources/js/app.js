import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

import ValidationPlugin from './dist/livewire-validation.js'

Alpine.plugin(ValidationPlugin)
Livewire.start()
