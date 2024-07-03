<div id="sidebar" class="fixed top-0 left-0 grid content-start gap-3 pt-8 text-left pl-2 min-h-screen w-[250px] h-screen bg-[#363062] transform -translate-x-full transition-transform duration-300 lg:translate-x-0 lg:relative lg:max-lg:hidden z-50 max-sm:w-[300px] max-lg:w-[400px] max-lg:pt-4">
    <div class="lg:hidden flex justify-end py-1 pr-4">
        <span id="sidebar-close" class="text-2xl cursor-pointer">
            <box-icon name='x-circle' color='#ffffff' size='md'></box-icon>
        </span>
    </div>
    <a href="{{route('staff.attachments')}}" class="{{  request()->route()->getName() === 'staff.attachments' ? 'text-white text-lg flex items-center p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-lg flex items-center pt-3 font-bold hover:no-underline' }}"><span class="pt-1 pr-2"><box-icon name='file' type='solid' color='#ffffff' ></box-icon></span>Attachments</a>
    <a href="{{route('staff.profile')}}" class="{{  request()->route()->getName() === 'staff.profile' ? 'text-white text-lg flex items-center p-3 py-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-lg flex items-center pt-3 font-bold hover:no-underline' }}"><span class=" pt-1 pr-2 "><box-icon type='solid' name='user' color="#ffffff"></box-icon></span>Profile</a>
    {{-- <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="py-1.5 bg-red-600 text-white text-md max-w-28 px-4 rounded-sm m-auto hover:bg-red-700">LOGOUT</button>
    </form> --}}
</div>