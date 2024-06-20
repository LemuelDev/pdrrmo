
@if (request()->route()->getName() !== "admin.profile" &&
 request()->route()->getName() !== "admin.edit" && request()->route()->getName() !== "sa.profile" 
 && request()->route()->getName() !== "staff.edit" && request()->route()->getName() !== "sa.edit" 
 && request()->route()->getName() !== "staff.profile")
<div class="text-right flex items-center max-lg:items-start justify-between gap-4 px-6 2xl:max-w-[1800px]  max-lg:px-3 max-sm:px-2">
        <div class="flex items-center justify-center max-lg:hidden">
            <img src="{{auth()->user()->userProfile->getImageUrl()}}" alt="" class="w-[50px] h-[50px] rounded-full">
            <div class="grid text-start">
                <p class="text-lg px-4 my-0"> Name: <span class="font-bold ml-1">{{auth()->user()->userProfile->name}}</span></p>
                <p class="text-lg px-4 my-0"> Municipality: <span class="font-bold ml-1">{{auth()->user()->userProfile->municipality}}</span></p>
            </div>
        </div> 
        <div class="lg:hidden pt-2">
            <span class="text-3xl cursor-pointer" id="menu-icon"><box-icon name='menu' size='md'></box-icon></span>
        </div>
    <div>
    <h4 class="text-xl font-bold py-2 mb-0">PDRRMO ZAMBALES </h4>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">
            LOGOUT
        </button>
    </form>
    </div>
</div>
{{-- <div class="text-right max-sm:flex items-end justify-end max-sm:w-full gap-4 px-6 max-sm:pr-2 max-sm:flex-col max-sm:gap-0 2xl:max-w-[1800px] hidden max-lg:px-3 max-sm:px-0">
    <h4 class="text-xl font-bold py-2 max-[430px]:text-lg max-sm:py-0 ">PDRRMO ZAMBALES </h4>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">
            LOGOUT
        </button>
    </form>
    
</div> --}}
@else
<div class="text-right flex items-center max-lg:items-start justify-between gap-4 px-6 2xl:max-w-[1800px]  max-lg:px-3 lg:flex lg:items-end lg:justify-end">
    <div class="lg:hidden pt-2">
        <span class="text-3xl" id="menu-icon"><box-icon name='menu' size='md'></box-icon></span>
    </div>
    <div>
        <h4 class="text-xl font-bold py-2 mb-0">PDRRMO ZAMBALES </h4>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">
                LOGOUT
            </button>
        </form>
    </div>
</div>
@endif


