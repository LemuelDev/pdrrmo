@if (auth()->user()->userProfile->municipality === 'pdrrmo')
        <div id="sidebar" class="fixed top-0 left-0 grid content-start gap-3 pt-8 text-left pl-2 min-h-screen w-[250px] h-screen bg-[#363062] transform -translate-x-full transition-transform duration-300 lg:translate-x-0 lg:relative lg:max-lg:hidden z-50 max-sm:w-[300px] max-lg:w-[400px] max-lg:pt-4 max-lg:pl-8">
            <div class="lg:hidden flex justify-end py-1 pr-4">
                <span id="sidebar-close" class="text-2xl cursor-pointer">
                    <box-icon name='x-circle' color='#ffffff' size='md'></box-icon>
                </span>
            </div>
            <a href="{{route('admin.users')}}" class="{{ request()->route()->getName() === 'admin.users'? 'text-white text-lg p-3 font-bold bg-blue-700 hover:no-underline flex items-center' : 'text-white text-lg pt-3 font-bold hover:no-underline no-underline flex items-center' }}"><span class=" pt-1 pr-2 "><box-icon type='solid' name='user' color="#ffffff"></box-icon></span>Users</a>
            <a href="{{route('admin.attachments')}}" class="{{  request()->route()->getName() === 'admin.attachments' ? 'text-white text-lg p-3 font-bold bg-blue-700  hover:no-underline flex items-center' : 'text-white text-lg pt-3 font-bold hover:no-underline flex items-center' }}"><span class="pt-1 pr-2"><box-icon name='file' type='solid' color='#ffffff' ></box-icon></span> Attachments</a>
            <a href="{{route('admin.approval')}}"
            class="{{ request()->route()->getName() === 'admin.approval' ? 'text-white text-lg p-3 font-bold bg-blue-700 hover:no-underline flex items-center' : 'text-white text-lg pt-3 font-bold hover:no-underline flex items-center' }}">
             <span class="pt-1 pr-2">
                 <box-icon name='user-check' type='solid' color='#ffffff'></box-icon>
             </span>
             Approvals
         
             @if(isset($pendingCount))
                 <!-- Add a small circle badge next to the text -->
                 <span class="ml-2 bg-red-600 text-white rounded-full text-xs w-8 h-8 flex items-center justify-center">
                     {{ $pendingCount }}
                 </span>
             @endif
            </a>
         
            <a href="{{route('admin.request')}}" class="{{  request()->route()->getName() === 'admin.request' ? 'text-white text-lg p-3 py-3 font-bold bg-blue-700  hover:no-underline flex items-center' : 'text-white text-lg pt-3 font-bold hover:no-underline flex items-center' }}"><span class="pt-1 pr-2"><box-icon name='transfer' color='#ffffff' ></box-icon></span> Request of Transfers</a>
            
        </div>
@else
        
        <div id="sidebar" class="fixed top-0 left-0 grid content-start gap-3 pt-8 text-center min-h-screen w-[250px] h-screen bg-[#363062] transform -translate-x-full transition-transform duration-300 lg:translate-x-0 lg:relative lg:max-lg:hidden z-50 max-sm:w-[300px] max-lg:w-[400px] max-lg:pt-4 max-lg:pl-8">
            <div class="lg:hidden flex justify-end py-1 pr-4">
                <span id="sidebar-close" class="text-2xl cursor-pointer">
                    <box-icon name='x-circle' color='#ffffff' size='md'></box-icon>
                </span>
            </div>
            <a href="{{route('admin.staff')}}" class="{{ request()->route()->getName() === 'admin.staff'? 'text-white text-lg p-3 font-bold bg-blue-700 hover:no-underline flex items-center' : 'text-white text-lg pt-3 font-bold hover:no-underline no-underline flex items-center' }}"><span class=" pt-1 pr-2 "><box-icon type='solid' name='user' color="#ffffff"></box-icon></span>Staff</a>
            <a href="{{route('admin.attachments')}}" class="{{  request()->route()->getName() === 'admin.attachments' ? 'text-white text-lg p-3 font-bold bg-blue-700  hover:no-underline flex items-center' : 'text-white text-lg pt-3 font-bold hover:no-underline flex items-center' }}"><span class="pt-1 pr-2"><box-icon name='file' type='solid' color='#ffffff' ></box-icon></span> Attachments</a>
            <a href="{{route('admin.approval')}}"
            class="{{ request()->route()->getName() === 'admin.approval' ? 'text-white text-lg p-3 font-bold bg-blue-700 hover:no-underline flex items-center' : 'text-white text-lg pt-3 font-bold hover:no-underline flex items-center' }}">
             <span class="pt-1 pr-2">
                 <box-icon name='user-check' type='solid' color='#ffffff'></box-icon>
             </span>
             Approvals
         
             @if(isset($pendingCount))
                 <!-- Add a small circle badge next to the text -->
                 <span class="ml-2 bg-red-600 text-white rounded-full text-xs w-8 h-8 flex items-center justify-center">
                     {{ $pendingCount }}
                 </span>
             @endif
            </a>
            <a href="{{route('admin.request')}}" class="{{  request()->route()->getName() === 'admin.request' ? 'text-white text-lg p-3 py-3 font-bold bg-blue-700  hover:no-underline flex items-center justify-start' : 'text-white text-lg pt-3 font-bold hover:no-underline flex items-center' }}"><span class="pt-1 pr-1"><box-icon name='transfer' color='#ffffff' ></box-icon></span> Request of Transfers</a>
            {{-- <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none">LOGOUT</button>
            </form> --}}
        </div>

        
@endif

