@extends('layout.register')

@section('content')
<section class="flex items-center justify-center w-full h-full py-4">
    <div class="grid grid-cols-1 md:grid-cols-2  max-w-[1100px]  h-[650px] m-auto p-6 pt-36 max-md:pt-24 max-sm:pt-16">
        <div class="text-center p-7 bg-[#363062] shadow-2xl rounded-xl max-md:px-4">
            <h4 class="text-4xl font-bold text-white pt-32 max-md:py-8 leading-[3rem]">Provincial Disaster and <br> Risk Reduction Management Office Zambales</h4>
        </div>
        <form action="{{route('password.update')}}" method="post" class="grid content-center gap-5 py-14 px-12 shadow-2xl rounded-xl max-md:px-6 max-md:py-6">
            @csrf
            <input type="hidden" name="token_user" value="{{ $token }}">
            <h4 class="text-center text-black py-4 text-3xl font-bold">NEW PASSWORD</h4>
            <p class="text-center">Kindly enter your email and your new password.</p>
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
            <input type="text" name="email" id="email" placeholder="Enter email..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <input type="password" name="password" id="password" placeholder="Enter new password..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password..." class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
            <button type="submit" class="py-3 text-xl px-7 border-r-full border-none bg-green-500 text-white rounded-lg">Update Password</button>
            {{-- <p class="py-2 text-xl text-center">Don't have any account? <a href="{{route('signup')}}" class="text-xl text-blue-600">Sign Up</a></p>
            <a href="{{route('login')}}" class="text-center text-blue-600 font-bold text-lg hover:text-violet-500">LOGIN</a> --}}
           
        </form>
    </div>
    <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    </script>
</section>

@endsection