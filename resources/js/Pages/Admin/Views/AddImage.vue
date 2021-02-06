<template>
    <admin-layout>
        <template #header>
            Add Image Project
        </template>
        <jet-form-section class="mt-10">
            <template #title>
                Project Images
            </template>
            <template #description>
                Upload Images of the Project
            </template>

            <template #form>
                <div class="col-span-6 sm:col-span-4">
                    <jet-input-error :message="form.error('images')"/>
                    <jet-label value="Upload Image"/>
                    <input type="file" accept="image/*" id="file-input" @change="uploadPic($event)">
                    <div class="flex flex-wrap mt-3">
<!--                        <img v-for="image in uploadedImages" :src="image" alt="" class="object-fill h-44 m-1">-->
                        <img :src="uploadedImages" class="object-fill h-44 m-1"  alt="">
                    </div>
                </div>
            </template>
            <template #actions>
                <button @click="addImage" class="bg-gray-500 p-2 rounded-lg text-white font-bold">
                    Add
                </button>
            </template>

        </jet-form-section>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
export default {
    props: [
        'project',
    ],
    components: {
        AdminLayout,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
    },
    mounted() {
      console.log(this.project)
    },
    data() {
        return {
            uploadedImages: null,
            form: this.$inertia.form({
                images: null,
            })
        }
    },
    methods: {
        uploadPic(event) {
            // Reference to the DOM input element
            var input = event.target;
            this.photo = input.files[0]
            this.form.coverPhoto = null
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                    // this.uploadedImages.push(e.target.result);
                    this.uploadedImages = e.target.result
                }
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0])

            }
        },
        addImage() {
            this.form.images = this.photo
            this.form.post(route('admin.images.new', this.project));
        },
    }


}
</script>
