@extends('layout.superadminPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
       
        @include('superadmin.sa_sidebar')
        
        <div class="flex-grow px-10 pt-8 h-auto border-solid">
           
                  
            @include('shared.navbar')

            <div class="flex justify-start items-start gap-4 pt-5 pl-8"">
                <form action="{{route('sa.admins')}}" method="get" class="flex items-center justify-start gap-4 pb-4">
                    <h5>Search Admin:</h5>
                    <input type="text" name="search" id="search" placeholder="Search Here" class="px-8 py-1.5 rounded-lg border-solid border-2 border-[#363062] outline-green-500 shadow-xl">
                    <button class="btn btn-success px-4">SEARCH</button>                       
                 </form>
                                <!-- Button to trigger modal -->
                <button id="municipalityDropdown" class="no-underline text-white text py-2 px-3 rounded-lg bg-violet-500 hover:no-underline hover:bg-violet-700">
                    PER-MUNICIPALITY
                 </button>
                
                            <!-- Modal structure -->
                 <div id="municipalityModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white rounded-lg p-4 shadow-lg" style="width: 650px;">
                        <h3 class="text-lg font-semibold py-2 text-center">Select Municipality</h3>
                        <!-- Create a grid with 3 columns -->
                        <div class="">
                             <ul id="municipalitiesList" class="grid grid-cols-3 gap-4">
                                 <li><a href="{{ route('sa.specificAdmin', 'sta_cruz') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700 ">STACRUZ</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'candelaria') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CANDELARIA</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'masinloc') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">MASINLOC</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'palauig') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">PALAUIG</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'iba') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">IBA</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'botolan') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">BOTOLAN</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'cabangan') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CABANGAN</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'subic') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SUBIC</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'castillejos') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CASTILLEJOS</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'san_antonio') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN ANTONIO</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'san_felipe') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN FELIPE</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'san_marcelino') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN MARCELINO</a></li>                        
                                 <li><a href="{{ route('sa.specificAdmin', 'san_narciso') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN NARCISO</a></li>
                                 <li><a href="{{ route('sa.specificAdmin', 'pdrrmo') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">PDRRMO</a></li>
                             </ul>
                         </div>
                         <button id="closeModal" class="mt-4 py-2 px-3 bg-red-500 text-white rounded">Close</button>
                         </div>
                     </div>
                
                    </div>
                            
                            <script>
                                 document.addEventListener("DOMContentLoaded", function() {
                                // Function to handle modal show and hide
                                function handleModal(modalButtonId, modalId, closeButtonId, listId) {
                                    var modalButton = document.getElementById(modalButtonId);
                                    var modal = document.getElementById(modalId);
                                    var closeButton = document.getElementById(closeButtonId);
                                    var list = document.getElementById(listId);
                
                                    // Show modal on button click
                                    modalButton.addEventListener("click", function() {
                                        modal.classList.remove("hidden");
                                    });
                
                                    // Hide modal on close button click
                                    closeButton.addEventListener("click", function() {
                                        modal.classList.add("hidden");
                                    });
                
                                    // Hide modal when a list link is clicked
                                    var links = list.querySelectorAll("a");
                                    links.forEach(function(link) {
                                        link.addEventListener("click", function() {
                                            modal.classList.add("hidden");
                                        });
                                    });
                                }
                
                                // Apply the modal handling function to RESTRICTIONS and PER-MUNICIPALITY
                            
                                handleModal("municipalityDropdown", "municipalityModal", "closeModal", "municipalitiesList");
                            });
                            </script>

            

            {{-- tables --}}
            <div class="pt-4 px-8">
                @include('admin.tableAdmins')
            </div>
            
            
          
        </div>

        @if (session()->has('success'))
                                                                     
        <!-- Modal -->
                <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <!-- Modal Content -->
                    <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">ADMIN</h2>
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


                                <!-- Confirmation Modal -->
                                <div class="fixed inset-0 z-50 overflow-y-auto hidden" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                    <div class="flex items-center justify-center min-h-screen">
                                        <div class="bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6">
                                            <div class="modal-header flex justify-start items-center">
                                                <h5 class="text-lg font-medium" id="deleteConfirmationModalLabel">User Deletion</h5>
                                            </div>
                                            <div class="modal-body my-4 text-red-500">
                                                Are you sure you want to delete this user?
                                            </div>
                                            <div class="modal-footer flex justify-end gap-4">
                                                <button type="button" class="text-white py-2 px-6 bg-gray-500 hover:bg-gray-600 rounded-md" data-close-modal>Cancel</button>
                                                <form id="deleteForm" method="POST" action="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-white py-2 px-6 bg-red-500 hover:bg-red-600 rounded-md">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                    // Open modal when a button with data-toggle-modal is clicked
                                    document.querySelectorAll('[data-toggle-modal]').forEach(button => {
                                        button.addEventListener('click', function() {
                                            const modalSelector = button.getAttribute('data-toggle-modal');
                                            const modal = document.querySelector(modalSelector);
                                            const fileId = button.getAttribute('data-file-id');
            
                                            // Ensure fileId is available
                                            if (fileId) {
                                                // Set the form action URL
                                                const deleteForm = modal.querySelector('#deleteForm');
                                                
                                                // Construct the URL with the file ID parameter
                                                const deleteUrl = `/user/delete/${fileId}`;
                                                
                                                // Set the form action to the constructed URL
                                                deleteForm.setAttribute('action', deleteUrl);
                                                
                                                // Show the modal
                                                modal.classList.remove('hidden');
                                            }
                                        });
                                    });
            
                                    // Close modal when a button with data-close-modal is clicked
                                        document.querySelectorAll('[data-close-modal]').forEach(button => {
                                            button.addEventListener('click', function() {
                                                const modal = button.closest('#deleteConfirmationModal');
                                                // Hide the modal
                                                modal.classList.add('hidden');
                                            });
                                        });
                                    });
            
            
                                </script>
    </section>

@endsection