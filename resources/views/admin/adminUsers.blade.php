@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh]  flex items-start">
       
        @include('admin.adminSidebar')
        
        <div class="flex-grow pt-8 h-auto px-3 2xl:max-w-[1700px] xl:max-w-[1300px] max-lg:w-full">
           
            @include('shared.navbar')
            
            <div class="pt-4 md:pl-8 flex flex-col lg:flex-row justify-start items-center gap-4 lg:gap-6 max-md:pl-0">
                <form action="{{ route('admin.users') }}" method="GET" class="flex items-center justify-start max-lg:justify-center max-lg:max-w-[700px] max-lg:mx-auto gap-4 max-sm:w-full lg:w-auto max-[540px]:flex-col">
                    <input type="text" name="search" id="search" placeholder="Search Here" class="px-8 py-1.5  max-[540px]:max-w-[390px] rounded-lg border-2 border-gray-700 outline-none shadow-xl flex-grow">
                    <button type="submit" class="text-white bg-green-500 rounded-lg hover:bg-green-700 px-4 py-2 max-[540px]:min-w-[250px] ">SEARCH</button>
                </form>
                                <!-- Button to trigger modal -->
                    @if (auth()->user()->userProfile->municipality === 'pdrrmo')
                            <button id="municipalityDropdown" class="no-underline text-white text py-2 px-3 rounded-lg bg-violet-500 hover:no-underline hover:bg-violet-700 max-lg:w-[400px] max-[450px]:w-[250px]">
                                PER-MUNICIPALITY
                            </button>
                            
                                        <!-- Modal structure -->
                            <div id="municipalityModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                                <div class="bg-white rounded-lg p-4 shadow-lg" style="width: 650px;">
                                    <h3 class="text-lg font-semibold py-2 text-center">Select Municipality</h3>
                                    <!-- Create a grid with 3 columns -->
                                    <div class="">
                                        <ul id="municipalitiesList" class="grid grid-cols-3 gap-4">
                                            <li><a href="{{ route('admin.specificAdmin', 'sta_cruz') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700 ">STACRUZ</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'candelaria') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CANDELARIA</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'masinloc') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">MASINLOC</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'palauig') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">PALAUIG</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'iba') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">IBA</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'botolan') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">BOTOLAN</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'cabangan') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CABANGAN</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'subic') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SUBIC</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'castillejos') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CASTILLEJOS</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'san_antonio') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN ANTONIO</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'san_felipe') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN FELIPE</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'san_marcelino') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN MARCELINO</a></li>                        
                                            <li><a href="{{ route('admin.specificAdmin', 'san_narciso') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN NARCISO</a></li>
                                            <li><a href="{{ route('admin.specificAdmin', 'pdrrmo') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">PDRRMO</a></li>
                                        </ul>
                                    </div>
                                    <button id="closeModal" class="mt-4 py-2 px-3 bg-red-500 text-white rounded">Close</button>
                                    </div>
                                </div>
                    @endif
                
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
            <div class="pt-4 xl:px-8 max-lg:px-4 max-w-[1300px] 2xl:max-w-[1500px] max-[1450px]:max-w-[1100px] max-xl:max-w-[970px] max-lg:max-w-full max-sm:px-0">
                @include('admin.tableUsers')
            </div>

          
        </div>

        @if (session()->has('success'))
                                                                     
        <!-- Modal -->
                <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <!-- Modal Content -->
                    <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96 max-sm:w-[330px] max-sm:py-8">
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