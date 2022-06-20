<x-main-layout>

<!-- hero -->
<div class="relative bg-white overflow-hidden bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-gray-800 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-gray-800 transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100"></polygon>
            </svg>

            <livewire:navigation.navigation />

           <livewire:hero.info/>
        </div>
    </div>
    <livewire:hero.image/>
</div>

<!-- Projects -->
<div class="bg-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <livewire:project.project/>
    </div>
</div>

<!-- Footer -->
<section class="bg-gray-800">
    <div class="flex justify-center pt-10">
        <h2 class="text-2xl font-extrabold text-gray-200">Contact me here</h2>
    </div>
    <div class="max-w-screen-xl px-4 py-3 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
        <nav class="flex flex-wrap justify-center -mx-5 -my-2">
            <livewire:contact.contact/>
        </nav>

        <div class="flex justify-center mt-8 space-x-6">
            <a href="#" target="_blank" class="text-gray-400 hover:text-red-400">
                <span class="sr-only">LinkedIn</span>
                <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19.959 11.719v7.379h-4.278v-6.885c0-1.73-.619-2.91-2.167-2.91-1.182 0-1.886.796-2.195 1.565-.113.275-.142.658-.142 1.043v7.187h-4.28s.058-11.66 0-12.869h4.28v1.824l-.028.042h.028v-.042c.568-.875 1.583-2.126 3.856-2.126 2.815 0 4.926 1.84 4.926 5.792zM2.421.026C.958.026 0 .986 0 2.249c0 1.235.93 2.224 2.365 2.224h.028c1.493 0 2.42-.989 2.42-2.224C4.787.986 3.887.026 2.422.026zM.254 19.098h4.278V6.229H.254v12.869z"></path>
                </svg>
            </a>
            <a href="https://github.com/gamg" target="_blank" class="text-gray-400 hover:text-red-400">
                <span class="sr-only">GitHub</span>
                <svg class="w-10 h-10" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" class=""></path>
                </svg>
            </a>
            <a href="https://twitter.com/gamg_" target="_blank" class="text-gray-400 hover:text-red-400">
                <span class="sr-only">Twitter</span>
                <svg class="w-10 h-10" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" class=""></path>
                </svg>
            </a>
            <a href="https://www.youtube.com/channel/UCAhUwzPtyWu7Bj5vmjq9YEA" target="_blank" class="text-gray-400 hover:text-red-400">
                <span class="sr-only">Youtube</span>
                <svg class="w-10 h-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5 7H19C19.5523 7 20 7.44771 20 8V16C20 16.5523 19.5523 17 19 17H5C4.44772 17 4 16.5523 4 16V8C4 7.44772 4.44772 7 5 7ZM2 8C2 6.34315 3.34315 5 5 5H19C20.6569 5 22 6.34315 22 8V16C22 17.6569 20.6569 19 19 19H5C3.34315 19 2 17.6569 2 16V8ZM10 9L14 12L10 15V9Z" fill="currentColor" />
                </svg>
            </a>
        </div>

        <nav class="flex flex-wrap justify-center -mx-5 -my-2">
            <div class="px-5 py-2">
                <a href="#" class="flex text-base leading-6 text-gray-400 hover:text-red-400">
                    Hello
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="flex text-base leading-6 text-gray-400 hover:text-red-400">
                    Projects
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="flex text-base leading-6 text-gray-400 hover:text-red-400">
                    Contact me
                </a>
            </div>
            <div class="px-5 py-2">
                <a href="#" class="flex text-base leading-6 text-gray-400 hover:text-red-400">
                    Es/En
                </a>
            </div>
        </nav>
    </div>
</section>
</x-main-layout>
