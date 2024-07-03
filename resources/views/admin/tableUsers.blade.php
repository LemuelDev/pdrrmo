
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <div class="table-responsive">
               
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">USERS_ID</th>
                <th scope="col" class="text-center">NAME</th>
                <th scope="col" class="text-center">EMAIL</th>
                <th scope="col" class="text-center">USER_TYPE</th>
                <th scope="col" class="text-center">MUNICIPALITY</th>
                <th scope="col" class="text-center">USER_STATUS</th>
                <th scope="col" class="text-center">ACTION</th>
            </tr>
            </thead>
            <tbody>
           @forelse ($admins as $admin)
           <tr>
                <th scope="row" class="text-center">{{$admin->id}} </th>
                <td class="text-center">{{$admin->name}} </td>
                <td class="text-center pt-3  max-w-[300px] whitespace-no-wrap overflow-hidden truncate">{{$admin->email}} </td>
                <td class="text-center">{{$admin->user_type}} </td>
                <td class="text-center">{{$admin->municipality}} </td>
                <td class="text-center">{{$admin->user_status}} </td>
                <td class="pt-2 text-center flex items-center justify-center gap-4">
                    <form action="{{ $admin->user_status === 'enable' ? route('admin.disable', $admin->id) : route('admin.enable', $admin->id) }}" method="POST">
                        @csrf
                        @method('put')
                        @if ($admin->user_status === 'enable')
                        <button type="submit" class="text-white py-2 px-6 bg-green-500 rounded-md hover:bg-green-600">
                            DISABLE
                        </button>
                        @else
                        <button type="submit" class="text-white py-2 px-6 bg-green-500 rounded-md hover:bg-green-600">
                            ENABLE
                        </button>
                        @endif
                    </form>
                    
                    <button class="delete-btn text-white py-2 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                            data-file-id="{{$admin->id}}"
                            data-toggle-modal="#deleteConfirmationModal">
                        DELETE
                    </button>
                </td>
            </tr>
      
           @empty
           <div class="text-center ">  
                <p class="text-red-500 font-bold text-lg">NO CURRENTLY USERS</p>
            </div>
           @endforelse
            
        </table>
        </div>

        <div class="py-3">
            {{$admins->links()}}
        </div>

