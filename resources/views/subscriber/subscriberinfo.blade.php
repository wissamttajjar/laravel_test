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
        @foreach($user as $users)

        <tr>
            <td> {{$users ['user_name']}} </td>
            <td>{{$users ['email']}}</td>
            <td>{{$users ['phone_number']}}</td>
            <td>{{$users ['role']}}</td>





            <td><a href="{{route('Subscriber.edit',$users['duser_id'])}}"><button> Edit</button></a></td>
            <td>

                <form action=" {{route('Subscriber.destroy',$users['duser_id'])}}" method="post">
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