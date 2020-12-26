<template>
    <article class="overflow-hidden bg-white w-56 h-56 mr-3 mb-6 rounded-lg shadow-lg">

        <a href="#">
            <img alt="Placeholder" class="block h-1/2 w-full object-cover" src="https://picsum.photos/600/400/?random">
        </a>

        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
            <h1 class="text-lg">
                <a class="no-underline hover:underline text-black" href="#">
                    Article Title
                </a>
            </h1>
            <p class="text-grey-darker text-sm">
                14/4/19
            </p>
        </header>

        <footer class="flex items-center justify-between leading-none p-2 md:p-4">
            <a class="flex items-center no-underline hover:underline text-black" href="#">
                <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random">
                <p class="ml-2 text-sm truncate">
                    Author Name
                </p>
            </a>
            <div class="flex">
                <button class="mr-1 bg-red-500 rounded-lg p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                </button>
                <button class=" bg-blue-500 rounded-lg p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                </button>
            </div>
        </footer>

    </article>
</template>

<script>
export default {
}

</script>
