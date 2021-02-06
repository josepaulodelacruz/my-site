<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Project
            </h2>
        </template>

        <div class="grid grid-cols-1 pt-6">
            <jet-form-section>
                <template #title>
                    Add Project
                </template>
                <template #description>
                    Upload your project to your site.
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Project Title"/>
                        <jet-input v-model="form.title"  id="title" type="text" class="mt-1 block w-full" />
                        <jet-input-error :message="form.error('title')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="description" value="Project Description"/>
                        <jet-input v-model="form.description"  id="description" type="text" class="mt-1 block w-full" />
                        <jet-input-error :message="form.error('description')"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label value="Tags"/>
                        <select @change="handleChange" class="bg-gray-200 p-4 rounded-lg shadow">
                            <option v-for="(tag, index) in options"
                                    :key="index"
                                    :data-tag="tag.type"
                                    :value="tag.type">
                                {{ tag.type }}
                            </option>
                        </select>

                        <div class="flex w-3/4 py-4 ">
                            <ul class="flex flex-wrap items-center">
                                <li v-for="tag in selectedTags" class="flex mr-1 shadow mt-2 py-1 px-3 bg-blue-500 text-black rounded-full">
                                    <p class="text-white">
                                        {{ tag }}
                                    </p>
                                    <p @click="deleteTag(tag)" class="text-white pl-2 text-left text-sm">
                                        x
                                    </p>
                                </li>

                            </ul>
                        </div>

                    </div>

                </template>


            </jet-form-section>

            <jet-form-section class="mt-10">
                <template #title>
                    Project Information
                </template>
                <template #description>
                    Add Date Created, Website Url, Repository and Images
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Created"/>
                        <jet-input v-model="form.created"  id="created_at" type="text" class="mt-1 block w-full" />
                        <jet-input-error :message="form.error('created')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Website"/>
                        <jet-input v-model="form.website"  id="website" type="text" class="mt-1 block w-full" />
                        <jet-input-error :message="form.error('website')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Github Repository"/>
                        <jet-input v-model="form.repository"  id="repo" type="text" class="mt-1 block w-full" />
                        <jet-input-error :message="form.error('repository')"/>
                    </div>

                </template>

            </jet-form-section>

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
                            <img v-for="image in uploadedImages" :src="image" alt="" class="object-fill h-44 m-1">
                        </div>

                    </div>

                </template>

            </jet-form-section>

            <div class="flex justify-end mt-4">
                <button @click="submit" class="bg-blue-400 rounded-lg p-4 text-white font-bold">
                    Add Project
                </button>
            </div>

        </div>
    </admin-layout>
</template>
<script>
import AdminLayout from '@/Layouts/AdminLayout'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
export default {
   props: [
       'tags',
   ],
   components: {
       AdminLayout,
       JetActionMessage,
       JetButton,
       JetFormSection,
       JetInput,
       JetInputError,
       JetLabel,
       JetSecondaryButton,
   },
   data() {
       return {
           photo: '',
           uploadedImages: [],
           selectedTags: ['Coding', 'News'],
           options: [],
           form: this.$inertia.form({
               title: 'test',
               description: 'test',
               tags: null,
               created: 'test',
               website: 'test',
               repository: 'test',
               images: [],
           }, {
               bag: 'projectForm',
           }),
       }
   },
   created() {
       this.options = [{type: 'None'}, ...this.tags];
   },
   methods: {
       handleChange(e) {
           if('None' !== e.target.options[e.target.options.selectedIndex].dataset.tag) {
               this.selectedTags.push(e.target.options[e.target.options.selectedIndex].dataset.tag)
               this.options = this.options.filter(el => el.type != e.target.options[e.target.options.selectedIndex].dataset.tag)
           }
       },
       deleteTag(tag) {
           this.selectedTags = this.selectedTags.filter(el => el != tag)
           this.options.push({type: tag})
       },
       submit() {
           this.form.tags = this.selectedTags
           this.form.images = this.photo
           // this.form.images = this.uploadedImages
           this.form.post(route('admin.projects.add'))
       },
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
                   this.uploadedImages.push(e.target.result);
               }
               // Start the reader job - read file as a data url (base64 format)
               reader.readAsDataURL(input.files[0]);
           }
       }
   }
}
</script>
