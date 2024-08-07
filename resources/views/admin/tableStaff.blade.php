
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


       <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">STAFF_ID</th>
                <th scope="col" class="text-center">NAME</th>
                <th scope="col" class="text-center">EMAIL</th>
                <th scope="col" class="text-center">USER_TYPE</th>
                <th scope="col" class="text-center">MUNICIPALITY</th>
                <th scope="col" class="text-center">USER_STATUS</th>
                <th scope="col" class="text-center">ACTION</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($staffs as $staff)
            <tr>
                <th scope="row" class="text-center">{{ $staff->id}} </th>
                <td class="text-center pt-3 max-w-[300px] whitespace-no-wrap overflow-hidden truncate">{{$staff->name}} </td>
                <td class="text-center pt-3 max-w-[300px] whitespace-no-wrap overflow-hidden truncate"> {{$staff->email}} </td>
                <td class="text-center">{{$staff->user_type}} </td>
                <td class="text-center">{{$staff->municipality}} </td>
                <td class="text-center">{{$staff->user_status}} </td>
                <td class="pt-2 text-center flex items-center justify-center gap-4">
                    <form action="{{ $staff->user_status === 'enable' ? route('admin.disable', $staff->id) : route('admin.enable', $staff->id) }}" method="POST">
                        @csrf
                        @method('put')
                        @if ($staff->user_status === 'enable')
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
                            data-file-id="{{$staff->id}}"
                            data-toggle-modal="#deleteConfirmationModal">
                        DELETE
                    </button>
                </td>
            </tr>
            @empty
            <div class="text-center ">
                <p class="text-red-500 font-bold text-lg">NO CURRENTLY STAFF</p>
            </div>
            @endforelse
           
            </tbody>
        </table>
       </div>


        <div class="py-3">
            {{$staffs->links()}}
        </div>

