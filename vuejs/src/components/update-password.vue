<template>
    <div>
        <h1>Reset password</h1>
        <form @submit.prevent="submit">
            <div>
                <label>Ancien Mot de passe :</label>
                <input type="password" name="old_password" v-model="form.old_password"> 
                <span v-if="errors.old_password" class="text-red-500">{{errors.old_password}}</span>
            </div> <br> 
            <div>
                <label>Nouveau Mot de passe :</label>
                <input type="password" name="password" v-model="form.password">
                <span v-if="errors.password" class="text-red-500">{{errors.password}}</span>
            </div> <br> 
            <div>
                <label>Confirmer mot de passe:</label>
                <input type="password" name="password_confirmation" v-model="form.password_confirmation">
            </div>
            <br>
            <button type="submit" class="p-1 bg-green-500">Modifier</button>
        </form>
    </div>
</template>
<script>
import {reactive} from 'vue'
import useUserService from '@/services/userServices.js'
export default {
    
    setup() {

        const form = reactive({
            password:'',
            password_confirmation:'',
            old_password:'',
            token:localStorage.getItem('token')
        });
        
        const {updatePassword, errors} = useUserService();

        const submit = async ()=>{
            updatePassword(form);
        }

        return {
            submit,
            form,
            errors
        }
    }

}
</script>