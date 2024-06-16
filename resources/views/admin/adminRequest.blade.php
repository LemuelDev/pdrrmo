@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        @include('admin.adminSidebar')

        <div class="flex-grow px-10 pt-8 h-auto border-solid">

            @include('shared.navbar')
           <div class="pt-16 pl-8">
                <h4 class="text-2xl font-bold">REQUEST OF TRANSFER:</h4>
           </div>
           
 <div class="py-4 pl-8 flex items-start justify-around max-w-[1100px] gap-4 ">
    <div class="max-w-[400px]">
        <form action="{{ route('admin.requestTransfer') }}" method="post" class="grid gap-6 p-8 px-10 min-w-[400px] shadow-2xl rounded-lg" enctype="multipart/form-data">
            @csrf
            <label for="requested_municipalityy">Municipality:</label>
            <select name="requested_municipality" id="requested_municipality" aria-placeholder="Municipality" class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
                <option value="sta_cruz">STA CRUZ</option>
                <option value="candelaria">CANDELARIA</option>
                <option value="masinloc">MASINLOC</option>
                <option value="palauig">PALAUIG</option>
                <option value="iba">IBA</option>
                <option value="botolan">BOTOLAN</option>
                <option value="cabangan">CABANGAN</option>
                <option value="san_felipe">SAN FELIPE</option>
                <option value="san_marcelino">SAN MARCELINO</option>
                <option value="san_narcisco">SAN NARCISO</option>
                <option value="san_antonio">SAN ANTONIO</option>
                <option value="castillejos">CASTILLEJOS</option>
                <option value="subic">SUBIC</option>
                <option value="pdrrmo">PDRRMO</option>
            </select>
           <button type="submit" class="py-3 text-xl px-7  border-r-full border-none bg-green-500 hover:bg-green-600 text-white rounded-lg ">REQUEST OF TRANSFER</button>
        </form>
            @if ($errors->any())
            <div class="grid mt-7">
                @foreach ($errors->all() as $error)
                <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
                @endforeach
            </div>
            @endif
    </div>
        <div class=" p-8 py-16 text-start leading-10 shadow-2xl rounded-lg">
            <h4 class="text-2xl font-bold pb-2">IMPORTANT THINGS TO CONSIDER:</h4>
            <p>- the request will be approved by your admin.</p>
            <p>- next is the approval of the admin you want to transfer to.</p>
        </div>
    </div> 
          
        </div>

        
              
     
    </section>

@endsection
