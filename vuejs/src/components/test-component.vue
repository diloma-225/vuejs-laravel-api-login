<template>
    <div>
        <h1>Test</h1>
    </div>
</template>

<script>
import { onMounted } from 'vue';
import useUserService from '@/services/userServices.js'
export default {
    setup() {

        const {user} = useUserService();
        onMounted(()=>{
            console.log(user.infos);
        });
        return{
            
        }
    }
}
</script>