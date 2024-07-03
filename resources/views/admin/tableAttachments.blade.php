
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

 <div class="table-responsive">
    
 <table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">FILE_ID</th>
            <th scope="col" class="text-center">FILENAME</th>
            <th scope="col" class="text-center">UPLOADER</th>
            <th scope="col" class="text-center">USER_TYPE</th>
            <th scope="col" class="text-center">UPLOADED_AT</th>
            <th scope="col" class="text-center">RESTRICTIONS</th>
            <th scope="col" class="text-center">ACTIONS</th>
        </tr>
    </thead>
    <tbody>
     
      @forelse ($files as $file)
            <tr>
                <th scope="row" class="text-center pt-3">{{$file->id}} </th>
                <td class="text-center pt-3  max-w-[300px] whitespace-no-wrap overflow-hidden truncate">
                    <a href="{{url('storage/'. $file->path )}}" target="_blank">{{$file->filename}}</a>
                </td>
                <td class="text-center pt-3 max-w-[250px] whitespace-no-wrap overflow-hidden truncate">
                    {{$file->userProfile->name}} 
                </td>
                <td class="text-center pt-3">{{$file->userProfile->user_type}} </td>
                <td class="text-center pt-3 max-w-[100px] whitespace-no-wrap overflow-hidden truncate">{{$file->created_at}} </td>
                <td class="text-center pt-3">{{$file->restrictions}} </td>
                <td class="pt-2 text-center flex items-center justify-center gap-4">
                <a href="{{route('file.edit',  $file->id)}}" class="no-underline text-white py-2 px-6  bg-green-500 rounded-md hover:no-underline hover:bg-green-600">EDIT</a>
                <button class="delete-btn text-white py-2 px-6 bg-red-500 hover:bg-red-600 rounded-md"
                        data-file-id="{{$file->id}}"
                        data-toggle-modal="#deleteConfirmationModal">
                    DELETE
                </button>
                </td>
            </tr>
                @empty
                <div class="text-center ">
                    <p class="text-red-500 font-bold text-lg">NO CURRENTLY ATTACHMENT</p>
                </div>
      @endforelse
      
      
    </tbody>
</table>
 </div>


<div class="py-3">
    {{$files->links()}}
</div>
    




    




