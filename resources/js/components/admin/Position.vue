<template>
    <div class="flex">
        <div id="alert" v-show="alertadd" class="absolute right-1 top-14 z-30">
            <div  class="alert f animate-fade-in-up animate-fade-in-down bg-green-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold  transition-all ease-in-out delay-150">
            <h1 class="text-green-900 font-bold">Success</h1>
             </div> 
        </div>
        <div id="alert" v-show="alertdel" class="absolute right-1 top-14 z-30">
            <div  class="alert animate-fade-in-up animate-fade-in-down bg-red-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold mt-3 transition-all ease-in-out delay-150">
            <h1 class="text-red-900  font-bold">Deleted Successfully!</h1>
             </div> 
        </div>
        <div id="alert" v-show="alertupdate" class="absolute right-1 top-14 z-30">
            <div  class="alert animate-fade-in-up animate-fade-in-down bg-green-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold mt-3 transition-all ease-in-out delay-150">
            <h1 class="text-green-900  font-bold">Updated Successfully!</h1>
             </div> 
        </div>
        <div v-show="sidebar" class="l min-w-[260px]  max-w-[260px] h-screen bg-green-400 shadow-lg" >
            <h1 class="text-7xl font-extrabold text-white text-center">
                <span class="text-yellow-400">P</span>
                <span class="text-red-400">M</span>
                <span class="text-blue-400">S</span>
            </h1>

            <ul class="px-2.5 mt-2">
                <li><a href="/admin/dashboard" class="sidebar-link">Dashboard</a></li>
                <li><a href="/admin/employees" class="sidebar-link">Employee</a></li>
                <li><a href="/admin/attendances" class="sidebar-link">Attendance</a></li>
                <li><a href="/admin/department" class="sidebar-link">Department</a></li>
                <li><a href="/admin/positions" class=" activeLink">Positions</a></li>
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
                <button @click="profileShow" class="mr-3 relative z-30" >
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

            <div class="flex w-full justify-around relative">
               
                <!-- form -->
                <div  class="bg-[#ffffff] mt-8 flex flex-col items-center rounded-md shadow-lg w-[430px] max-h-[250px]">
                    <h1 class="text-center text-3xl font-serif font-semibold p-2 bg-green-700 w-full text-white uppercase">Add Positions</h1>
                    <div class="px-4 w-full mt-4">
                        <select v-model="departmentName" class="px-2 w-full py-2 inline-block bg-gray-100 outline-none">
                            <option value="" selected>-- Select Department --</option>
                            <option v-for="department in departments" :key="department.id" :value="department.id" >{{department.dep_name}}</option>
                        </select>
                    </div>
         
                     <div class="px-4 w-full mt-2">
                        <input type="text" v-model="positionName" class="px-2 w-full py-2 inline-block bg-gray-100 outline-none" placeholder="Position Name">
                    </div>
                    <div class="px-4 w-full mt-2 mb-4">
                        <button type="button" v-if="updateButton" @click="updatePosition" class="px-2 hover:bg-green-600 w-full py-3 inline-block bg-green-500 text-xs">
                            <span >UPDATE</span>
                           
        
                        </button>
                        <button type="button" v-else @click="addPosition" class="px-2 hover:bg-green-600 w-full py-3 inline-block bg-green-500 text-xs">
                    
                            <span>ADD</span>
        
                        </button>
                    </div>
                   
                </div>

                <!-- table -->
                <div class="w-[700px] mt-8 overflow-hidden">
                    <table class="w-[600px] ">
                    <thead class="bg-gray-100 text-center">
                        <tr>
                            <th scope="col" class="py-3 px-3 font-bold">#</th>
                            <th scope="col" class="py-3 px-3 font-bold">Position Name</th>
                            <th scope="col" class="py-3 px-3 font-bold">Department Name</th>
                            <th scope="col" class="py-3 px-3 font-bold">Tools</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr class="border-b-2" v-for="position in positions" :key="position.id">
                            <td class=" py-2 px-2 text-xs">{{ position.id  }}</td>
                            <td class=" py-2 px-2 text-xs">{{ position.pos_name}}</td>
                            <td class=" py-2 px-2 text-xs">{{ position.departments.dep_name}}</td>
                            <td class=" py-2 px-2 text-xs">
                                <button @click="positionEdit(position.id)" class="text-xs bg-green-200 hover:bg-green-300 text-green-900 px-2 py-1 rounded-md mr-2 font-extrabold">Update</button>
                                <form v-on:submit.prevent="departmentDelete(position.id)" class="inline-block">
                                    <button type="submit" class="text-xs bg-red-200 hover:bg-red-300 text-red-900 px-2 py-1 rounded-md font-extrabold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        
                    </tbody>
                    
                </table>
                <paginate
                    v-model="page"
                    :page-count="total"
                    :page-range="4"
                    :margin-pages="2"
                    :click-handler="fetch"
                    :prev-text="'Prev'"
                    :next-text="'Next'"
                    :container-class="'pagination'"
                    :page-class="'page-item'"

                            >   
                </paginate>
                </div>

                 <!-- lazy loading -->
                <div v-show="lazy" class="absolute min-w-full min-h-[94vh] z-20 top-0 flex justify-center items-center bg-[#0004]">
                       <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin w-[40px] fill-white mr-2" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M304 48C304 74.51 282.5 96 256 96C229.5 96 208 74.51 208 48C208 21.49 229.5 0 256 0C282.5 0 304 21.49 304 48zM304 464C304 490.5 282.5 512 256 512C229.5 512 208 490.5 208 464C208 437.5 229.5 416 256 416C282.5 416 304 437.5 304 464zM0 256C0 229.5 21.49 208 48 208C74.51 208 96 229.5 96 256C96 282.5 74.51 304 48 304C21.49 304 0 282.5 0 256zM512 256C512 282.5 490.5 304 464 304C437.5 304 416 282.5 416 256C416 229.5 437.5 208 464 208C490.5 208 512 229.5 512 256zM74.98 437C56.23 418.3 56.23 387.9 74.98 369.1C93.73 350.4 124.1 350.4 142.9 369.1C161.6 387.9 161.6 418.3 142.9 437C124.1 455.8 93.73 455.8 74.98 437V437zM142.9 142.9C124.1 161.6 93.73 161.6 74.98 142.9C56.24 124.1 56.24 93.73 74.98 74.98C93.73 56.23 124.1 56.23 142.9 74.98C161.6 93.73 161.6 124.1 142.9 142.9zM369.1 369.1C387.9 350.4 418.3 350.4 437 369.1C455.8 387.9 455.8 418.3 437 437C418.3 455.8 387.9 455.8 369.1 437C350.4 418.3 350.4 387.9 369.1 369.1V369.1z"/></svg>
                </div>


            </div>
        </div>
    </div>
</template>

<script setup>
    import {ref, defineProps} from 'vue';
    import Paginate from 'vuejs-paginate-next';
    // global code
    const props = defineProps({
        user: Object
    });


    const profile = ref(false);
    const sidebar = ref(true);
    const profileShow = () =>{
        profile.value = !profile.value;
    }
    const sidebarShow = () =>{
        sidebar.value = !sidebar.value;
    }
    document.title = "Positions | PMS"

    // code
    const departmentName = ref('');
    const positionName = ref('');
    const departments = ref([]);
    const positions = ref([]);
    const alertadd = ref(false);
    const alertdel = ref(false);
    const alertupdate = ref(false);
    const updateButton = ref(false);
    const posEdit = ref([]);
    const total = ref(0);
    const page = ref(1);


    const lazy = ref(true)
    const allDepartment = () =>{
        axios.get('/api/admin/departments')
            .then(res=>{
                departments.value = res.data;
            })
    }
    allDepartment();

    //add Department
    const addPosition = (e) =>{
        e.preventDefault();
        axios.post('/api/admin/position',{'departmentName':departmentName.value, 'positionName': positionName.value})
             .then(res =>{
                if(res.status == 201)
                {
                    alertadd.value = true;
                    departmentName.value = '';
                    positionName.value = '';
                    fetch();
                    
                    setTimeout(function(){
                        alertadd.value = false;
                    },2500)
                }
             })
    }

    // delete department
    const departmentDelete = (id) =>{
       axios.delete(`/api/admin/position/${id}`)
            .then(res =>{
                alertdel.value = true;
                fetch();

                 setTimeout(function(){
                        alertdel.value = false;
                    },2500)
            })
    }

    // update Department
    const positionEdit = (id) =>
    {
    
       var data =  positions.value.filter((value)=>{
            return value.id == id
        });

        updateButton.value = true;
        posEdit.value = data[0].id;
        departmentName.value = data[0].departments.id;
        positionName.value = data[0].pos_name;


    }

    const updatePosition = (e) =>{
        e.preventDefault();
        if(posEdit.value != null)
        {
            console.log(posEdit.value);
            axios.put(`/api/admin/position/${posEdit.value}/edit`,{'departmentName':departmentName.value, 'positionName': positionName.value})
                .then(res =>{
                    if(res.status == 200)
                    {

                        alertupdate.value = true;
                        updateButton.value = false;
                        departmentName.value = '';
                        positionName.value = '';
                        fetch();

                        setTimeout(function(){
                            alertupdate.value = false;
                        },2500)
                    }
                })
        }
    }
   
    const fetch = (pageNum = page.value) =>{
        lazy.value = true;
        axios.get('/api/admin/position?page='+pageNum)
             .then(res=>{
               page.value = pageNum;
               positions.value = res.data.data;
               total.value = res.data.last_page;
              
              setTimeout(()=>{
                lazy.value = false;
              },700);
             })
    }
    
    fetch();



</script>

<style scoped> 
 
    

</style>