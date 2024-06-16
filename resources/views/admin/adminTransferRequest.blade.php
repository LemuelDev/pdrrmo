@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
       
        @include('admin.adminSidebar')
        
        <div class="flex-grow px-10 pt-8 h-auto border-solid">
           
            @include('shared.navbar')
            
            <div class="flex justify-start items-start gap-4 pt-5 pl-8">
                @if (request()->route()->getName() === 'admin.request')
                <form action="{{route('admin.request')}}" method="get" class="flex items-center justify-start gap-4 pb-4">
                    <h5>Search Request:</h5>
                    <input type="text" name="search" id="search" placeholder="Search Here" class="px-8 py-1.5 rounded-lg border-solid border-2 border-[#363062] outline-green-500 shadow-xl">
                    <button class="btn btn-success px-4">SEARCH</button>                       
                 </form>
                @else
                <form action="{{route('admin.showApproval')}}" method="get" class="flex items-center justify-start gap-4 pb-4">
                    <h5>Search Request:</h5>
                    <input type="text" name="search" id="search" placeholder="Search Here" class="px-8 py-1.5 rounded-lg border-solid border-2 border-[#363062] outline-green-500 shadow-xl">
                    <button class="btn btn-success px-4">SEARCH</button>                       
                 </form>
                @endif
                 <a href="{{route('admin.request')}}" class="py-2 px-6 rounded-md bg-violet-500 hover:bg-violet-700 text-white text-center hover:no-underline">REQUEST OF TRANSFERS</a>
                 <a href="{{route('admin.showApproval')}}" class="py-2 px-6 rounded-md bg-red-400 hover:bg-red-500 text-white  text-center hover:no-underline">APPROVAL OF TRANSFERS</a>
            </div>
            

            {{-- tables --}}
            <div class="pt-4 px-8">
                @include('admin.tableTransferRequest')
            </div>

          
        </div>

        @if (session()->has('success'))
                                                                     
        <!-- Modal -->
                <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <!-- Modal Content -->
                    <div class="bg-white rounded-lg shadow-lg p-6 mx-4 sm:mx-auto w-full sm:w-96">
                        <!-- Modal Header -->
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">TransferRequest</h2>
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
    </section>

@endsection