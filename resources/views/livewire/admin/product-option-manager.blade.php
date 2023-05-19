<div>
    <card class="-mx-4 mt-5 sm:-mx-0">
        <x-slot name="header">
            <div class="ml-4 mt-2">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Options</h3>
            </div>
            <div class="ml-4 mt-2 flex-shrink-0">
                <button type="button" wire:click="create">
                    Create option
                </button>
            </div>
        </x-slot>
        <x-slot name="content">

        </x-slot>
    </card>
</div>

<form wire:submit.prevent="save">
    <modal wire:model.defer="showCreateModal" max-width="lg">
        <slot name="title">
            Create new product option
        </slot>
        <slot name="content">
            <div class="space-y-8 divide-y divide-gray-200">
                <div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" value="Name" />
                            <div class="mt-1">
                                <input wire:model.defer="option.name" type="text" name="name" id="name" class="max-w-lg block w-full sm:max-w-xs sm:text-sm" placeholder="Eg: Size, Color" />
                                <input-error for="option.name" class="mt-2" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="visual" value="Visual" />
                            <div class="mt-1">
                                <select wire:model.defer="option.visual" name="visual" id="visual" class="max-w-lg block w-full sm:max-w-xs sm:text-sm">
                                    <option value="">Please select</option>
                                    <option value="text">Text</option>
                                    <option value="color">Color</option>
                                    <option value="image">Image</option>
                                </select>
                                <input for="option.visual" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </slot>
        <slot name="footer">
            <div>
                <button wire:click="$set('showCreateModal', false)">
                    Cancel
                </button>
                <button>
                    Save
                </button>
            </div>
        </slot>
    </modal>
</form>
