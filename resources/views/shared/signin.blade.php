@extends('layout.register')

@section('content')
<section class="flex items-center justify-center w-full h-full py-4">
    <div class="grid grid-cols-1 lg:grid-cols-2 max-w-[1300px] h-auto m-auto p-6 pt-14 max-md:pt-24 max-sm:pt-12">
        <div class="text-center p-7 bg-[#363062] shadow-2xl rounded-xl max-md:px-4   ">
            <div class="lg:max-h-[400px] lg:pt-16 grid justify-center lg:gap-12 gap-4 w-full pt-0 ">
                <div class="mt-10">
                    <img src="{{ asset('images/pdrlogo.png') }}" class="max-w-[200px] h-[200px] rounded-full text-white mx-auto">
                </div>
                <h4 class="text-3xl font-bold text-white max-md:py-8 leading-[3rem]">Provincial Disaster and <br> Risk Reduction Management Office Zambales</h4>
            </div>
        </div>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 max-[525px]:grid-cols-1 content-center gap-5 py-8 px-8 shadow-2xl rounded-2xl max-md:px-6 max-md:py-6">
            @csrf
            <h4 class="text-center text-black py-4 text-3xl font-bold col-span-2">CREATE AN ACCOUNT</h4>

            <div class="max-[525px]:col-span-2">
                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Enter your last name..." class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>

            <div class="max-[525px]:col-span-2">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" placeholder="Enter your first name..." class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>

            <div class="max-[525px]:col-span-2">
                <label for="middlename">Middlename:</label>
                <input type="text" name="middlename" id="middlename" value="{{ old('middlename') }}" placeholder="Enter your middle name (optional)..." class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500">
                <span class="italic text-sm text-gray-500">(Optional)</span>

            </div>

            <div class="max-[525px]:col-span-2">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Enter username..." class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
            
            <div class="max-[525px]:col-span-2">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter password..." class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500">
                <span class="text-sm text-gray-500 italic">
                    Must contain at least one lowercase letter, one uppercase letter, one number, and one special character.
                </span>
            </div>

            <div class="max-[525px]:col-span-2">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password..." class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>
            
            <div class="max-[525px]:col-span-2">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Enter Email..." class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>

            <div>
                <label for="municipality">Municipality:</label>
                <select name="municipality" id="municipality" class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500" value="{{ old('municipality') }}">
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
            </div>

            <div class="col-span-2">
                <label for="profile_picture" class="py-2">Upload Profile Picture:</label>
                <input type="file" name="profile_picture" id="profile_picture" class="py-3 w-full px-6 bg-slate-100 border-black outline-green-500">
            </div>

            <button type="submit" class="py-3 text-xl px-7 bg-green-500 text-white rounded-lg w-full col-span-2">SIGN UP</button>

            <p class="py-2 text-xl text-center col-span-2">Already have an account? <a href="{{ route('login') }}" class="text-xl text-blue-600">Login</a></p>

            @if (session()->has('failed'))
                <div class="toast-message text-red-600 text-center col-span-2 rounded min-w-16">
                    {{ session('failed') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="toast-message text-green-600 text-center col-span-2 rounded min-w-16">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="grid gap-2 col-span-2">
                    @foreach ($errors->all() as $error)
                        <div class="toast-message text-red-600 text-center col-span-2 rounded min-w-26 duration-300 ease-in-out">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                const toastMessages = document.querySelectorAll('.toast-message');
                toastMessages.forEach(message => {
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 500);
                });
            }, 3000); // 3000ms = 3 seconds
        });
    </script>
</section>
@endsection
