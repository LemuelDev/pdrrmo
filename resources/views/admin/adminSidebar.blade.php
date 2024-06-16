@if (auth()->user()->userProfile->municipality === 'pdrrmo')
        <div class="grid content-start gap-3 pt-8 text-center min-h-screen w-[250px] h-[calc(100vh+100px)] bg-[#363062]">
            <h4 class="text-white font-bold text-2xl flex items-center justify-center gap-2">Admin <span class="pt-1"><i class='bx bxs-user'></i></span></h4>
            <a href="{{route('admin.admin')}}" class="{{ request()->route()->getName() === 'admin.admin'? 'text-white text-xl p-3 font-bold bg-blue-700' : 'text-white text-xl pt-3 font-bold hover:no-underline no-underline' }}">Admin</a>
            <a href="{{route('admin.staff')}}" class="{{ request()->route()->getName() === 'admin.staff'? 'text-white text-xl p-3 font-bold bg-blue-700' : 'text-white text-xl pt-3 font-bold hover:no-underline no-underline' }}">Staff</a>
            <a href="{{route('admin.attachments')}}" class="{{  request()->route()->getName() === 'admin.attachments' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Attachments</a>
            <a href="{{route('admin.approval')}}" class="{{  request()->route()->getName() === 'admin.approval' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Pending Approvals</a>
            <a href="{{route('admin.request')}}" class="{{  request()->route()->getName() === 'admin.request' ? 'text-white text-xl p-3 py-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Request of Transfers</a>
            <a href="{{route('admin.profile')}}" class="{{  request()->route()->getName() === 'admin.profile' ? 'text-white text-xl p-3 py-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Profile</a>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">LOGOUT</button>
            </form>
        
        </div>
@else
        <div class="grid content-start gap-3 pt-8 text-center min-h-screen w-[250px] h-[calc(100vh+100px)] bg-[#363062]">
            <h4 class="text-white font-bold text-2xl flex items-center justify-center gap-2">Admin <span class="pt-1"><i class='bx bxs-user'></i></span></h4>
            <a href="{{route('admin.staff')}}" class="{{ request()->route()->getName() === 'admin.staff'? 'text-white text-xl p-3 font-bold bg-blue-700' : 'text-white text-xl pt-3 font-bold hover:no-underline no-underline' }}">Staff</a>
            <a href="{{route('admin.attachments')}}" class="{{  request()->route()->getName() === 'admin.attachments' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Attachments</a>
            <a href="{{route('admin.approval')}}" class="{{  request()->route()->getName() === 'admin.approval' ? 'text-white text-xl p-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Pending Approvals</a>
            <a href="{{route('admin.request')}}" class="{{  request()->route()->getName() === 'admin.request' ? 'text-white text-xl p-3 py-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Request of Transfers</a>
            <a href="{{route('admin.profile')}}" class="{{  request()->route()->getName() === 'admin.profile' ? 'text-white text-xl p-3 py-3 font-bold bg-blue-700  hover:no-underline' : 'text-white text-xl pt-3 font-bold hover:no-underline' }}">Profile</a>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">LOGOUT</button>
            </form>
        </div>
@endif