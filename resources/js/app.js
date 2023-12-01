import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

import ValidationPlugin from 'wire-validation'

Alpine.plugin(ValidationPlugin)
Livewire.start()
