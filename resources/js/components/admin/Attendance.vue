<template>
    <div class="flex">
        <div id="alert" v-show="alertadd" class="absolute right-1 top-14 z-10">
            <div  class="alert f animate-fade-in-up animate-fade-in-down bg-green-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold  transition-all ease-in-out delay-150">
            <h1 class="text-green-900 font-bold">Time in Successfully!</h1>
             </div> 
        </div>
        <div id="alert" v-show="alertaO" class="absolute right-1 top-14 z-10">
            <div  class="alert f animate-fade-in-up animate-fade-in-down bg-green-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold  transition-all ease-in-out delay-150">
            <h1 class="text-green-900 font-bold">Time out Successfully!</h1>
             </div> 
        </div>
        <div id="alert" v-show="alertM" class="absolute right-1 top-14 z-10">
            <div  class="alert f animate-fade-in-up animate-fade-in-down bg-yellow-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold  transition-all ease-in-out delay-150">
            <h1 class="text-yellow-900 font-bold">Time in Already!</h1>
             </div> 
        </div>
        <div id="alert" v-show="alertF" class="absolute right-1 top-14 z-10">
            <div  class="alert f animate-fade-in-up animate-fade-in-down bg-yellow-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold  transition-all ease-in-out delay-150">
            <h1 class="text-yellow-900 font-bold">Not: Time in!</h1>
             </div> 
        </div>
        <div id="alert" v-show="alertOm" class="absolute right-1 top-14 z-10">
            <div  class="alert f animate-fade-in-up animate-fade-in-down bg-yellow-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold  transition-all ease-in-out delay-150">
            <h1 class="text-yellow-900 font-bold">Time out Already!</h1>
             </div> 
        </div>
        <div id="alert" v-show="alertdel" class="absolute right-1 top-14 z-10">
            <div  class="alert animate-fade-in-up animate-fade-in-down bg-red-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold mt-3 transition-all ease-in-out delay-150">
            <h1 class="text-red-900  font-bold">Deleted Successfully!</h1>
             </div> 
        </div>
        <div id="alert" v-show="alertupdate" class="absolute right-1 top-14 z-10">
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
                <li><a href="/admin/employees" class="sidebar-link ">Employee</a></li>
                <li><a href="/admin/attendances" class="activeLink">Attendance</a></li>
                <li><a href="/admin/department" class="sidebar-link">Department</a></li>
                <li><a href="/admin/positions" class="sidebar-link ">Positions</a></li>
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

                    <div v-show="profile" class="absolute z-10 bg-green-400 w-[200px] h-[150px] -right-1 top-11 pt-2 transition-all ease-in-out delay-150 flex flex-col justify-between">
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

            <div class=" w-full relative  ">
               
       
       
                <div class="w-[90%] mx-auto mb-2 pt-7 flex justify-between">
                    <button @click="modal = true" class="text-xs bg-green-400 hover:bg-green-300 text-green-900 px-3 py-2 rounded-md mr-2 font-extrabold">+</button>
                    <input type="date" v-on:change="searchs" v-model="search" class="px-2 py-2 bg-gray-100" placeholder="Search">
                </div>
                <!-- table -->
                <div class="w-[90%] mx-auto overflow-x-auto">
                    <table class="w-full  ">
                    <thead class="bg-gray-100 text-center">
                        <tr>
                            <th scope="col" class="py-3 px-3 font-bold">#</th>
                            <th scope="col" class="py-3 px-3 font-bold">EMPLOYEE ID</th>
                            <th scope="col" class="py-3 px-3 font-bold">FULLNAME</th>
                            <th scope="col" class="py-3 px-3 font-bold">CHECK-IN-TIME</th>
                            <th scope="col" class="py-3 px-3 font-bold">CHECK-OUT-TIME</th>
                            <th scope="col" class="py-3 px-3 font-bold">DATE</th>
                            <th scope="col" class="py-3 px-3 font-bold">Tools</th>
                            
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr class="border-b-2" v-for="attendance in attendances" :key="attendance.id">
                            <td class="text-xs py-2 px-2">{{ attendance.id }}</td>
                            <td class="text-xs py-2 px-2">{{attendance.employee.id}}</td>
                            <td class="text-xs py-2 px-2">{{ attendance.employee.firstname }} {{ attendance.employee.middlename == 'Null' ? '' : attendance.employee.middlename }} {{attendance.employee.lastname}}</td>
                            <td class="text-xs py-2 px-2">{{attendance.time_in}} 
                                <span v-if="attendance.in_status" class="text-[9px] px-1 rounded-md py-1 bg-yellow-200 text-yellow-700 font-extrabold">ONTIME</span>
                                <span v-else class="text-[9px] px-1 rounded-md py-1 bg-red-200 text-red-700 font-extrabold">LATE</span>
                            </td>
                            <td class="text-xs py-2 px-2">{{attendance.time_out}}
                                <span v-if="attendance.out_status" class="text-[9px] px-1 rounded-md py-1 bg-red-200 text-red-700 font-extrabold">EARLY</span>
                                <span v-if="attendance.time_out != null && attendance.out_status == false" class="text-[9px] px-1 rounded-md py-1 bg-yellow-200 text-yellow-700 font-extrabold">OVERTIME</span>
                            </td>
                            <td class="text-xs py-2 px-2">{{attendance.created_at}}</td>
                            <td class="text-xs py-2 px-2">
                                <button @click="attendanceEdit(attendance.id)" class="text-xs bg-green-200 hover:bg-green-300 text-green-900 px-2 py-1 rounded-md mr-2 font-extrabold">Update</button>
                                <form  v-on:submit.prevent="attendanceDelete(attendance.id)" class="inline-block">
                                    <button type="submit" class="text-xs bg-red-200 hover:bg-red-300 text-red-900 px-2 py-1 rounded-md font-extrabold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <tr v-if="attendances == ''">
                            <h1 class="text-red-500 text-3xl">No result!</h1>
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


                <!-- modal  -->
                <div v-show="modal" class="modal absolute w-full h-screen bg-[#0004] top-0 pt-32 ">
                    <div class="shadow-md w-[400px] mx-auto bg-[#ffffff] p-6 transition-all ease-in-out delay-150">
                        <h1 class="font-bold text-4xl font-sans">ADD ATTENDANCE</h1>

                        <!-- form -->
                        <div>
                            <div class="w-full flex justify-between flex-col mt-2">
                                <div class="w-full">
                                    <small class="font-semibold">EMPLOYEE ID</small>
                                    <input type="number"  v-model="emp_id" class="px-2 inline-block w-full  py-2 bg-gray-100 outline-none" :class="[errors.emp_id ? ' border-red-600 border-2' : '']" placeholder="ex: 132139133130" required>
                                </div>
                                <div class="w-full">
                                    <small v-show="!updateButton" class="font-semibold">TYPE</small>
                                    <select :class="[errors.type ? ' border-red-600 border-2' : '']"  v-show="!updateButton" required v-model="type" class="px-2 inline-block w-full   py-2 bg-gray-100 outline-none">
                                        <option value="" selected>-- Select --</option>
                                        <option value="0">TIME IN</option>
                                        <option value="1">TIME OUT</option>
                                    </select>
                                    <small v-show="updateButton" class="font-semibold">TIME IN</small>
                                    <input v-show="updateButton" type="datetime-local" v-model="dateTimeI"  pattern="MM-DD-YYYY hh:mm" class="px-2 inline-block w-full   py-2 bg-gray-100 outline-none" :class="[errors.lastname ? ' border-red-600 border-2' : '']" placeholder="Lastname">
                                </div>
                                <div class="w-full">
                                    <small v-show="!updateButton" class="font-semibold">DATE AND TIME</small>
                                    <small v-show="updateButton" class="font-semibold">TIME OUT</small>
                                    <input type="datetime-local"  v-model="dateTime"  pattern="MM-DD-YYYY hh:mm" class="px-2 inline-block w-full   py-2 bg-gray-100 outline-none" :class="[errors.dateTime ? ' border-red-600 border-2' : '']" placeholder="Lastname">
                                </div>
                                
                            </div>

                        </div>
                        <!-- buttons -->
                        <div class="mt-4">
                            <button v-if="updateButton" @click="updateAttendance" class="inline-block w-full px-2 py-2 bg-green-500">Update</button>
                            <button type="submit" v-else @click="addAttendance" class="inline-block w-full px-2 py-2 bg-blue-500">Submit</button>
                            <button @click="modalClose" class="inline-block w-full px-2 py-2 bg-red-500 mt-2">Close</button>
                        </div>
                    </div>
                    
                </div>

                 <!-- lazy loading -->
                <div v-show="lazy" class="absolute min-w-full min-h-[96vh] top-0 flex justify-center items-center bg-[#0004]">
                       <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin w-[40px] fill-white mr-2" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M304 48C304 74.51 282.5 96 256 96C229.5 96 208 74.51 208 48C208 21.49 229.5 0 256 0C282.5 0 304 21.49 304 48zM304 464C304 490.5 282.5 512 256 512C229.5 512 208 490.5 208 464C208 437.5 229.5 416 256 416C282.5 416 304 437.5 304 464zM0 256C0 229.5 21.49 208 48 208C74.51 208 96 229.5 96 256C96 282.5 74.51 304 48 304C21.49 304 0 282.5 0 256zM512 256C512 282.5 490.5 304 464 304C437.5 304 416 282.5 416 256C416 229.5 437.5 208 464 208C490.5 208 512 229.5 512 256zM74.98 437C56.23 418.3 56.23 387.9 74.98 369.1C93.73 350.4 124.1 350.4 142.9 369.1C161.6 387.9 161.6 418.3 142.9 437C124.1 455.8 93.73 455.8 74.98 437V437zM142.9 142.9C124.1 161.6 93.73 161.6 74.98 142.9C56.24 124.1 56.24 93.73 74.98 74.98C93.73 56.23 124.1 56.23 142.9 74.98C161.6 93.73 161.6 124.1 142.9 142.9zM369.1 369.1C387.9 350.4 418.3 350.4 437 369.1C455.8 387.9 455.8 418.3 437 437C418.3 455.8 387.9 455.8 369.1 437C350.4 418.3 350.4 387.9 369.1 369.1V369.1z"/></svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {ref, onMounted} from 'vue';
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
    document.title = "Attendance | PMS"



    const modalClose = () =>{
        modal.value = false;
        updateButton.value = false;
        errors.value = '';
        emp_id.value = '';
        type.value = '';
        dateTime.value = '';


    }

    const search = ref('');



    const searchs = () =>{
            attendances.value = subattendances.value;
            if(search.value == '')
            {
                fetch();
            }else{
                var data = attendances.value.filter((value)=>{
                return value.created_at == search.value;
            });

            attendances.value = data
        }
        
    };


    /*##################### code ##################*/

    // creadencials
    const emp_id = ref(null);
    const type = ref('');
    const dateTimeI = ref(null);
    const dateTime = ref(null);

    const attendances = ref([]);
    const subattendances = ref([]);
    const alertadd = ref(false);
    const alertM = ref(false);
    const alertaO = ref(false);
    const alertOm = ref(false);
    const alertO = ref(false);
    const alertF = ref(false);
    const alertdel = ref(false);
    const alertupdate = ref(false);
    const updateButton = ref(false);
    const attenEdit = ref([]);
    const total = ref(0);
    const page = ref(1);

    const modal = ref(false);
    const lazy = ref(false);
    const errors = ref([]);



    //add Employee
    const addAttendance = (e) =>{
        e.preventDefault();

        axios.post('/api/admin/attendance',{'emp_id':emp_id.value, 'type':type.value, 'dateTime':dateTime.value})
             .then(res =>{
                if(res.status == 201)
                {
                    
                    fetch();
                    alertadd.value = true;
                    emp_id.value = '';
                    type.value = '';
                    dateTime.value = '';
                    modal.value = false;
                    setTimeout(function(){
                        alertadd.value = false;
                    },2500)
                }else if(res.status == 202){
                    alertM.value = true;
                    setTimeout(function(){
                        alertM.value = false;
                    },2500)
                }else if(res.status == 203){
                    alertO.value = true;
                    fetch();
                     modal.value = false;
                    setTimeout(function(){
                        alertO.value = false;
                    },2500)
                }else if(res.status == 204){
                    alertOm.value = true;
                    setTimeout(function(){
                        alertOm.value = false;
                    },2500)
                }else if(res.status == 206){
                    alertF.value = true;
                    setTimeout(function(){
                        alertF.value = false;
                    },2500)
                }
             }).catch(err =>{
                errors.value = err.response.data.errors;
             })
    }

    // delete Employee
    const attendanceDelete = (id) =>{
       axios.delete(`/api/admin/attendance/${id}`)
            .then(res =>{
                alertdel.value = true;
                fetch();

                 setTimeout(function(){
                        alertdel.value = false;
                },3000)
            })
    }

    // update Employee
    const attendanceEdit = (id) =>
    {
    
       var data =  attendances.value.filter((value)=>{
            return value.id == id
        });
        updateButton.value = true;
        attenEdit.value = data[0].id;
        emp_id.value = data[0].emp_id;
        dateTimeI.value = data[0].created_at+'T'+data[0].time_in;
        dateTime.value = data[0].created_at+'T'+data[0].time_out;
        
        // showPosition()
        modal.value = true;

    }

    const updateAttendance = () =>{
        if(attenEdit.value != null)
        {
               
                axios.put(`/api/admin/attendance/${attenEdit.value}/update`, {'emp_id':emp_id.value, 'time_in':dateTimeI.value, 'time_out':dateTime.value})
                .then(res =>{
                    if(res.status == 200)
                    {
                         
                        alertupdate.value = true;
                        modal.value = false;
                        updateButton.value = false;
                        dateTime.value = '';
                        emp_id.value = '';
                        type.value ='';
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
        axios.get('/api/admin/attendances?page='+pageNum)
             .then(res=>{
               page.value = pageNum;
               attendances.value = res.data.data;
               subattendances.value = res.data.data;
               total.value = res.data.last_page;
                
               setTimeout(()=>{
                    lazy.value = false;
               },700)
             })
    }
    
    onMounted(()=>{
        fetch();
    });



</script>

<style scoped> 
 
    

</style>