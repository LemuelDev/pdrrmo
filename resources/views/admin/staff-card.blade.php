@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        <div class="grid content-start gap-3 pt-8 text-center min-h-screen w-[250px] bg-[#363062]">
            <h4 class="text-white font-bold text-2xl flex items-center justify-center gap-2">Admin <span class="pt-1"><i class='bx bxs-user'></i></span></h4>
            <a href="{{route('adminStaff')}}" class="{{ request()->route()->getName() === 'adminStaff'? 'text-white text-xl p-3 font-bold bg-blue-700' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Staff</a>
            <a href="{{route('adminAttachments')}}" class="{{  request()->route()->getName() === 'adminAttachments' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Attachments</a>
            <a href="{{route('adminApproval')}}" class="{{  request()->route()->getName() === 'adminApproval' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Pending Approvals</a>
            <a href="{{route('adminProfile')}}" class="{{  request()->route()->getName() === 'adminProfile' ? 'text-white text-xl p-3 py-1 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Profile</a>
            <a href="#" class="btn btn-danger max-w-24 px-3 m-auto">Logout</a>
           
        </div>
        <div class="flex-grow px-10 pt-8 h-auto border-solid">
            <div class="text-right max-w-[350px] my-auto ml-auto mr-0 flex items-center justify-center gap-4 ">
                <h4 class="text-xl font-bold pt-2 ">PDRRMO ZAMBALES </h4>
                <form action="" method="post">
                    @csrf
                    <button class="py-1.5 bg-red-600 text-white text-md px-4 rounded-sm m-auto hover:bg-red-700 ">
                        LOGOUT
                    </button>
                </form>
            </div>

            {{-- data-card --}}
            
            <div class="pt-14 mt-5 pl-8">
                <h4 class="text-2xl font-bold py-2 ">UPDATE STAFF</h4>
                <p class="py-2 text-lg">Current Staff ID: <span class="font-bold">10</span></p>
            </div>

            {{-- data-card --}}
            <div class="pt-7 grid content-center px-8">
                <form action="" method="put" class="grid grid-cols-3 gap-4">
                    <div class="px-8 py-8 rounded-md shadow-xl bg-slate-200">
                        <p class="py-2 font-bold">USERNAME:</p>
                        <input type="text" name="username" id="username" placeholder="Username Here.." class="py-2 px-8 border-blue-500 outline-green-500 text-lg rounded-md shadow-lg">
                    </div>
                    <div class="px-8 py-8 rounded-md shadow-xl  bg-slate-200">
                        <p class="py-2 font-bold">PASSWORD:</p>
                        <input type="password" name="password" id="password" placeholder="Password Here" class="py-2 px-8 border-blue-500 outline-green-500 text-lg rounded-md shadow-lg">
                    </div>
                    <div class="px-8 py-8 rounded-md shadow-xl  bg-slate-200">
                        <p class="py-2 font-bold">EMAIL:</p>
                        <input type="text" name="email" id="email" placeholder="Email Here" class="py-2 px-8 border-blue-500 outline-green-500 text-lg rounded-md shadow-lg">
                    </div>
                    <button type="submit" class="py-2 px-6 text-white border-none rounded-md shadow-xl bg-green-600 max-w-[100px]">UPDATE</button>
                </form>
            </div>

       
          
        </div>
    </section>

@endsection