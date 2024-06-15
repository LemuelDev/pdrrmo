
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <!-- Example Bootstrap table -->
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">admin_id</th>
                <th scope="col" class="text-center">name</th>
                <th scope="col" class="text-center">email</th>
                <th scope="col" class="text-center">user_type</th>
                <th scope="col" class="text-center">user_status</th>
                <th scope="col" class="text-center">municipality</th>
                <th scope="col" class="text-center">action</th>
            </tr>
            </thead>
            <tbody>
           @forelse ($admins as $admin)
           <tr>
                <th scope="row" class="text-center">{{$admin->id}} </th>
                <td class="text-center">{{$admin->name}} </td>
                <td class="text-center pt-3  max-w-[300px] whitespace-no-wrap overflow-hidden truncate">{{$admin->email}} </td>
                <td class="text-center">{{$admin->user_type}} </td>
                <td class="text-center">{{$admin->user_status}} </td>
                <td class="text-center">{{$admin->municipality}} </td>
                <td class="pt-2 text-center flex items-center justify-center gap-4">
                    @if (request()->route()->getName() === 'sa.admins')
                        <a href="{{route('sa.edit-admin', $admin->id)}}" class="no-underline text-white py-2 px-6  bg-green-500 rounded-md hover:no-underline hover:bg-green-600">EDIT</a>
                    @else
                    <a href="{{route('admin.edit-admin', $admin->id)}}" class="no-underline text-white py-2 px-6  bg-green-500 rounded-md hover:no-underline hover:bg-green-600">EDIT</a>
                    @endif
                    <button class="delete-btn text-white py-2 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                            data-file-id="{{$admin->id}}"
                            data-toggle-modal="#deleteConfirmationModal">
                        DELETE
                    </button>
                </td>
            </tr>
      
           @empty
           <div class="text-center ">  
                <p class="text-red-500 font-bold text-lg">NO CURRENTLY ADMINS</p>
            </div>
           @endforelse
            
        </table>

        {{$admins->links()}}

