
@if (request()->route()->getName() !== "admin.profile" &&
 request()->route()->getName() !== "admin.edit" && request()->route()->getName() !== "sa.profile" 
 && request()->route()->getName() !== "staff.edit" && request()->route()->getName() !== "sa.edit" 
 && request()->route()->getName() !== "staff.profile")
 
<div class="text-right max-w-[1250px] my-auto ml-auto mr-0 flex items-center justify-between gap-4 px-6">
    <div class="flex items-center justify-center">
        <img src="{{auth()->user()->userProfile->getImageUrl()}}" alt="" class="w-[50px] h-[50px] rounded-full">
        <div class="grid text-start">
            <p class="text-lg px-4 my-0"> Name: <span class="font-bold ml-1">{{auth()->user()->userProfile->name}}</span></p>
            <p class="text-lg px-4 my-0"> Municipality: <span class="font-bold ml-1">{{auth()->user()->userProfile->municipality}}</span></p>
        </div>
    </div>
    <div>
    <h4 class="text-xl font-bold py-2 ">PDRRMO ZAMBALES </h4>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">
            LOGOUT
        </button>
    </form>
    </div>
</div>
@else
<div class="text-right flex items-center justify-end gap-4 px-6">
    <h4 class="text-xl font-bold py-2 ">PDRRMO ZAMBALES </h4>
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button class="py-2 bg-red-600 text-white text-md px-4 rounded-md m-auto hover:bg-red-700 border-none ">
            LOGOUT
        </button>
    </form>
    
</div>
@endif