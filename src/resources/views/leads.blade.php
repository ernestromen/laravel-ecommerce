@include('includes.header')

<div class="cotnainer">
    <h2 class="text-center my-5">Leads</h2>
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8">
            @if(!$leads->isEmpty())
                @csvButton($leads)
            <table class="table border">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">First name</th>
                        <th scope="col">Last name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Message</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>

                        @role('admin')
                        <th></th>
                        <th></th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leads as $lead)
                        <tr class="text-center">
                            <th scope="row">{{$lead->id}}</th>
                            <td>{{$lead->firstname}}</td>
                            <td>{{$lead->lastname}}</td>
                            <td>{{$lead->email}}</td>
                            <td>{{$lead->phone}}</td>
                            <td>{{$lead->message}}</td>
                            <td>{{$lead->created_at}}</td>
                            <td>{{$lead->updated_at}}</td>
                            <td> <a href="{{route('edit_lead', ["id" => $lead->id])}}"
                                    class="btn btn-success rounded-circle">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="delete category"></i>
                                </a>
                            </td>
                            <td>
                                <form action={{route('delete_lead', ['id' => $lead])}} method="post" class="m-auto">
                                    {{csrf_field()}}
                                    <button class="btn btn-danger rounded-circle mb-2">
                                        <i class="fa fa-trash-o fa-lg" aria-hidden="true" title="delete category">

                                        </i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center">No leads exist</h>
            @endif
        </div>
        <div class="col-2">

        </div>
    </div>
</div>
@include('includes.footer')
