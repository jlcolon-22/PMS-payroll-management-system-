<template>
    <div class="flex">
        <div v-show="sidebar" class="l min-w-[260px]  max-w-[260px] h-screen bg-green-400 shadow-lg" >
            <h1 class="text-7xl font-extrabold text-white text-center">
                <span class="text-yellow-400">P</span>
                <span class="text-red-400">M</span>
                <span class="text-blue-400">S</span>
            </h1>

            <ul class="px-2.5 mt-2">
                <li><a href="/admin/dashboard" class="activeLink">Dashboard</a></li>
                <li><a href="/admin/employees" class="sidebar-link">Employee</a></li>
                <li><a href="/admin/attendances" class="sidebar-link">Attendance</a></li>
                <li><a href="/admin/department" class="sidebar-link">Department</a></li>
                <li><a href="/admin/positions" class="sidebar-link">Positions</a></li>
                <li><a href="/admin/payrolls" class="sidebar-link">Payroll</a></li>
                <li><a href="/admin/scan" target="_blank" class="sidebar-link">Scan</a></li>
                
            </ul>
        </div>

        <div class="r w-full ">
            <!-- navbar -->
            <nav class=" h-[50px] bg-green-400 shadow-lg flex items-center justify-between">
                <button @click="sidebarShow">
                    <svg  class="ml-2 w-[24px] float-right hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z"/></svg>
                </button>
                <button @click="profileShow" class="mr-3 relative" >
                    <img src="/background/admin.png" class="rounded-full w-[35px] h-[35px]" title="profile" alt="profile Image">

                    <div v-show="profile" class="absolute bg-green-400 w-[200px] h-[150px] -right-1 top-11 pt-2 transition-all ease-in-out delay-150 flex flex-col justify-between">
                        <div>
                            <h1 class="text-3xl font-semibold">{{ user.username.toUpperCase() }}</h1>
                            <div class="flex items-center justify-center">
                                <small class="font-extrabold pr-2">Email: </small>
                                <h1 class="text-sm">{{user.email}}</h1>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <a href="/admin/setting" class="px-2 py-2 text-xs bg-green-700">Setting</a>
                            <a href="/admin/logout" class="px-2 py-2 text-xs bg-green-700">Logout</a>
                        </div>
                    </div>
                </button>
            </nav>

            <!-- section -->

            <div class="flex min-w-[1300px]  justify-around mt-4">
                <div class="card w-[330px] h-[120px] bg-blue-500 border-l-4 text-blue-800  border-solid border-l-blue-800">
                    <h1 class="text-4xl font-bold p-2 font-serif">Employees</h1>
                    <h1 class="pl-4 text-4xl font-bold">{{employee}}</h1>
                </div>

                <div class="card w-[330px] h-[120px] bg-yellow-500 border-l-4 text-yellow-800  border-solid border-l-yellow-800">
                    <h1 class="text-4xl font-bold p-2 font-serif">On Time</h1>
                    <h1 class="pl-4 text-4xl font-bold">{{ontime}}</h1>
                </div>

                <div class="card w-[330px] h-[120px] bg-red-500 border-l-4 text-red-800  border-solid border-l-red-800">
                    <h1 class="text-4xl font-bold p-2 font-serif">Late</h1>
                    <h1 class="pl-4 text-4xl font-bold">{{late}}</h1>
                </div>

                
            </div>
            <!-- section end -->
           
        </div>
    </div>
    
</template>

<script setup>
    import {ref, defineProps} from 'vue';

    // props
    const props = defineProps({
        user: Object
    });


    const profile = ref(false);
    const sidebar = ref(true);
    const employee = ref(0);
    const ontime = ref(0);
    const late = ref(0);
    const profileShow = () =>{
        profile.value = !profile.value;
    }
    const sidebarShow = () =>{
        sidebar.value = !sidebar.value;
    }

    document.title = "Dashboard | PMS"

    /* ################# MAIN CODE ########################*/ 
    const employees = () =>{
        axios.get('/api/admin/dashboard/employees')
                .then(res=>{
                    employee.value = res.data;
                })
    }
    employees();

    const status = () =>{
        axios.get('/api/admin/dashboard/attendances')
            .then(res=>{
                ontime.value = res.data.filter((value)=>{
                    return value.in_status == true;
                }).length;

                late.value = res.data.filter((value)=>{
                    return value.in_status == false;
                }).length;

                console.log(res.data)
            })
    }
    status();
</script>

<style> 

 
</style>