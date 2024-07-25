<!DOCTYPE html>
<html>

<head>
    <title>Add Subscriber</title>
</head>
<style>
    form {
        /* Center the form on the page */
        margin: 0 auto;
        width: 400px;
        /* Form outline */
        padding: 1em;
        border: 1px solid #ccc;
        border-radius: 1em;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    form li+li {
        margin-top: 1em;
    }

    label {
        /* Uniform size & alignment */
        display: inline-block;
        width: 90px;
        text-align: right;
    }

    input,
    textarea {
        /* To make sure that all text fields have the same font settings
 By default, textareas have a monospace font */
        font: 1em sans-serif;

        /* Uniform text field size */
        width: 300px;
        box-sizing: border-box;

        /* Match form field borders */
        border: 1px solid #999;
    }

    input:focus,
    textarea:focus {
        /* Additional highlight for focused elements */
        border-color: #000;
    }

    textarea {
        /* Align multiline text fields with their labels */
        vertical-align: top;

        /* Provide space to type some text */
        height: 5em;
    }

    .button {
        /* Align buttons with the text fields */
        padding-left: 90px;
        /* same size as the label elements */
    }

    button {
        /* This extra margin represent roughly the same space as the space
 between the labels and their text fields */
        margin-left: 0.5em;
    }
</style>

<body>
    <form action="{{route('Subscriber.store')}}" method="post">
        @csrf
        <ul>
            <li>
                <label for="Subscriber">Subscriber Type:</label>

                <input type="radio" id="student" name="Subscriber" value="student" required>
                <label for="student">Student</label>

                <input type="radio" id="staff" name="Subscriber" value="staff">
                <label for="staff">Staff</label>


            </li>
            @error('Subscriber')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="fullname">Fullname:</label>
                <input type="text" id="fullname" name="fullname" />
            </li>
            @error('fullname')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="college">College:</label>
                <input type="text" id="college" name="college" />
            </li>
            @error('college')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="college_number">CollegeNumber:</label>
                <input type="text" id="college_number" name="college_number" />
            </li>
            @error('college_number')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="phone_number">phone_number:</label>
                <input type="text" id="phone_number" name="phone_number" />
            </li>
            @error('phone_number')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" />
            </li>
            @error('email')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" />
            </li>
            @error('password')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="semester">semester code:</label>
                <input type="text" id="semester" name="semester" />
            </li>
            @error('semester')
            <p style="color:red;">{{$message}}</p>
            @enderror

        </ul>
        <li class="button">
            <button type="submit">Add Subscriber</button>
        </li>
    </form>
</body>

</html>