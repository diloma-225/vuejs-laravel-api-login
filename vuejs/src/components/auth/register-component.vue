<template>
  <div class="h-screen font-sans login bg-cover bg-indigo-800">
    <div class="container mx-auto h-full flex flex-1 justify-center items-center">
      <div class="lg:w-2/5 sm:w-4/5">
        <div class="leading-loose">
          <form class="w-auto p-10 bg-white bg-opacity-25 rounded shadow-xl" @submit.prevent="submitForm">
            <p class="text-white font-medium text-center text-lg font-bold">REGISTER</p>
            <div class="">
              <label class="block text-sm text-white" for="email">Name</label>
              <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white" type="text" id="text"  placeholder="Name" aria-label="email" required v-model="form.name">
              <span v-if="errors.name" class="text-xs text-red-800">{{errors.name}}</span>
            </div>
            <div class="mt-2">
              <label class="block text-sm text-white" for="email">Email</label>
              <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white" type="email" id="email"  placeholder="email" aria-label="email" required v-model="form.email">
               <span v-if="errors.email" class="text-xs text-red-800">{{errors.email}}</span>
            </div>
            <div class="mt-2">
              <label class="block  text-sm text-white">password</label>
              <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white"
                type="password" id="password" placeholder="password" arial-label="password" required v-model="form.password">
                 <span v-if="errors.password" class="text-xs text-red-800">{{errors.password}}</span>
            </div>

            <div class="mt-2">
              <label class="block  text-sm text-white">password confirmation</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white"
                type="password" id="password" placeholder="password" arial-label="password" required v-model="form.password_confirmation">
            </div>

            <div class="mt-4 items-center flex justify-between">
              <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 hover:bg-green-800 rounded"
                type="submit">S'inscrire</button>
              <router-link :to="{name:'auth.login'}" class="inline-block right-0 align-baseline font-bold lg:text-sm text-500 text-white hover:underline">Vous avez un compte ? connectez-vous</router-link>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</template>
<script>
import useUserService from '@/services/userServices.js';
export default {
    setup(){
        const form = {
            name:'',
            email:'',
            password:'',
            password_confirmation:''
        };

        const {register, errors} = useUserService();

        const submitForm = async ()=>{
          await register(form);
        }

        return{
          form,
          submitForm,
          register,
          errors
        }
    }
}
</script>
