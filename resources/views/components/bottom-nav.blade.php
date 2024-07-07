<div
    {{ $attributes->merge([
        'class' =>
            'fixed bottom-0 left-0 z-10 w-full h-16 bg-white border-none dark:bg-gray-700 dark:border-gray-600 md:hidden bg-opacity-50 backdrop-blur-sm',
    ]) }}>
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
        <button type="button" onclick="window.location.href='{{route('dashboard.home')}}'"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i
                class="fa-brands fa-windows mb-2 text-gray-500 dark:text-gray-400 group-hover:text-primary-20 dark:group-hover:text-blue-500"></i>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-primary-20 dark:group-hover:text-blue-500">Dashboard</span>
        </button>
        <button type="button" onclick="window.location.href='{{route('dashboard.users')}}'"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i
            class="fas fa-users mb-2 text-gray-500 dark:text-gray-400 group-hover:text-primary-20 dark:group-hover:text-blue-500"></i>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-primary-20 dark:group-hover:text-blue-500">Users</span>
        </button>
        <button type="button" onclick="window.location.href='{{route('dashboard.kandidat')}}'"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i
            class="fas fa-user-tie mb-2 text-gray-500 dark:text-gray-400 group-hover:text-primary-20 dark:group-hover:text-blue-500"></i>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-primary-20 dark:group-hover:text-blue-500">Candidate</span>
        </button>

        <button type="button" onclick="window.location.href='{{route('dashboard.settings')}}'"
            class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
            <i
            class="fas fa-gear mb-2 text-gray-500 dark:text-gray-400 group-hover:text-primary-20 dark:group-hover:text-blue-500"></i>
            <span
                class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-primary-20 dark:group-hover:text-blue-500">Settings</span>
        </button>
    </div>
</div>
