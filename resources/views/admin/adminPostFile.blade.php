@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        @include('admin.adminSidebar')

        <div class="flex-grow px-10 pt-8 h-auto border-solid">

            @include('shared.navbar')
           <div class="pt-16 pl-8">
                <h4 class="text-2xl font-bold">NEW ATTACHMENT:</h4>
           </div>
           
 <div class="py-4 pl-8 flex items-start justify-around max-w-[1100px] gap-4 ">
    <form action="{{route('admin.attachments-store')}}" method="post" class="grid gap-6 p-8 shadow-2xl rounded-lg" enctype="multipart/form-data">
        @csrf
        <div class="grid py-2">
            <label for="attachments" class="text-xl font-bold pb-4">
                ATTACHMENT:
            </label>
            <input type="file" name="attachment" id="attachment" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
       </div>
       <div class="grid py-2">
        <label for="attachments" class="text-xl font-bold pb-4">
            RESTRICTIONS:
        </label>
        <select name="restrictions" id="restrictions" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
            <option value="Public">Public</option>
            <option value="Everyone">Everyone</option>
            <option value="{{auth()->user()->userProfile->municipality}}">Municipality Only</option>
            <option value="Only_Me">Only Me</option>
        </select>
        </div>
       
       
       <button type="submit" class="py-3 text-xl px-7  border-r-full border-none bg-green-500 hover:bg-green-600 text-white rounded-lg ">POST</button>
       @if ($errors->any())
        
        <div class="grid mt-7">
            @foreach ($errors->all() as $error)
               <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
            @endforeach
        </div>
        @endif
    </form>
    <div class=" p-8 py-16 text-start leading-10 shadow-2xl rounded-lg">
        <h4 class="text-2xl font-bold pb-2">IMPORTANT THINGS TO CONSIDER:</h4>
        <p>- the file must not be greater than 50mb.</p>
        <p>- the file must have a pdf, doc, docx, pptx, or xlsx extension.</p>

    </div>
        

     
</div> 

                    
            @if (session()->has('failed'))
                                                                            
            <!-- Modal -->
                    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                        <!-- Modal Content -->
                        <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96">
                            <!-- Modal Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-semibold">ATTACHMENT</h2>
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
           <footer class="absolute bottom-3 right-3 ">
                <h4 class="text-lg text-black font-bold ">ProjectBeta IT Solutions</h4>
           </footer>
          
        </div>
    </section>

@endsection
