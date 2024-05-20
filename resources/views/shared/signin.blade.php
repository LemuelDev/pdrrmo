@extends('layout.register')

@section('content')
<section class="flex items-center justify-center w-full h-full py-4 ">
    <div class="grid grid-cols-1 md:grid-cols-2  max-w-[1100px]  h-auto m-auto p-6 pt-14  ">
        <div class="text-center p-7 bg-[#363062] shadow-2xl rounded-xl">
            <h4 class="text-4xl font-bold pt-44 text-white max-md:pt-4 leading-[3rem]">Provincial Disaster and <br> Risk Reduction Management Office ZAMBALES</h4>
        </div>
        <form action="{{ route('users.store') }}" method="POST" class="grid content-center gap-5 py-8 px-12 shadow-2xl rounded-2xl">
            @csrf
            <h4 class="text-center text-black py-4 text-3xl font-bold">CREATE AN ACCOUNT</h4>
            <input type="text" name="name" id="name" placeholder="Enter your name..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <input type="text" name="username" id="username" placeholder="Enter username..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <input type="password" name="password" id="password" placeholder="Enter password..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <input type="text" name="email" id="email" placeholder="Enter Email..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <label for="municipality">Municipality:</label>
            <select name="municipality" id="municipality" aria-placeholder="Municipality" class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
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
            <button type="submit" class="py-3 text-xl px-7 border-r-full border-none bg-green-500 text-white rounded-lg">SIGN IN</button>
            <p class="py-2 text-xl text-center">Already have an account? <a href="{{route('login')}}" class="text-xl text-blue-600">Login</a></p>
            @if ($errors->any())
                         
                     <div class="grid">
                        @foreach ($errors->all() as $error)
                            <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
                        @endforeach
                    </div>
                             
             @endif
         
            </form>
    </div>
</section>

@endsection