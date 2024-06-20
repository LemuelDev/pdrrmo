@extends('layout.staffPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        @include('staff.staff_sidebar')

        <div class="flex-grow px-4 pt-8 h-auto border-solid">

            @include('shared.navbar')
           <div class="pt-16 pl-8 max-md:pt-8 max-md:pl-0">
                <h4 class="text-2xl font-bold max-md:text-center">NEW ATTACHMENT:</h4>
           </div>
           
 <div class="py-4 pl-8 flex items-start justify-around max-w-[1200px] gap-4 max-md:p-4 max-md:flex-col-reverse max-md:px-4">
    <div class="max-w-[500px] w-full max-md:max-w-[700px] max-md:mx-auto max-sm:w-full">
        <form action="{{route('staff.attachments-store')}}" method="post" class="grid gap-6 p-8 px-10 w-full shadow-2xl rounded-lg max-md:min-w-0 max-md:p-6 max-sm:px-4 max-sm:w-full" enctype="multipart/form-data">
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
        </form>
        @if ($errors->any())
            
            <div class="grid mt-7">
                @foreach ($errors->all() as $error)
                   <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
                @endforeach
            </div>
         @endif
    </div>
    <div class=" p-8 py-16 text-start leading-10 shadow-2xl rounded-lg max-md:text-center max-md:max-w-full max-md:mx-auto max-sm:max-w-full max-sm:py-10 max-sm:px-4">
        <h4 class="text-2xl font-bold pb-2">IMPORTANT THINGS TO CONSIDER:</h4>
        <p>- the file must not be greater than 50mb.</p>
        <p>- the file must have a pdf, doc, docx, pptx, or xlsx extension.</p>

    </div>
</div> 

         
@if (session()->has('failed'))
                                                                 
<!-- Modal -->
        <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <!-- Modal Content -->
            <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96 max-sm:w-[330px] max-sm:py-8">
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
           {{-- <footer class="absolute bottom-3 right-3 ">
                <h4 class="text-lg text-black font-bold ">ProjectBeta IT Solutions</h4>
           </footer> --}}
          
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuIcon = document.getElementById('menu-icon');
                const sidebar = document.getElementById('sidebar');
                const closeButton = document.getElementById('sidebar-close');

                // Function to toggle sidebar visibility
                function toggleSidebar() {
                    sidebar.classList.toggle('-translate-x-full');
                }

                // Function to close the sidebar
                function closeSidebar() {
                    sidebar.classList.add('-translate-x-full');
                }

                // Event listener for menu icon click to toggle sidebar
                menuIcon.addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent click event from reaching the body
                    toggleSidebar();
                });

                // Event listener for close button inside the sidebar
                closeButton.addEventListener('click', closeSidebar);

                // Event listener for body click to hide sidebar when clicking outside
                document.body.addEventListener('click', function(event) {
                    // If the click is outside the sidebar and menu icon, hide the sidebar
                    if (!sidebar.contains(event.target) && !menuIcon.contains(event.target)) {
                        closeSidebar();
                    }
                });

                // Prevent clicks inside the sidebar from propagating to the body
                sidebar.addEventListener('click', function(event) {
                    event.stopPropagation();
                });
            });

        </script>
              
     
    </section>

@endsection
