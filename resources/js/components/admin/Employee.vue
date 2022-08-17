<template>
    <div class="flex">
        <div id="alert" v-show="alertadd" class="absolute right-1 top-14 z-10">
            <div  class="alert f animate-fade-in-up animate-fade-in-down bg-green-400 h-[40px] w-[200px] rounded-md flex items-center pl-4 font-bold  transition-all ease-in-out delay-150">
            <h1 class="text-green-900 font-bold">Success</h1>
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
                <li><a href="/admin/employees" class="activeLink">Employee</a></li>
                <li><a href="/admin/attendances" class="sidebar-link">Attendance</a></li>
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
                    <input type="text" @change="searchs" v-model="search" class="px-2 py-2 bg-gray-100" placeholder="Search">
                </div>
                <!-- table -->
                <div class="w-[90%] mx-auto overflow-x-auto">
                    <table class="w-full  ">
                    <thead class="bg-gray-100 text-center">
                        <tr>
                            <th scope="col" class="py-3 px-3 font-bold">#</th>
                            <th scope="col" class="py-3 px-3 font-bold">Photo</th>
                            <th scope="col" class="py-3 px-3 font-bold">Fullname</th>
                            <th scope="col" class="py-3 px-3 font-bold">Location</th>
                            <th scope="col" class="py-3 px-3 font-bold">Number</th>
                            <th scope="col" class="py-3 px-3 font-bold">Email</th>
                            <th scope="col" class="py-3 px-3 font-bold">Department</th>
                            <th scope="col" class="py-3 px-3 font-bold">Position</th>
                            <th scope="col" class="py-3 px-3 font-bold">Salary</th>
                            <th scope="col" class="py-3 px-3 font-bold">Tools</th>
                            
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr class="border-b-2" v-for="employee in employees" :key="employee.id">
                            <td class="text-xs py-2 px-2">{{ employee.id }}</td>
                            <td class=" py-2 px-2 "><img :src="'/employees-image/'+employee.photo" class="w-[50px] h-[30px] inline-block" alt=""></td>
                            <td class="text-xs py-2 px-2">{{ employee.firstname }} {{ employee.middlename == 'Null' ? '' : employee.middlename }} {{employee.lastname}}</td>
                            <td class="text-xs py-2 px-2">{{employee.location}}</td>
                            <td class="text-xs py-2 px-2">{{employee.number}}</td>
                            <td class="text-xs py-2 px-2">{{employee.email}}</td>
                            <td class="text-xs py-2 px-2">{{employee.department.dep_name}}</td>
                            <td class="text-xs py-2 px-2">{{employee.position.pos_name}}</td>
                            <td class="text-xs py-2 px-2">P{{employee.salary}}</td>
                            <td class="text-xs py-2 px-2">
                                <button @click="printId(employee.id)" class="text-xs bg-blue-200 hover:bg-blue-300 text-blue-900 px-2 py-1 rounded-md mr-2 font-extrabold">Print ID</button>
                                <button @click="employeeEdit(employee.id)" class="text-xs bg-green-200 hover:bg-green-300 text-green-900 px-2 py-1 rounded-md mr-2 font-extrabold">Update</button>
                                <form  v-on:submit.prevent="employeeDelete(employee.id)" class="inline-block">
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

                <div id="ids" style="display:none">
                    <div class="mains" style="width:92mm;height:60mm;background: #22c55e;">
                        <h1 class="title" style="line-height:50px;background:#16a34a;text-align: center;font-family: sans-serif;font-size: 19px;font-weight: 600;">Company Name</h1>
                        <div >
                        <div class="container" style="display: flex;align-items: center;padding-left: 4px;">
                            <img class="emp_image" src="" alt="">
                         
                            <div class="details" style="margin-left: 10px;">
                            <div class="text" style="font-size: 14px;"><strong>Name:</strong> {{ idName }}</div>
                            <div class="text" style="font-size: 14px;"><strong>Number:</strong> {{ idNumber }}</div>
                            <div class="text" style="font-size: 14px;"><strong>Email:</strong>{{ idEmail }}</div>
                            <div class="text" style="font-size: 14px;"><strong>Department:</strong> {{ idDepartment }}</div>
                           
                            </div>
                        </div>
                        <img id="barcodeImg" src="">
                        </div>
                        <vue-barcode  id="barcode"  :value="idId == '' ? 'hellow' : idId" :options="{ displayValue: false, height: 100,width:1,background:'#0001' }"></vue-barcode>
                    </div>
                </div>
                </div>


                <!-- modal  -->
                <div v-show="modal" class="modal absolute w-full h-screen bg-[#0004] top-0 pt-32 ">
                    <div class="shadow-md w-[700px] mx-auto bg-[#ffffff] p-6 transition-all ease-in-out delay-150">
                        <h1 class="font-bold text-4xl font-sans">ADD EMPLOYEE</h1>

                        <!-- form -->
                        <div>
                            <div class="w-full flex justify-between mt-2">
                                <div class="w-[30%]">
                                    <small class="font-semibold">Firstname</small>
                                    <input type="text" v-model="firstname" class="px-2  py-2 bg-gray-100 outline-none" :class="[errors.firstname ? ' border-red-600 border-2' : '']" placeholder="Firstname">
                                </div>
                                <div class="w-[30%]">
                                    <small class="font-semibold">Middlename</small>
                                    <input type="text" v-model="middlename" class="px-2  py-2 bg-gray-100 outline-none" placeholder="Middlename(Optional)">
                                </div>
                                <div class="w-[30%]">
                                    <small class="font-semibold">Lastname</small>
                                    <input type="text" v-model="lastname" class="px-2  py-2 bg-gray-100 outline-none" :class="[errors.lastname ? ' border-red-600 border-2' : '']" placeholder="Lastname">
                                </div>
                                
                            </div>

                            <div class="w-full flex justify-between mt-2">
                                <div class="w-[30%]">
                                    <small class="font-semibold">Location</small>
                                    <input type="text" v-model="location" class="px-2  py-2 bg-gray-100 outline-none" :class="[errors.location ? ' border-red-600 border-2' : '']" placeholder="Location">
                                </div>
                                <div class="w-[30%]">
                                    <small class="font-semibold">Number</small>
                                    <input type="tel" v-model="number" class="px-2  py-2 bg-gray-100 outline-none" :class="[errors.number ? ' border-red-600 border-2' : '']" placeholder="Number">
                                </div>
                                <div class="w-[30%]">
                                    <small class="font-semibold">Email</small>
                                    <input type="email" v-model="email" class="px-2  py-2 bg-gray-100 outline-none" :class="[errors.email ? ' border-red-600 border-2' : '']" placeholder="Email">
                                </div>
                                
                            </div>

                             <div class="w-full flex justify-between mt-2">
                                <div class="w-[30%]">
                                    <small class="font-semibold">Department</small>
                                    <select v-model="departmentName" @change="showPosition" :class="[errors.departmentName ? ' border-red-600 border-2' : '']" class="px-2  inline-block w-full py-2 bg-gray-100 outline-none">
                                        <option value="" selected>-- Department --</option>
                                        <option v-for="department in departments" :key="department.id" :value="department.id">{{department.dep_name}}</option>
                                    </select>
                                </div>
                                <div class="w-[30%]">
                                    <small class="font-semibold">Position</small>
                                    <select v-model="positionName" class="px-2   w-full py-2 bg-gray-100 outline-none" :class="[errors.positionName ? ' border-red-600 border-2' : '']">
                                        <option value="">--select</option>
                                        <option v-for="position in positions" :key="position.id" :value="position.id">{{position.pos_name}}</option>
                                    </select>
                                </div>
                                
                                <div class="w-[30%]">
                                    <small class="font-semibold">Salary</small>
                                    <input type="number" v-model="salary" min="0" class="px-2  py-2 bg-gray-100 outline-none" :class="[errors.salary ? ' border-red-600 border-2' : '']" placeholder="Salary">
                                </div>
                            </div>

                             <div class="w-full flex justify-between mt-2">
                                
                                <div class="w-[30%] ">
                                    <small class="font-semibold">Photo</small>
                                    <input type="file" id="file"  @change="files" :class="[errors.photo ? ' border-red-600 border-2' : '']" class="w-full px-2 py-1 bg-gray-100 outline-none" >
                                </div>
                                
                            </div>
                        </div>
                        <!-- buttons -->
                        <div class="mt-6">
                            <button v-if="updateButton" @click="updateEmployee" class="inline-block w-full px-2 py-2 bg-green-500">Update</button>
                            <button v-else @click="addEmployee" class="inline-block w-full px-2 py-2 bg-blue-500">Submit</button>
                            <button @click="modalClose" class="inline-block w-full px-2 py-2 bg-red-500 mt-2">Close</button>
                        </div>
                    </div>
                    
                </div>

                <!-- lazy loading -->
                <div v-show="lazy" class="absolute min-w-full min-h-[96vh] top-0 flex justify-center items-center bg-[#0004]">
                       <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin w-[40px] fill-white mr-2" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M304 48C304 74.51 282.5 96 256 96C229.5 96 208 74.51 208 48C208 21.49 229.5 0 256 0C282.5 0 304 21.49 304 48zM304 464C304 490.5 282.5 512 256 512C229.5 512 208 490.5 208 464C208 437.5 229.5 416 256 416C282.5 416 304 437.5 304 464zM0 256C0 229.5 21.49 208 48 208C74.51 208 96 229.5 96 256C96 282.5 74.51 304 48 304C21.49 304 0 282.5 0 256zM512 256C512 282.5 490.5 304 464 304C437.5 304 416 282.5 416 256C416 229.5 437.5 208 464 208C490.5 208 512 229.5 512 256zM74.98 437C56.23 418.3 56.23 387.9 74.98 369.1C93.73 350.4 124.1 350.4 142.9 369.1C161.6 387.9 161.6 418.3 142.9 437C124.1 455.8 93.73 455.8 74.98 437V437zM142.9 142.9C124.1 161.6 93.73 161.6 74.98 142.9C56.24 124.1 56.24 93.73 74.98 74.98C93.73 56.23 124.1 56.23 142.9 74.98C161.6 93.73 161.6 124.1 142.9 142.9zM369.1 369.1C387.9 350.4 418.3 350.4 437 369.1C455.8 387.9 455.8 418.3 437 437C418.3 455.8 387.9 455.8 369.1 437C350.4 418.3 350.4 387.9 369.1 369.1V369.1z"/>
                       </svg>
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
    document.title = "Employees | PMS"



    const modalClose = () =>{
        modal.value = false;
        updateButton.value = false;
        errors.value = '';
                        departmentName.value = '';
                        positionName.value = '';
                        firstname.value = '';
                        middlename.value = '';
                        lastname.value = '';
                        location.value = '';
                        number.value = '';
                        email.value = '';
                        salary.value = '';
                        photo.value = '';
                        document.querySelector('#file').value = '';
    }

    const search = ref('');

    const searchs = () =>{
        if(search.value == '')
        {
            fetch();
        }else{
            var data = employees.value.filter((value)=>{
            return value.id == search.value;
        });

        employees.value = data
        }
        
    };


    /*##################### code ##################*/

    // creadencials
    const departmentName = ref('');
    const positionName = ref('');
    const firstname = ref('');
    const middlename = ref(null);
    const lastname = ref('');
    const location = ref('');
    const number = ref('');
    const email = ref('');
    const salary = ref('');
    const photo = ref('');
    const oldphoto = ref('');



    const departments = ref([]);
    const positions = ref([]);
    const employees = ref([]);
    const alertadd = ref(false);
    const alertdel = ref(false);
    const alertupdate = ref(false);
    const updateButton = ref(false);
    const posEdit = ref([]);
    const total = ref(0);
    const page = ref(1);

    const modal = ref(false);
    const errors = ref([]);
    const lazy = ref(false);


    // id details
    const idName = ref('');
    const idNumber = ref('');
    const idEmail = ref('');
    const idDepartment = ref('');
    const idPosition = ref('');
    const idId = ref('');
    const allDepartment = () =>{
        axios.get('/api/admin/department/all')
            .then(res=>{
                departments.value = res.data;
                
            })
    }
    allDepartment();

    const showPosition = () =>{
        var data = departments.value.filter((value)=>{
            return value.id == departmentName.value;
        }); 
        positions.value = data[0].positions;
    }

    const files = (e) =>{
        photo.value = e.target.files[0];
    }

    // print ID
    const printId = (id)=>{
        const emp = employees.value.filter((value)=>{
            return value.id == id;
        });
        idName.value = `${emp[0].firstname} ${ emp[0].middlename == 'Null' ? '' : emp[0].middlename } ${emp[0].lastname}`;
        idNumber.value = emp[0].number;
        idId.value =  emp[0].id;
        idEmail.value = emp[0].email;
        idDepartment.value = emp[0].department.dep_name;
        idPosition.value = emp[0].position.pos_name;
        setTimeout(()=>{
            printIds(emp);
        },1000)
    
    }
    const printIds = (emp) =>{
        var divContents = document.getElementById("ids").innerHTML;
        var canvas = document.querySelector('#barcode').toDataURL();
            var a = window.open('', '', 'height=700, width=900');
            a.document.write(`<html>
        <style> 

            @media print
                {
                    * { -webkit-print-color-adjust: exact !important;
                        color-adjust: exact !important;
                        print-color-adjust: exact !important;

                    }
                    .emp_image{
                        content:url('/employees-image/${emp[0].photo}');
                    }
                    #barcodeImg{
                        content:url('${canvas}');
                    }

                }
        
            .mains{
                width: 92mm;
                height: 60mm;
                background: #22c55e;
                
            }
            .title{
                line-height:30px;
                background: #16a34a;
                text-align: center;
                font-family: sans-serif;
                font-size: 19px;
                font-weight: 600;
            }
            .container{
                display: flex;
                align-items: center;
                margin-left:10px;
                
            }
            .emp_image{
                width: 70px;
                height: 70px;
                border: 2px solid black;
                
                // border-radius: 50%;
            }
            .text{
                font-size: 14px;
            }
            .details{
                margin-left: 10px;
            }
            #barcode{
                width: 100%;
                height: 70px;
                display:none;
            }
            #barcodeImg{
                margin-top:18px;
                width: 100%;
                height: 50px;
                content:url('${canvas}');
            }
            
        </style>
                `);
            a.document.write(`<body> 

                `);
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
            a.close();
    }
    //add Employee
    const addEmployee = (e) =>{
        e.preventDefault();
        var data = new FormData();
        const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
        data.append('departmentName',departmentName.value);
        data.append('positionName',positionName.value);
        data.append('firstname',firstname.value);
        data.append('middlename',middlename.value);
        data.append('lastname',lastname.value);
        data.append('location',location.value);
        data.append('number',number.value);
        data.append('email',email.value);
        data.append('salary',salary.value);
        data.append('photo',photo.value);
        axios.post('/api/admin/employee',data,config)
             .then(res =>{
                if(res.status == 201)
                {
                    alertadd.value = true;
                    departmentName.value = '';
                    positionName.value = '';
                    firstname.value = '';
                    middlename.value = '';
                    lastname.value = '';
                    location.value = '';
                    number.value = '';
                    email.value = '';
                    salary.value = '';
                    photo.value = '';
                    document.querySelector('#file').value = '';
                    fetch();
                    
                    setTimeout(function(){
                        alertadd.value = false;
                    },2500)
                }
             }).catch(err =>{
                errors.value = err.response.data.errors;
             })
    }

    // delete Employee
    const employeeDelete = (id) =>{
       axios.delete(`/api/admin/employee/${id}`)
            .then(res =>{
                alertdel.value = true;
                fetch();

                 setTimeout(function(){
                        alertdel.value = false;
                    },2500)
            })
    }

    // update Employee
    const employeeEdit = (id) =>
    {
    
       var data =  employees.value.filter((value)=>{
            return value.id == id
        });
        updateButton.value = true;
        posEdit.value = data[0].id;
        departmentName.value = data[0].dep_id;
        positionName.value = data[0].pos_id;
        firstname.value = data[0].firstname;
        middlename.value = data[0].middlename;
        lastname.value = data[0].lastname;
        location.value = data[0].location;
        number.value = data[0].number;
        email.value = data[0].email;
        salary.value = data[0].salary;
        oldphoto.value = data[0].photo;
        showPosition()
        modal.value = true;

    }

    const updateEmployee = () =>{
        if(posEdit.value != null)
        {
                const data = new FormData();
                const config = {
                            headers: { 'content-type': 'multipart/form-data' }
                        }
                data.append('departmentName',departmentName.value);
                data.append('positionName',positionName.value);
                data.append('firstname',firstname.value);
                data.append('middlename',middlename.value);
                data.append('lastname',lastname.value);
                data.append('location',location.value);
                data.append('number',number.value);
                data.append('email',email.value);
                data.append('salary',salary.value);
                data.append('photo',photo.value);
                data.append('oldphoto',oldphoto.value);
                axios.post(`/api/admin/employees/${posEdit.value}/update`, data,config)
                .then(res =>{
                    if(res.status == 200)
                    {
                         fetch();
                        alertupdate.value = true;
                        modal.value = false;
                        updateButton.value = false;
                       
                        

                        setTimeout(function(){
                            alertupdate.value = false;
                        },2500)
                    }
                })
        }
    }
   
    const fetch = (pageNum = page.value) =>{
        lazy.value = true;
        axios.get('/api/admin/employees?page='+pageNum)
             .then(res=>{
               page.value = pageNum;
               employees.value = res.data.data;
               total.value = res.data.last_page;
              setTimeout(()=>{
                lazy.value = false;
              },700)
             })

    }
    
    fetch();



</script>

<style scoped> 

    

</style>