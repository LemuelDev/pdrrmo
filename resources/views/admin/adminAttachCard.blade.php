@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        @include('admin.adminSidebar')

        
        <div class="flex-grow px-10 pt-8 h-auto border-solid">
                 
            @include('shared.navbar')

           <div class="pt-8 pl-8">
                <h4 class="text-2xl font-bold">CREATE NEW ATTACHMENT:</h4>
           </div>

           
 <div class="pt-4 pl-8">
    <form action="{{route('admin.update-staff', $staff->userProfile->id)}}" method="post" class="grid grid-cols-2 gap-8 px-12 pt-8">
        @csrf
        @method('put')
        <div class="grid">
            <label for="username" class="text-lg font-bold pb-4">
                USERNAME:
            </label>
            <input type="text" name="username" readonly id="username" value="{{$staff->username}}"placeholder="Username..." class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
       </div>
       <div class="grid">
            <label for="name" class="text-lg font-bold pb-4">
                EMAIL:
            </label>
            <input type="text" name="email" readonly placeholder="Name..." value="{{$staff->userProfile->email}}"class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
        </div>
       <div class="grid">
        <label for="user_type" class="text-lg font-bold pb-4">
            USER_TYPE:
        </label>
            <select name="user_type" id=""  class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                <option value="staff" {{ $staff->userProfile->user_type == 'staff' ? 'selected' : '' }}>staff</option>
                <option value="admin" {{ $staff->userProfile->user_type == 'admin' ? 'selected' : '' }}>admin</option>
                <option value="superadmin" {{ $staff->userProfile->user_type == 'superadmin' ? 'selected' : '' }}>superadmin</option>
            </select>
        </div>
        <div class="grid">
            <label for="user_status" class="text-lg font-bold pb-4">
                USER_STATUS:
            </label>
                <select name="user_status" id=""  class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                    <option value="active" {{ $staff->userProfile->user_status == 'active' ? 'selected' : '' }}>active</option>
                    <option value="inactive" {{ $staff->userProfile->user_status == 'inactive' ? 'selected' : '' }}>inactive</option>
                </select>
        </div>
        <div class="grid">
            <label for="user_status" class="text-lg font-bold pb-4">
                APPROVAL:
            </label>
                <select name="isPending" id=""  class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                    <option value="approve" {{ $staff->userProfile->isPending == 'approved' ? 'selected' : '' }}>approve</option>
                    <option value="pending" {{ $staff->userProfile->isPending == 'pending' ? 'selected' : '' }}>pending</option>
                </select>
        </div>
       <div class="grid">
            <label for="municipality" class="text-lg font-bold pb-4">
                MUNICIPALITY:
            </label>
            <select name="municipality" id="municipality" aria-valuenow="{{ auth()->user()->userProfile->municipality }}" aria-placeholder="Municipality" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                <option value="sta_cruz" {{ $staff->userProfile->municipality == 'sta_cruz' ? 'selected' : '' }}>STA CRUZ</option>
                <option value="candelaria" {{ $staff->userProfile->municipality == 'candelaria' ? 'selected' : '' }}>CANDELARIA</option>
                <option value="masinloc" {{ $staff->userProfile->municipality == 'masinloc' ? 'selected' : '' }}>MASINLOC</option>
                <option value="palauig" {{ $staff->userProfile->municipality == 'palauig' ? 'selected' : '' }}>PALAUIG</option>
                <option value="iba" {{ $staff->userProfile->municipality == 'iba' ? 'selected' : '' }}>IBA</option>
                <option value="botolan" {{ $staff->userProfile->municipality == 'botolan' ? 'selected' : '' }}>BOTOLAN</option>
                <option value="cabangan" {{ $staff->userProfile->municipality == 'cabangan' ? 'selected' : '' }}>CABANGAN</option>
                <option value="san_felipe" {{ $staff->userProfile->municipality == 'san_felipe' ? 'selected' : '' }}>SAN FELIPE</option>
                <option value="san_marcelino" {{ $staff->userProfile->municipality == 'san_marcelino' ? 'selected' : '' }}>SAN MARCELINO</option>
                <option value="san_narcisco" {{ $staff->userProfile->municipality == 'san_narcisco' ? 'selected' : '' }}>SAN NARCISO</option>
                <option value="san_antonio" {{ $staff->userProfile->municipality == 'san_antonio' ? 'selected' : '' }}>SAN ANTONIO</option>
                <option value="subic" {{ $staff->userProfile->municipality == 'subic' ? 'selected' : '' }}>SUBIC</option>
                <option value="castillejos" {{ $staff->userProfile->municipality == 'castillejos' ? 'selected' : '' }}>CASTILLEJOS</option>
            </select>
            
       </div>
       <button type="submit" class="py-3 text-xl px-7  border-r-full border-none bg-green-500 hover:bg-green-600 text-white rounded-lg max-h-[50px] max-w-[200px]">UPDATE</button>
        </form>
        @if ($errors->any())
        
        <div class="grid mt-7">
            @foreach ($errors->all() as $error)
               <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
            @endforeach
        </div>

        @endif
</div> 
             

            {{-- footer --}}
           <footer class="absolute bottom-3 right-3 ">
                <h4 class="text-lg text-black font-bold ">ProjectBeta IT Solutions</h4>
           </footer>
          
        </div>
    </section>

@endsection
