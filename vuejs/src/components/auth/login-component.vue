<template>
<div class="h-screen font-sans login bg-cover bg-indigo-800">
  <div class="container mx-auto h-full flex flex-1 justify-center items-center">
    <div class="lg:w-2/5 sm:w-4/5">
      <div class="leading-loose">
        <form class="w-auto p-10 bg-white bg-opacity-25 rounded shadow-xl" @submit.prevent="submitForm">
            <p class="text-white font-medium text-center text-lg font-bold">LOGIN</p>
              <div class="">
                <label class="block text-sm text-white" for="email">E-mail</label>
                <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white" type="email" id="email"  placeholder="e-mail" aria-label="email" required v-model="user.email">

                  <span v-if="errors.email" class="text-xs text-red-800">{{errors.email}}</span>
                  <span v-if="errors.connexionFailed" class="text-xs text-red-800">
                    {{errors.connexionFailed}}
                  </span>
                  
              </div>

              <div class="mt-2">
                <label class="block  text-sm text-white">Mot de passe</label>
                 <input class="w-full px-5 py-1 text-gray-700 bg-gray-300 rounded focus:outline-none focus:bg-white"
                  type="password" id="password" placeholder="password" arial-label="password" required v-model="user.password">
              </div>

              <div class="mt-4 items-center flex justify-between">
                <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 hover:bg-green-800 rounded"
                  type="submit">Connexion</button>
                <router-link :to="{name:'auth.register'}" class="inline-block right-0 align-baseline font-bold lg:text-sm text-500 text-white hover:underline">Vous avez pas compte ? inscrivez-vous</router-link>
              </div>

              <div>
                <a href="http://127.0.0.1:8000/forgot-password" class="text-white">Mot de passe oublié ?</a>
              </div>
              <div v-if="loading">Loading...</div>

        </form>

      </div>
    </div>
  </div>
</div>
</template>
<script>
import { reactive } from "vue";
import useUserServices from '@/services/userServices'
export default {
  setup() {
    const user = reactive({
      email:'',
      password:''
    });

    const {login, errors, loading} = useUserServices();

    const submitForm = async ()=>{
        await login(user);
    }

    return{
      user,
      errors,
      submitForm,
      loading
    }
  }
};
</script>


