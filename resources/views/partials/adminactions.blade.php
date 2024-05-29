<button wire:click="$emit('reset')">Reset</button>
<button wire:click="$emit('delete', {{ $row->id }})">Delete</button>
