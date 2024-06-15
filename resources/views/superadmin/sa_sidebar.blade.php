<div class="grid content-start gap-3 pt-8 text-center min-h-screen w-[250px] h-[calc(100vh+100px)] bg-[#363062]">
    <h4 class="text-white font-bold text-2xl flex items-center justify-center gap-2" >SuperAdmin <span class="pt-1"><i class='bx bxs-user'></i></span></h4>
    <a href="{{route('sa.admins')}}" class="{{ request()->route()->getName() === 'sa.admins'? 'text-white text-xl p-3 font-bold bg-blue-700 hover:no-underline': 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Admins</a>
    <a href="{{route('sa.staff')}}" class="{{ request()->route()->getName() === 'sa.staff'? 'text-white text-xl p-3 font-bold bg-blue-700 hover:no-underline': 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Staff</a>
    <a href="{{route('sa.attachments')}}" class="{{  request()->route()->getName() === 'sa.attachments' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Attachments</a>
    <a href="{{route('sa.approval')}}" class="{{  request()->route()->getName() === 'sa.approval' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Pending Approvals</a>
    <a href="{{route('sa.profile')}}" class="{{  request()->route()->getName() === 'sa.profile' ? 'text-white text-xl p-3 py-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Profile</a>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">LOGOUT</button>
    </form>
   
</div>