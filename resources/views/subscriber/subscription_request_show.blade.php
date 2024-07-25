<!DOCTYPE html>
<html>

<head>

</head>

<body>


    <h3>Subscription Request</h3>
    <table border="border">
        <tr>
            <th>subscriber_type</th>
            <th>full_name</th>
            <th>college</th>




        </tr>
        @foreach($request as $request)

        <tr>
            <td> {{$request ['subscriber_type']}} </td>
            <td>{{$request ['full_name']}}</td>
            <td>{{$request ['college']}}</td>






            <td><a href="{{route('SubscribtionRequest.show',$request['srequest_id'])}}"><button> Show</button></a></td>

        </tr>
        @endforeach
    </table>



</body>

</html>