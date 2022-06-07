import axios from 'axios'
import {reactive, ref} from 'vue'
import router from '@/router'


export default function useUserService(){

    const errors = reactive({
        name:'',
        email:'',
        password:'',
        connexionFailed:'',
        old_password:''
    });

    const loading = ref(false);


    const user = reactive({
        infos:null,
    });

    const register = async (data) =>{
        try {
            await axios.post('http://127.0.0.1:8000/api/user/auth/register', data).then((response)=>{
                localStorage.setItem('token', response.data.token);
                router.push({name:'auth.profile'});
            });

        } catch (error) {
            const currentErrors = error.response.data.errors;

            for (const key  in currentErrors) {
                errors[key] = currentErrors[key][0]
            }
        }
    }

    const login = async (data)=>{
        loading.value = true;
        axios.post('http://127.0.0.1:8000/api/user/auth/login', data)
            .then((response)=>{
                localStorage.setItem('token', response.data.token);
                router.push({name:'auth.profile'});
            }).catch((error)=>{
                if (error.response.status === 422) {
                    errors.connexionFailed = 'Mot de passe ou email incorrecte'
                }
            }).finally(()=>{
                loading.value = false;
            })
    }

    const logout =  async (id)=>{
        loading.value = true;
        await axios.post('http://127.0.0.1:8000/api/user/auth/logout', {id:id})
                    .then((response)=>{
                        if (response.status===200) {
                            localStorage.removeItem('token')
                            router.push({name:'auth.login'})
                        }
                    }).finally(()=>{
                        loading.value = false;
                    })
    }

    const getUser= async ()=>{
        axios.get('http://127.0.0.1:8000/api/user', {
            headers:{
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })
        .then((response)=>{
            user.infos = response.data;
        })
    }

    const update = async (data)=>{
        await axios.put('http://127.0.0.1:8000/api/user/update', data)
                    .then(()=>{
                        router.push({name:'auth.profile'});
                    })
    }

    const updatePassword = async (data)=>{


        try {
            await axios.put('http://127.0.0.1:8000/api/user/password', data, {
                headers:{
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                 }
            })
            .then(()=>{
                router.push({name:'auth.profile'});
            })
        } catch (e) {
            const currentErrors = e.response.data.errors;

            for (const index in currentErrors) {
               errors[index] = currentErrors[index][0];
            } 

            if (e.response.status===401) {
                errors['old_password'] = e.response.data.old_password;
            }

        }

    }


    return {
        register, 
        errors,
        user,
        getUser,
        login,
        logout,
        loading,
        update,
        updatePassword
    }
}