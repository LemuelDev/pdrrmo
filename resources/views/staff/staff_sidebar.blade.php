<div class="grid content-start gap-3 pt-8 text-center min-h-screen w-[250px] h-[calc(100vh+100px)] bg-[#363062]">
    <h4 class="text-white font-bold text-2xl flex items-center justify-center gap-2">STAFF <span class="pt-1"><i class='bx bxs-user'></i></span></h4>
    <a href="{{route('staff.attachments')}}" class="{{  request()->route()->getName() === 'staff.attachments' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Attachments</a>
    <a href="{{route('staff.profile')}}" class="{{  request()->route()->getName() === 'staff.profile' ? 'text-white text-xl p-3 py-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Profile</a>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="py-1.5 bg-red-600 text-white text-md max-w-28 px-4 rounded-sm m-auto hover:bg-red-700">LOGOUT</button>
    </form>
</div>