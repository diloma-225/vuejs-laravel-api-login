<template>
    <div>
        <h1 class="text-3xl uppercase mb-5">edit</h1>
        <form method="post" @submit.prevent="edit">
            <div> 
                <label> Nom</label>
                <input type="text" v-model="user.infos.name">
            </div>
            <div> 
                <label> Email</label>
                <input type="text" v-model="user.infos.email">
            </div>
            <button type="submit" class="p-1 bg-gray-500 text-white">Edit</button>
        </form>
    </div>
</template>
<script>
import { onMounted } from "vue";
import useUserService from '@/services/userServices.js'
export default {
    setup() {
        const {user, getUser, update} = useUserService();

        onMounted(getUser());

        const edit = async ()=>{
            await update({...user.infos});
        }

        return{
            user,
            edit
        }
    }
}
</script>

<style>
    input{
        border: 1px solid #000;
    }
</style>