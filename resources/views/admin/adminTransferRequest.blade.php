@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh] flex items-start">
       
        @include('admin.adminSidebar')
        
        <div class="flex-grow pt-8 h-auto px-3 2xl:max-w-[1700px] xl:max-w-[1300px] max-lg:w-full">
           
            @include('shared.navbar')
            
            <div class="pt-4 md:pl-4 flex flex-col lg:flex-row justify-start items-center gap-4 lg:gap-6 max-md:pl-0">
                @if (request()->route()->getName() === 'admin.request')
                <form action="{{route('admin.request')}}" method="get" class="flex items-center justify-start max-lg:justify-center gap-4 w-full lg:w-auto max-[540px]:flex-col">
                    <input type="text" name="search" id="search" placeholder="Search Here"  class="px-8 py-1.5  max-[540px]:max-w-[390px] rounded-lg border-2 border-gray-700 outline-none shadow-xl flex-grow">
                    <button  class="text-white bg-green-500 rounded-lg hover:bg-green-700 px-4 py-2 max-[540px]:min-w-[200px] ">SEARCH</button>                       
                 </form>
                 
                @else
                <form action="{{route('admin.showApproval')}}" method="get" class="flex items-center justify-start max-lg:justify-center gap-4 w-full lg:w-auto max-[540px]:flex-col">
                    <input type="text" name="search" id="search" placeholder="Search Here"  class="px-8 py-1.5  max-[540px]:max-w-[390px] rounded-lg border-2 border-gray-700 outline-none shadow-xl flex-grow">
                    <button  class="text-white bg-green-500 rounded-lg hover:bg-green-700 px-4 py-2 max-[540px]:min-w-[200px] ">SEARCH</button>                       
                 </form>
                @endif
                <div class="flex lg:flex-row justify-center gap-4 items-center lg:mt-0 max-[540px]:grid max-[540px]:grid-cols-2">
                    <a href="{{route('admin.request')}}" class="py-2 px-6 rounded-md bg-violet-500 hover:bg-violet-700 text-white text-center hover:no-underline max-[540px]:max-w-[250px]">REQUEST OF TRANSFERS</a>
                    <a href="{{route('admin.showApproval')}}" class="py-2 px-6 rounded-md bg-red-400 hover:bg-red-500 text-white  text-center hover:no-underline max-[540px]:max-w-[250px]">APPROVAL OF TRANSFERS</a>
                </div>
                
            </div>
            

            {{-- tables --}}
            <div  class="pt-4 xl:px-8 max-lg:px-4 max-w-[1300px] 2xl:max-w-[1500px] max-[1450px]:max-w-[1100px] max-xl:max-w-[970px] max-lg:max-w-full max-sm:px-0">
                @include('admin.tableTransferRequest')
            </div>

          
        </div>

        @if (session()->has('success'))
                                                                     
        <!-- Modal -->
        <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <!-- Modal Content -->
            <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96 max-sm:w-[250px] max-sm:py-8">
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


                                <!-- Confirmation Modal -->
                                <div class="fixed inset-0 z-50 overflow-y-auto hidden" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                    <div class="flex items-center justify-center min-h-screen">
                                        <div class="bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6">
                                            <div class="modal-header flex justify-start items-center">
                                                <h5 class="text-lg font-medium" id="deleteConfirmationModalLabel">Request Deletion</h5>
                                            </div>
                                            <div class="modal-body my-4 text-red-500">
                                                Are you sure you want to delete this request?
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
                                                const deleteUrl = `/transfer-request/delete/${fileId}`;
                                                
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