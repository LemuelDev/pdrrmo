<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


       <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">user_id</th>
                <th scope="col" class="text-center">name</th>
                <th scope="col" class="text-center">user_type</th>
                <th scope="col" class="text-center">current_municipality</th>
                <th scope="col" class="text-center">request_municipality</th>
                <th scope="col" class="text-center">requested_at</th>
                <th scope="col" class="text-center">action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($staffs as $staff)
            <tr>
                <th scope="row" class="text-center">{{ $staff->id}} </th>
                <td class="text-center">{{$staff->name}} </td>
                <td class="text-center"> {{$staff->user_type}} </td>
                <td class="text-center pt-3 max-w-[120px] whitespace-no-wrap overflow-hidden truncate">{{$staff->current_municipality}}</td>
                <td class="text-center pt-3 max-w-[120px] whitespace-no-wrap overflow-hidden truncate">{{$staff->requested_municipality}}</td>
                <td class="text-center pt-3 max-w-[90px] whitespace-no-wrap overflow-hidden truncate">{{$staff->created_at}}</td>
                <td class="pt-2 text-center flex items-center justify-center gap-4">
                   @if (request()->route()->getName() === 'admin.request')
                   <a href="{{route('admin.requestApproved', $staff->id)}}" class="no-underline text-white py-2 px-6  bg-green-500 rounded-md hover:no-underline hover:bg-green-600">Approve</a>
                   @else
                   <a href="{{route('admin.approved', $staff->id)}}" class="no-underline text-white py-2 px-6  bg-green-500 rounded-md hover:no-underline hover:bg-green-600">Approve</a>
                   @endif
                    <button class="delete-btn text-white py-2 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                            data-file-id="{{$staff->id}}"
                            data-toggle-modal="#deleteConfirmationModal">
                        DELETE
                    </button>
                </td>
            </tr>
            @empty
            @if (request()->route()->getName() === 'admin.request')
            <div class="text-center ">
                <p class="text-red-500 font-bold text-lg">NO CURRENTLY TRANSFER FOR REQUEST</p>
            </div>
            @else
            <div class="text-center ">
                <p class="text-red-500 font-bold text-lg">NO CURRENTLY TRANSFER FOR APPROVAL</p>
            </div>
            @endif
            
            @endforelse
           
            </tbody>
        </table>
       </div>


        <div class="py-3">
            {{$staffs->links()}}
        </div>