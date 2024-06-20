@extends('layout.adminPanel')

@section('content')
    <section class="min-h-[100vh] flex items-start">

        @include('admin.adminSidebar')
        
        <div class="flex-grow pt-8 h-auto px-3 2xl:max-w-[1700px] xl:max-w-[1300px] max-lg:w-full">
            
            @include('shared.navbar')

            @if ($editing ?? false)
                
            <div class="pt-4 pl-8 max-w-[1200px] gap-4 max-md:p-4 max-md:flex-col-reverse max-md:px-0 max-lg:max-w-full max-lg:pl-4">
                <form action="{{route('file.update', $file->id)}}" method="post" class="grid grid-cols-2 gap-8 px-12 pt-8  max-lg:px-6 max-md:px-4 max-sm:grid-cols-1 max-sm:max-w-[500px] max-sm:mx-auto">
                    @csrf
                    @method('put')
                    <div class="grid">
                        <label for="username" class="text-lg font-bold pb-4">
                            FILE_ID:
                        </label>
                        <input type="text" name="username" readonly id="username" value="{{$file->id}}" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                </div>
                <div class="grid">
                        <label for="name" class="text-lg font-bold pb-4">
                            FILENAME:
                        </label>
                        <a href="{{url('storage/'. $file->path )}}" target="_blank" class="py-3 px-6 rounded-lg shadow-xl text-blue-600 bg-slate-100 border-black outline-green-500">{{$file->filename}}</a>
                    </div>
                    <div class="grid">
                        <label for="username" class="text-lg font-bold pb-4">
                            UPLOADER:
                        </label>
                        <input type="text" name="username" readonly id="username" value="{{$file->userProfile->name}}" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                </div>
                <div class="grid">
                        <label for="username" class="text-lg font-bold pb-4">
                            USER_TYPE:
                        </label>
                        <input type="text" name="username" readonly id="username" value="{{$file->userProfile->user_type}}" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                    </div>
                    <div class="grid">
                        <label for="username" class="text-lg font-bold pb-4">
                            UPLOADED_AT:
                        </label>
                        <input type="text" name="username" readonly id="username" value="{{$file->created_at}}" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                    </div>
                    <div class="grid">
                    <label for="username" class="text-lg font-bold pb-4">
                                RESTRICTIONS:
                            </label>
                            <select name="restrictions" id="restrictions" class="py-3 px-6 rounded-lg shadow-xl bg-slate-100 border-black outline-green-500">
                                <option value="Public" {{$file->restrictions === 'Public' ? 'selected' : ''}}>Public</option>
                                <option value="Everyone" {{$file->restrictions === 'Everyone' ? 'selected' : ''}}>Everyone</option>
                                <option value="{{auth()->user()->userProfile->municipality}}" {{$file->restrictions === auth()->user()->userProfile->municipality ? 'selected' : ''}}>Municipality Only</option>
                                <option value="Only_Me" {{$file->restrictions === 'Only_Me' ? 'selected' : ''}}>Only Me</option>
                            </select>
                        </div>
                        <button type="submit" class="py-3 text-xl px-7  border-r-full border-none bg-green-500 hover:bg-green-600 text-white rounded-lg max-h-[50px] max-w-[200px]  max-sm:mx-auto max-sm:px-12">UPDATE</button>
                    </form>
                        @if ($errors->any())
                        
                        <div class="grid mt-7">
                            @foreach ($errors->all() as $error)
                            <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
                            @endforeach
                        </div>
        
                        @endif
                </div> 
                    @else

                    @php
                    $routeMapping = [
                        'admin.attachments' => route('admin.attachments'),
                        'admin.municipality' => route('admin.municipality'),
                        'admin.search' => route('admin.search'),
                        'admin.public' => route('admin.public'),
                        'admin.onlyme' => route('admin.onlyme')
                    ];
                    $currentRouteName = request()->route()->getName();
                    $formAction = $routeMapping[$currentRouteName] ?? route('admin.onlyme');
                    @endphp
                    <div class="pt-4 md:pl-4 flex flex-col lg:flex-row justify-start items-center gap-4 lg:gap-6 max-md:pl-0">
                        <form action="{{ $formAction }}" method="GET" class="flex items-center justify-start max-lg:justify-center gap-4 w-full lg:w-auto max-[540px]:flex-col">
                            <h5 class="text-lg max-[540px]:text-2xl max-[540px]:font-bold ">Search Attachment:</h5>
                            <input type="text" name="search" id="search" placeholder="Search Here" class="px-8 py-1.5  max-[540px]:max-w-[390px] rounded-lg border-2 border-gray-700 outline-none shadow-xl flex-grow">
                            <button type="submit" class="text-white bg-green-500 rounded-lg hover:bg-green-700 px-4 py-2 max-[540px]:min-w-[200px] ">SEARCH</button>
                        </form>
                        
                        <!-- Button container with flex and gap adjustment -->
                        <div class="flex lg:flex-row justify-center gap-4 items-center lg:mt-0 max-[540px]:grid max-[540px]:grid-cols-2">
                            <a href="{{ route('admin.create') }}" class="text-white text-center py-2 px-2 rounded-lg bg-blue-500 hover:bg-blue-700 w-full hover:no-underline lg:w-auto max-lg:min-w-[180px]  md:max-w-full">
                                CREATE NEW FILE
                            </a>
                            <button id="restrictionsDropdown" class="text-white py-2 px-2 rounded-lg bg-violet-500 hover:bg-violet-700 w-full lg:w-auto  md:max-w-full">
                                RESTRICTIONS
                            </button>
                            <button id="municipalityDropdown" class="text-white py-2 px-2 rounded-lg bg-violet-500 hover:bg-violet-700 w-full max-[540px]:col-span-2  lg:w-auto max-lg:min-w-[180px]  md:max-w-full ">
                                MUNICIPALITY
                            </button>
                        </div>


                                 <!-- Modal structure for RESTRICTIONS -->
                         <div id="restrictionsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                            <div class="bg-white rounded-lg p-4 shadow-lg w-[400px ]">
                                <h3 class="text-xl font-semibold text-center py-4">Select Restriction</h3>
                                <ul id="restrictionsList" class="grid grid-cols-2 gap-8 px-4">
                                    <li><a href="{{ route('admin.public') }}" class="rounded-lg block px-4 py-2 text-black hover:bg-gray-200 hover:no-underline hover:text-blue-700 ">Public</a></li>
                                    <li><a href="{{ route('admin.attachments') }}" class="rounded-lg block px-4 py-2 text-black hover:bg-gray-200 hover:no-underline hover:text-blue-700 ">Everyone</a></li>
                                    <li><a href="{{ route('admin.municipality') }}" class="rounded-lg block px-4 py-2 text-black hover:bg-gray-200 hover:no-underline hover:text-blue-700">Municipality</a></li>
                                    <li><a href="{{ route('admin.onlyme') }}" class="rounded-lg block px-4 py-2 text-black hover:bg-gray-200 hover:no-underline hover:text-blue-700">Only Me</a></li>
                                </ul>
                                <button id="closeRestrictionsModal" class="mt-4 py-2 px-3 bg-red-500 text-white rounded">Close</button>
                            </div>
                        </div>
                                            <!-- Modal structure -->
                                <div id="municipalityModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                                    <div class="bg-white rounded-lg p-4 shadow-lg" style="width: 650px;">
                                        <h3 class="text-lg font-semibold py-2 text-center">Select Municipality(EVERYONE)</h3>
                                        <!-- Create a grid with 3 columns -->
                                        <div class="">
                                            <ul id="municipalitiesList" class="grid grid-cols-3 gap-4 max-[540px]:grid-cols-2">
                                                <li><a href="{{ route('admin.search', 'sta_cruz') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700 ">STACRUZ</a></li>
                                                <li><a href="{{ route('admin.search', 'candelaria') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CANDELARIA</a></li>
                                                <li><a href="{{ route('admin.search', 'masinloc') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">MASINLOC</a></li>
                                                <li><a href="{{ route('admin.search', 'palauig') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">PALAUIG</a></li>
                                                <li><a href="{{ route('admin.search', 'iba') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">IBA</a></li>
                                                <li><a href="{{ route('admin.search', 'botolan') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">BOTOLAN</a></li>
                                                <li><a href="{{ route('admin.search', 'cabangan') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CABANGAN</a></li>
                                                <li><a href="{{ route('admin.search', 'subic') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SUBIC</a></li>
                                                <li><a href="{{ route('admin.search', 'castillejos') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">CASTILLEJOS</a></li>
                                                <li><a href="{{ route('admin.search', 'san_antonio') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN ANTONIO</a></li>
                                                <li><a href="{{ route('admin.search', 'san_felipe') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN FELIPE</a></li>
                                                <li><a href="{{ route('admin.search', 'san_marcelino') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN MARCELINO</a></li>                        
                                                <li><a href="{{ route('admin.search', 'san_narciso') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">SAN NARCISO</a></li>
                                                <li><a href="{{ route('admin.search', 'pdrrmo') }}" class="block px-4 py-2 text-black hover:bg-gray-200 text-xl rounded-lg hover:no-underline hover:text-blue-700">PDRRMO</a></li>
                                            </ul>
                                        </div>
                                        <button id="closeModal" class="mt-4 py-2 px-3 bg-red-500 text-white rounded">Close</button>
                                    </div>
                                </div>
                        {{-- @endif  --}}
         
         
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
                         handleModal("restrictionsDropdown", "restrictionsModal", "closeRestrictionsModal", "restrictionsList");
                         handleModal("municipalityDropdown", "municipalityModal", "closeModal", "municipalitiesList");
                     });
         
        
                     </script>
         
                     {{-- tables --}}
                     <div class="pt-4 xl:px-8 max-lg:px-4 max-w-[1300px] 2xl:max-w-[1500px] max-[1450px]:max-w-[1100px] max-xl:max-w-[970px] max-lg:max-w-full max-sm:px-0">
                         @include('admin.tableAttachments')
                     </div>
         
                     
                     @if (session()->has('failed'))
                                                                 
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
                 
         
                 @if (session()->has('success'))
                                                                 
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
                                            <h5 class="text-lg font-medium" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                        </div>
                                        <div class="modal-body my-4 text-red-500">
                                            Are you sure you want to delete this attachment?
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
                                            const deleteUrl = `/attachment/delete/${fileId}`;
                                            
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
                                
         
                     
         
                     @endif
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
                
                   
                 </div>
             </section>

@endsection