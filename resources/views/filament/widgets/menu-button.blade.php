<x-filament::widget>
    <x-filament::card class="relative">
	    <a href="{{ route('filament.resources.menu.index') }}">
	        <div class="relative h-12 flex flex-col justify-center items-center space-y-2">
	            <div class="space-y-1">
	                <span
	                    @class([
	                        'flex items-end space-x-2 rtl:space-x-reverse text-gray-800 hover:text-primary-500 transition text-2xl',
	                        'dark:text-primary-500 dark:hover:text-primary-400' => config('filament.dark_mode'),
	                    ])
	                >

	                Menu

	                </span>
	            </div>
	            <div class="text-sm flex space-x-2 rtl:space-x-reverse">
	                <span

	                    @class([
	                        'text-gray-600 hover:text-primary-500 focus:outline-none focus:underline',
	                        'dark:text-gray-300 dark:hover:text-primary-500' => config('filament.dark_mode'),
	                    ])
	                >
	                
	                    123 Recipes

	                </span>
	            </div>
	        </div>
	    </a>
    </x-filament::card>
</x-filament::widget>
