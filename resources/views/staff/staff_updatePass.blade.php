@extends('layout.staffPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        @include('staff.staff_sidebar')

        <div class="flex-grow px-10 pt-8 h-auto border-solid">

            @include('shared.navbar')
           <div class="pt-16 pl-8">
                <h4 class="text-2xl font-bold">UPDATE PASSWORD:</h4>
           </div>
           
 <div class="py-4 pl-8 flex items-start justify-around max-w-[1100px] gap-4 ">
        <div class="max-w-[400px]">
            <form action="{{ route('staff.passUpdate', auth()->user()->id) }}" method="post" class="grid gap-6 p-8 px-10 min-w-[400px] shadow-2xl rounded-lg" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="grid py-2">
                    <label for="old_password" class="text-xl font-bold pb-4">
                        CURRENT PASSWORD:
                    </label>
                    <input type="password" name="old_password" id="old_password" placeholder="Enter current password" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                 </div>
                 <div class="grid py-2">
                    <label for="new_password" class="text-xl font-bold pb-4">
                        NEW PASSWORD:
                    </label>
                    <input type="password" name="new_password" id="new_password" placeholder="Enter new password" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                 </div>
                 <div class="grid py-2">
                    <label for="new_password_confirmation" class="text-xl font-bold pb-4">
                        CONFIRM NEW PASSWORD:
                    </label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm new password" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                </div>
               <button type="submit" class="py-3 text-xl px-7  border-r-full border-none bg-green-500 hover:bg-green-600 text-white rounded-lg ">POST</button>
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
            <p>- input your current password.</p>
            <p>- create your new password and update it.</p>
        </div>
    </div> 

         
@if (session()->has('failed'))
                                                                 
<!-- Modal -->
        <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <!-- Modal Content -->
            <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">INCORRECT PASSWORD</h2>
                    <!-- Close Button -->
                    <a href="#" id="close-modal" class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700" aria-label="Close">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </a>
                </div>
                <!-- Modal Body -->
                <div class="mb-4">
                    <p class="text-center text-red-600">{{session('failed')}} </p>
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
             

            {{-- footer --}}
           {{-- <footer class="absolute bottom-3 right-3 ">
                <h4 class="text-lg text-black font-bold ">ProjectBeta IT Solutions</h4>
           </footer> --}}
          
        </div>

        
              
     
    </section>

@endsection
