<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <h1>Hi</h1>
                    <h2>I Don't have any role as of Now</h2>

                    <h3> Please allow me access of your libgrary Content</h3>
                    <h4>Thankyou!</h4>
                </div>
            </div>
            <form action="">
                <input type="name" name="authentication_type" value="remote">
                <input type="hidden" name="authentication_type" value="remote">
            </form>
        </div>
    </div>
</x-app-layout>
