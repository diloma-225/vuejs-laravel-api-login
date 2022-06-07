<template>
    <div>
        <div class="bg-white h-screen flex items-center py-10">
        <div class="max-w-2xl mx-auto">
            <div class="w-full">
                <div class="absolute -mt-20 ml-5">
                    <div class="bg-gray-200 flex items-center justify-center border border-gray-300 h-36 w-40 rounded-lg shadow-md border-b border-primary">
                        <img src="@/assets/user.png" alt="">
                    </div>
                </div>
            </div>

            <div class="bg-primary border border-primary rounded-b-lg p-5 pt-20 flex flex-col">
                <div class="mb-1 h-5 w-40">{{user.infos.name}}</div>
                <div class="mb-1  h-5 w-96">{{user.infos.email}}</div>
                <div>
                    <router-link :to="{name:'user.edit'}" class="mt-3 mx-2 px-1 rounded border-2 border-gray-500 hover:bg-gray-500 hover:text-white">Edit</router-link>

                    <router-link :to="{name:'user.updatePassword'}" class="mt-3 mx-2 px-1 rounded border-2 border-gray-500 hover:bg-gray-500 hover:text-white">update password</router-link>

                    <button class="mt-3 px-1 rounded border-2 border-gray-500 hover:bg-gray-500 hover:text-white" @click="deconnexion(user.infos.id)">Déconnexion</button>
                    
                    <div v-if="loading">loading.....</div>
                </div>
            </div>
        </div>
       
        </div>

        <div id="default-modal" class="flex items-center justify-center overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center" v-if="showModal">
            <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">

                <div class="bg-gray-800 rounded-lg shadow relative">

                    <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-white text-xl lg:text-2xl font-semibold dark:text-white">
                            Terms of Service
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" @click="close">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        <p class="text-gray-500 text-base leading-relaxed dark:text-gray-400">
                            With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                        </p>
                        <p class="text-gray-500 text-base leading-relaxed dark:text-gray-400">
                            The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                        </p>
                    </div>

                    <div class="flex space-x-2 items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-toggle="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                        <button data-modal-toggle="default-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Decline</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted } from "vue";
import useUserService from '@/services/userServices.js'
export default {

    setup() {

        const {getUser, user, logout, loading, showModal} = useUserService();
        onMounted(getUser());

        const deconnexion = async (id)=>{
            logout(id);
        }

        const handleModel = ()=>{
           showModal.value=true;
        }
        const close = ()=>{
           showModal.value=false;
        }

        return{
            user,
            deconnexion,
            loading,
            handleModel,
            showModal,
            close
        }
    }
}
</script>