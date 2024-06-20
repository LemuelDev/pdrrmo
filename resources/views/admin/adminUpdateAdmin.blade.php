@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        @include('admin.adminSidebar')
        
        <div class="flex-grow px-4 pt-8 h-auto border-solid">
                 
            @include('shared.navbar')

           
            <div class="pt-16 pl-8 max-md:pt-8 max-md:pl-0">
                <h4 class="text-2xl font-bold max-md:text-center">EDIT ADMIN:</h4>
           </div>

           
 <div class="pt-4 pl-8 max-w-[1200px] gap-4 max-md:p-4 max-md:flex-col-reverse max-md:px-0">
    <form action="{{route('admin.update-admin', $admin->userProfile->id)}}" method="post" class="grid grid-cols-2 gap-8 px-12 pt-8  max-lg:px-6 max-md:px-4 max-sm:grid-cols-1 max-sm:max-w-[500px] max-sm:mx-auto">
        @csrf
        @method('put')
        <div class="grid">
            <label for="username" class="text-lg font-bold pb-4">
                USERNAME:
            </label>
            <input type="text" name="username" readonly id="username" value="{{$admin->username}}"placeholder="Username..." class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
       </div>
       <div class="grid">
            <label for="name" class="text-lg font-bold pb-4">
                EMAIL:
            </label>
            <input type="text" name="email" readonly placeholder="Name..." value="{{$admin->userProfile->email}}"class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
        </div>
       <div class="grid">
        <label for="user_type" class="text-lg font-bold pb-4">
            USER_TYPE:
        </label>
            <select name="user_type" id=""  class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                <option value="staff" {{ $admin->userProfile->user_type == 'staff' ? 'selected' : '' }}>staff</option>
                <option value="admin" {{ $admin->userProfile->user_type == 'admin' ? 'selected' : '' }}>admin</option>
                
            </select>
        </div>
        <div class="grid">
            <label for="user_status" class="text-lg font-bold pb-4">
                USER_STATUS:
            </label>
                <select name="user_status" id=""  class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                    <option value="active" {{ $admin->userProfile->user_status == 'active' ? 'selected' : '' }}>active</option>
                    <option value="inactive" {{ $admin->userProfile->user_status == 'inactive' ? 'selected' : '' }}>inactive</option>
                </select>
        </div>
        <div class="grid">
            <label for="user_status" class="text-lg font-bold pb-4">
                APPROVAL:
            </label>
                <select name="isPending" id=""  class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                    <option value="approve" {{ $admin->userProfile->isPending == 'approved' ? 'selected' : '' }}>approve</option>
                    <option value="pending" {{ $admin->userProfile->isPending == 'pending' ? 'selected' : '' }}>pending</option>
                </select>
        </div>
       
       <button type="submit" class="py-3 text-xl px-7 mt-11  border-r-full border-none bg-green-500 hover:bg-green-600 text-white rounded-lg max-h-[50px] max-w-[200px] max-sm:mx-auto max-sm:px-12">UPDATE</button>
        </form>
        @if ($errors->any())
        
        <div class="grid mt-7">
            @foreach ($errors->all() as $error)
               <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
            @endforeach
        </div>

        @endif
</div> 

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuIcon = document.getElementById('menu-icon');
                const sidebar = document.getElementById('sidebar');
                const closeButton = document.getElementById('sidebar-close');

                // Function to toggle sidebar visibility
                function toggleSidebar() {
                    sidebar.classList.toggle('-translate-x-full');
                }

                // Function to close the sidebar
                function closeSidebar() {
                    sidebar.classList.add('-translate-x-full');
                }

                // Event listener for menu icon click to toggle sidebar
                menuIcon.addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent click event from reaching the body
                    toggleSidebar();
                });

                // Event listener for close button inside the sidebar
                closeButton.addEventListener('click', closeSidebar);

                // Event listener for body click to hide sidebar when clicking outside
                document.body.addEventListener('click', function(event) {
                    // If the click is outside the sidebar and menu icon, hide the sidebar
                    if (!sidebar.contains(event.target) && !menuIcon.contains(event.target)) {
                        closeSidebar();
                    }
                });

                // Prevent clicks inside the sidebar from propagating to the body
                sidebar.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });

        </script>
    </section>

@endsection
