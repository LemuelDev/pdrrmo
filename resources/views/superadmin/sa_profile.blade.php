@extends('layout.superadminPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        
        @include('superadmin.sa_sidebar')

        <div class="flex-grow px-10 pt-8 h-auto ">
                 
            @include('shared.navbar')
            {{-- profile --}}

            
            <div class="pt-4 pl-8">
                <h4 class="text-2xl font-bold py-2 ">SUPERADMIN PROFILE</h4>
                <p class="py-2 text-lg">Current profile ID: <span class="font-bold">{{auth()->user()->userProfile->id}}</span></p>
            </div>

             {{-- data-card --}}
            
             <div class=" grid content-center px-8">
                @if ($editing ?? false)
                    <form action="{{route('sa.update', auth()->user()->userProfile->id)}}" method="post" class="grid grid-cols-2 gap-8 px-12 pt-8" enctype="multipart/form-data">
                         @csrf
                         @method('put')
                        <div class="grid">
                             <label for="image" class="text-lg font-bold pb-4">
                                 PROFILE:
                             </label>
                             <input type="file" name="image" id="image" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                        </div>
                        <div class="grid">
                             <label for="name" class="text-lg font-bold pb-4">
                                 NAME:
                             </label>
                             <input type="text" name="name" placeholder="Name..." value="{{auth()->user()->userProfile->name}}"class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                         </div>
                        <div class="grid">
                             <label for="username" class="text-lg font-bold pb-4">
                                 USERNAME:
                             </label>
                             <input type="text" name="username" id="username" value="{{auth()->user()->username}}"placeholder="Username..." class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                        </div>
                        <div class="grid">
                         <label for="Email" class="text-lg font-bold pb-4">
                             Email:
                         </label>
                         <input type="text" name="email" id="Email" placeholder="Email..."  value="{{auth()->user()->userProfile->email}}" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                    </div>
                        <div class="grid">
                             <label for="municipality" class="text-lg font-bold pb-4">
                                 MUNICIPALITY:
                             </label>
                             <select name="municipality" id="municipality" aria-valuenow="{{ auth()->user()->userProfile->municipality }}" aria-placeholder="Municipality" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                                 <option value="sta_cruz" {{ auth()->user()->userProfile->municipality == 'sta_cruz' ? 'selected' : '' }}>STA CRUZ</option>
                                 <option value="candelaria" {{ auth()->user()->userProfile->municipality == 'candelaria' ? 'selected' : '' }}>CANDELARIA</option>
                                 <option value="masinloc" {{ auth()->user()->userProfile->municipality == 'masinloc' ? 'selected' : '' }}>MASINLOC</option>
                                 <option value="palauig" {{ auth()->user()->userProfile->municipality == 'palauig' ? 'selected' : '' }}>PALAUIG</option>
                                 <option value="iba" {{ auth()->user()->userProfile->municipality == 'iba' ? 'selected' : '' }}>IBA</option>
                                 <option value="botolan" {{ auth()->user()->userProfile->municipality == 'botolan' ? 'selected' : '' }}>BOTOLAN</option>
                                 <option value="cabangan" {{ auth()->user()->userProfile->municipality == 'cabangan' ? 'selected' : '' }}>CABANGAN</option>
                                 <option value="san_felipe" {{ auth()->user()->userProfile->municipality == 'san_felipe' ? 'selected' : '' }}>SAN FELIPE</option>
                                 <option value="san_marcelino" {{ auth()->user()->userProfile->municipality == 'san_marcelino' ? 'selected' : '' }}>SAN MARCELINO</option>
                                 <option value="san_narcisco" {{ auth()->user()->userProfile->municipality == 'san_narcisco' ? 'selected' : '' }}>SAN NARCISO</option>
                                 <option value="san_antonio" {{ auth()->user()->userProfile->municipality == 'san_antonio' ? 'selected' : '' }}>SAN ANTONIO</option>
                                 <option value="subic" {{ auth()->user()->userProfile->municipality == 'subic' ? 'selected' : '' }}>SUBIC</option>
                                 <option value="castillejos" {{ auth()->user()->userProfile->municipality == 'castillejos' ? 'selected' : '' }}>CASTILLEJOS</option>
                             </select>
                             
                        </div>
                        <div class="flex justify-start gap-4">
                            <a href={{ route('sa.password', ['user' => auth()->user()->id]) }} class="pt-3 text-lg px-7 mt-10 text-center border-r-full border-none bg-gray-600 hover:bg-gray-700 text-white rounded-lg max-h-[55px] max-w-[220px]">Update Password</a>
                        </div>
                        <button type="submit" class="py-3 text-xl px-7 mt-11 border-r-full border-none bg-green-500 hover:bg-green-600 text-white rounded-lg max-h-[50px] max-w-[200px]">UPDATE</button>
                         </form>
                         @if ($errors->any())
                         
                         <div class="grid mt-7">
                             @foreach ($errors->all() as $error)
                                <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
                             @endforeach
                         </div>
                         
                         @endif
                @else
                <div class="flex justify-evenly items-start px-8 pt-4">
                    <div class="grid text-center">
                        <div class="">
                            <label for="" class="font-bold text-xl mt-4">Profile: </label>
                             <img src="{{auth()->user()->userProfile->getImageUrl()}}" alt="" class="w-[300px] h-[300px] rounded-full mt-4  shadow-md">
                        </div>
                        <div class="pt-8">
                            <a href="{{route('sa.edit', auth()->user()->userProfile->id)}}" class="py-3 px-12 mt-4 text-white border-none rounded-md shadow-xl bg-green-500 hover:bg-green-600 max-w-[130px] text-lg hover:no-underline"> EDIT </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-8 pb-4 min-w-[400px]">
                             <div class="grid gap-3">
                                 <label for="" class="font-bold text-lg">Name:</label>
                                 <input type="text" readonly value="{{auth()->user()->userProfile->name}}" class="px-6 py-3 shadow-xl rounded-md  border-2 border-slate-600">
                             </div>
                             <div class="grid gap-3">
                                 <label for="" class="font-bold text-lg">Username:</label>
                                 <input type="text" readonly value="{{auth()->user()->username}}" class="px-6 py-3 shadow-xl rounded-md border-2 border-slate-600 ">
                             </div>
                             <div class="grid gap-3">
                                 <label for="" class="font-bold text-lg">Email:</label>
                                 <input type="text" readonly value="{{auth()->user()->userProfile->email}}" class="px-6 py-3 shadow-xl rounded-md border-2 border-slate-600 ">
                             </div>
                             <div class="grid gap-3">
                                 <label for="" class="font-bold text-lg">Municipality:</label>
                                 <input type="text" readonly value="{{auth()->user()->userProfile->municipality}}" class="px-6 py-3 shadow-xl rounded-md border-2 border-slate-600 ">
                             </div>
                            
                     </div>
                </div>     
             </div>
             @endif
          

        </div>

            
        @if (session()->has('success'))
                                                        
        <!-- Modal -->
        <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <!-- Modal Content -->
            <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">PROFILE</h2>
                    <!-- Close Button -->
                    <a href="#" id="close-modal" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700" aria-label="Close">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                </div>
                <!-- Modal Body -->
                <div class="mb-4">
                    <p class="text-center text-green-600">{{session('success')}} </p>
                </div>
                
            </div>
        </div>

        <script>
            // Get references to modal elements
            const modal = document.getElementById('modal');
            const closeModalButton = document.getElementById('close-modal');


            // Function to open the modal
            function openModal() {
                modal.classList.remove('hidden');
            }

            // Function to close the modal
            function closeModal() {
                modal.classList.add('hidden');
            }

            // Event listener for close button
            closeModalButton.addEventListener('click', closeModal);

        </script>
    @endif
 
    </section>

@endsection