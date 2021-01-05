<template>
    <div class="flex-col flex-grow" id="layout">
        <Nav/>
        <header>
            <slot name="banner"></slot>
        </header>

        <div class="max-w-6xl mx-auto">
            <div class="flex justify-start items-start mt-12 mx-12 lg:mx-32 ">
                <slot name="content-left"></slot>
                <slot name="content-right"></slot>
            </div>
        </div>


        <footer class="footer bg-gray-800 relative pt-1 border-b-2 border-blue-700">
            <div class="container mx-auto px-6">
                <div class="sm:flex sm:mt-8">
                    <div class="mt-8 sm:mt-0 sm:w-full sm:px-8 flex flex-col md:flex-row justify-between">
                        <div class="flex flex-col">
                            <span class="font-bold text-white uppercase mb-2">Footer header 1</span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-white uppercase mt-4 md:mt-0 mb-2">Footer header 2</span>
                            <span class="my-2"><a href="#" class="text-white text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white text-md hover:text-blue-500">link 1</a></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-white uppercase mt-4 md:mt-0 mb-2">Footer header 3</span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                            <span class="my-2"><a href="#" class="text-white  text-md hover:text-blue-500">link 1</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto px-6">
                <div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center">
                    <div class="sm:w-2/3 text-center py-6">
                        <p class="text-sm text-gray-500 font-bold mb-2">
                            © 2020 by Jose Paulo
                        </p>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</template>

<script>
import Nav from '@/Components/Nav'
import JetInput from '@/Jetstream/Input'
import moment from 'moment';
export default {
    props: ['blog', 'tags', 'nextBlogs'],
    components: { Nav,
        JetInput
    },
    data() {
        return {
            isMobile: null,
            windowWith: window.innerWidth
        }
    },
    methods: {
        convertDate(date) {
            return moment(date).format("MMM Do YY");
        },
    },
}
</script>

<style scoped>
#layout {
    width: 100%;
}
footer {
    /*-webkit-clip-path: polygon(0 0, 100% 0, 100% 87%, 0 100%);*/
    /*clip-path: polygon(0 0, 100% 0, 100% 87%, 0 100%);*/
}
</style>
