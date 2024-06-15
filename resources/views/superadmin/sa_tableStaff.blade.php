
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <!-- Example Bootstrap table -->
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">staff_id</th>
                <th scope="col" class="text-center">name</th>
                <th scope="col" class="text-center">email</th>
                <th scope="col" class="text-center">user_type</th>
                <th scope="col" class="text-center">municipality</th>
                <th scope="col" class="text-center">action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($staffs as $staff)
            <tr>
                <th scope="row" class="text-center">{{ $staff->id}} </th>
                <td class="text-center">{{$staff->name}} </td>
                <td class="text-center pt-3 max-w-[300px] whitespace-no-wrap overflow-hidden truncate"> {{$staff->email}} </td>
                <td class="text-center">{{$staff->user_type}} </td>
                <td class="text-center">{{$staff->municipality}} </td>
                <td class="pt-2 text-center flex items-center justify-center gap-4">
                    <a href="{{route('sa.edit-staff', $staff->id)}}" class="no-underline text-white py-2 px-6  bg-green-500 rounded-md hover:no-underline hover:bg-green-600">EDIT</a>
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


        {{$staffs->links()}}

