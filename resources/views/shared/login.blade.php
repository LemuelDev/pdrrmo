@extends('layout.register')

@section('content')
<section class="flex items-center justify-center w-full h-full py-4">
    <div class="grid grid-cols-1 md:grid-cols-2  max-w-[1100px]  h-[650px] m-auto p-6 pt-36">
        <div class="text-center p-7 bg-[#363062] shadow-2xl rounded-xl">
            <h4 class="text-4xl font-bold text-white pt-32 max-md:py-8 leading-[3rem]">Provincial Disaster and <br> Risk Reduction Management Office Zambales</h4>
        </div>
        <form action="{{route('login')}}" method="post" class="grid content-center gap-5 py-14 px-12 shadow-2xl rounded-xl">
            @csrf
            <h4 class="text-center text-black py-4 text-3xl font-bold">LOGIN</h4>
            <input type="text" name="username" id="username" placeholder="Enter username..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <input type="password" name="password" id="password" placeholder="Enter password..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <button type="submit" class="py-3 text-xl px-7 border-r-full border-none bg-green-500 text-white rounded-lg">LOGIN</button>
            <p class="py-2 text-xl text-center">Don't have any account? <a href="{{route('signup')}}" class="text-xl text-blue-600">Sign Up</a></p>
            
            @if (session()->has('failed'))
            <p class="py-2 text-center text-red-500">{{session('failed')}}</p>
            @endif
            @if (session()->has('success'))
            <p class="py-2 text-center text-green-500">{{session('success')}}</p>
            @endif
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