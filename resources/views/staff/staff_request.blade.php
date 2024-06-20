@extends('layout.staffPanel')

@section('content')
    <section class="min-h-[100vh] w-full flex items-start">
        @include('staff.staff_sidebar')

        <div class="flex-grow px-4 pt-8 h-auto border-solid">

            @include('shared.navbar')

            <div class="pt-16 pl-8 max-md:pt-8 max-md:pl-0">
                <h4 class="text-2xl font-bold max-md:text-center">REQUEST OF TRANSFER:</h4>
           </div>
           
 <div class="py-4 pl-8 flex items-start justify-around max-w-[1200px] gap-4 max-md:p-4 max-md:flex-col-reverse max-md:px-0">
    <div class="max-w-[450px] w-full max-md:max-w-[700px] max-md:mx-auto max-sm:w-full">
        <form action="{{ route('staff.requestTransfer') }}" method="post" class="grid gap-6 p-8 px-10 w-full shadow-2xl rounded-lg max-md:min-w-0 max-md:p-6 max-sm:px-4 max-sm:w-full" enctype="multipart/form-data">
            @csrf
            <label for="requested_municipalityy" class="text-xl font-bold pb-4">Municipality:</label>
            <select name="requested_municipality" id="requested_municipality" aria-placeholder="Municipality" class="py-3 px-6 bor-r-8 bg-slate-100 border-black outline-green-500">
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
           <button type="submit" class="py-3 text-xl px-7  border-r-full border-none bg-green-500 hover:bg-green-600 text-white rounded-lg ">Request to Transfer</button>
        </form>
            @if ($errors->any())
            <div class="grid mt-7">
                @foreach ($errors->all() as $error)
                <p class="py-1 text-lg text-red-500 text-center"> {{ $error }}</p>
                @endforeach
            </div>
            @endif
    </div>
        <div class=" p-8 py-16 pt-4 text-start leading-10 shadow-2xl rounded-lg max-md:text-center max-md:max-w-full max-md:mx-auto max-sm:max-w-full max-sm:py-10 max-sm:px-4">
            <h4 class="text-2xl font-bold pb-2">IMPORTANT THINGS TO CONSIDER:</h4>
            <p>- the request will be approved by your admin.</p>
            <p>- next is the approval of the admin you want to transfer to.</p>
        </div>
    </div> 
          
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
