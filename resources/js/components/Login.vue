<template>
    <div class="flex">
        <div id="alert" class="absolute right-1">
            <div v-for="alert in alerts" :key="alert.index" class="alert animate-fade-in-up animate-fade-in-down bg-red-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold mt-3 transition-all ease-in-out delay-150">
            <h1 class="text-red-900">Wrong Credentials</h1>
             </div>

            
        </div>
        <div class="l w-full min-w-[600px]">
            <img src="background/login-background.jpg" class="w-full h-full" alt="">
        </div>
        <div class="r min-w-[500px] min-h-screen flex flex-col items-center bg-[#1B2430]">
            <h1 class="text-9xl font-extrabold text-white text-center mt-10">
                <span class="text-yellow-400">P</span>
                <span class="text-red-400">M</span>
                <span class="text-blue-400">S</span>
            </h1>
            <form @submit.prevent="login" class="w-full p-8 mt-20">
                
                <div>
                    <input type="text" v-model="username" class="px-4 py-2 inline-block w-full bg-gray-100 border-l-4 border-green-700" placeholder="Username">
                </div>
                <div class="mt-3">
                    <input type="password" v-model="password" class="px-4 py-2 inline-block w-full bg-gray-100 border-l-4 border-green-700" placeholder="Password">
                </div>
                <div class="mt-3">
                    <button type="submit" class="px-4 py-2 inline-block w-full bg-green-700 font-semibold text-white hover:bg-green-600" :class="[loading ? 'disabled' : '']">
                       <span v-if="!loading">Login</span>
                       <span v-else class="flex justify-center">

                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin w-[14px] fill-white mr-2" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M304 48C304 74.51 282.5 96 256 96C229.5 96 208 74.51 208 48C208 21.49 229.5 0 256 0C282.5 0 304 21.49 304 48zM304 464C304 490.5 282.5 512 256 512C229.5 512 208 490.5 208 464C208 437.5 229.5 416 256 416C282.5 416 304 437.5 304 464zM0 256C0 229.5 21.49 208 48 208C74.51 208 96 229.5 96 256C96 282.5 74.51 304 48 304C21.49 304 0 282.5 0 256zM512 256C512 282.5 490.5 304 464 304C437.5 304 416 282.5 416 256C416 229.5 437.5 208 464 208C490.5 208 512 229.5 512 256zM74.98 437C56.23 418.3 56.23 387.9 74.98 369.1C93.73 350.4 124.1 350.4 142.9 369.1C161.6 387.9 161.6 418.3 142.9 437C124.1 455.8 93.73 455.8 74.98 437V437zM142.9 142.9C124.1 161.6 93.73 161.6 74.98 142.9C56.24 124.1 56.24 93.73 74.98 74.98C93.73 56.23 124.1 56.23 142.9 74.98C161.6 93.73 161.6 124.1 142.9 142.9zM369.1 369.1C387.9 350.4 418.3 350.4 437 369.1C455.8 387.9 455.8 418.3 437 437C418.3 455.8 387.9 455.8 369.1 437C350.4 418.3 350.4 387.9 369.1 369.1V369.1z"/></svg>
                            loading...
                       </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
    import {ref} from 'vue';
    const username = ref('');
    const password = ref('');
    const alerts =  ref([]);
    const loading = ref(false);
    
    const login = async () =>{
        loading.value = true;
        await axios.post('api/login',{'username':username.value, 'password':password.value}).then(res=>{
           
            if(res.status == 200)
            {
               loading.value = false;
               window.location.href = '/admin/dashboard';
            }
           
        }).catch(err =>{
             loading.value = false;
            if(err.response.status == 401)
            {
                alerts.value.push(2);
            }

        })
    }
    setInterval(function(){
                    alerts.value.shift();
    },3000);

    document.title = "Login | PMS"
</script>

<style scoped>

</style>