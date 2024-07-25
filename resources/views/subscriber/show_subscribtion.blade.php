<!DOCTYPE html>
<html>

<head>

</head>

<body>


    <h3>User</h3>
    <table border="border">
        <tr>
            <th>User_Name</th>
            <th>email</th>
            <th>phone_number</th>
            <th>User Role</th>
            <th>Edit</th>
            <th>Delet</th>



        </tr>
        @foreach($subscriber as $subscriber)

        <tr>
            <td> {{$subscriber ['subscriber_type']}} </td>
            <td>{{$subscriber ['fullname']}}</td>
            <td>{{$subscriber ['college']}}</td>
            <td>{{$subscriber ['subscriber_state']}}</td>





            <td><a href="{{route('Subscriber.edit',$subscriber['subscriber_id'])}}"><button> Edit</button></a></td>
            <td>

                <form action=" {{route('Subscriber.destroy',$subscriber['subscriber_id'])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delet">
                </form>
            </td>
        </tr>
        @endforeach
    </table>



</body>

</html>