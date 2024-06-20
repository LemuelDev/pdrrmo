<div id="sidebar" class="fixed top-0 left-0 grid content-start gap-3 pt-8 text-center min-h-screen w-[250px] h-screen bg-[#363062] transform -translate-x-full transition-transform duration-300 lg:translate-x-0 lg:relative lg:max-lg:hidden z-50 max-sm:w-[300px] max-lg:w-[400px] max-lg:pt-4">
    <div class="lg:hidden flex justify-end py-1 pr-4">
        <span id="sidebar-close" class="text-2xl cursor-pointer">
            <box-icon name='x-circle' color='#ffffff' size='md'></box-icon>
        </span>
    </div>
    <div class="grid lg:hidden text-white text-center">
        <p class="text-lg px-4 my-0"> Name: <span class="font-bold ml-1">{{auth()->user()->userProfile->name}}</span></p>
        <p class="text-lg px-4 my-0"> Municipality: <span class="font-bold ml-1">{{auth()->user()->userProfile->municipality}}</span></p>
    </div>
    <h4 class="text-white font-bold text-2xl flex items-center justify-center gap-2" >SuperAdmin <span class="pt-1"><i class='bx bxs-user'></i></span></h4>
    <a href="{{route('sa.admins')}}" class="{{ request()->route()->getName() === 'sa.admins'? 'text-white text-xl p-3 font-bold bg-blue-700 hover:no-underline': 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Admins</a>
    <a href="{{route('sa.staff')}}" class="{{ request()->route()->getName() === 'sa.staff'? 'text-white text-xl p-3 font-bold bg-blue-700 hover:no-underline': 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Staff</a>
    <a href="{{route('sa.attachments')}}" class="{{  request()->route()->getName() === 'sa.attachments' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Attachments</a>
    <a href="{{route('sa.approval')}}" class="{{  request()->route()->getName() === 'sa.approval' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Pending Approvals</a>
    <a href="{{route('sa.request')}}" class="{{  request()->route()->getName() === 'sa.request' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Request of Transfers</a>
    <a href="{{route('sa.profile')}}" class="{{  request()->route()->getName() === 'sa.profile' ? 'text-white text-xl p-3 py-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Profile</a>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">LOGOUT</button>
    </form>
   
</div>