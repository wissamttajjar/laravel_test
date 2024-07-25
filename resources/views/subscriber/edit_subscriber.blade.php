<!DOCTYPE html>
<html>

<head>
    <title>Contact Form</title>
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
                <label for="adminKey"> AdminKey</label>
                <input type="text" id="adminKey" name="adminKey" />
            </li>
            @error('adminKey')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="user_name">User_Name:</label>
                <input type="text" id="user_name" name="user_name" />
            </li>
            @error('user_name')
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
                <label for="phone_number">phone_number:</label>
                <input type="text" id="phone_number" name="phone_number" />
            </li>
            @error('phone_number')
            <p style="color:red;">{{$message}}</p>
            @enderror
            <li>
                <label for="role">User Role:</label>
                <br>
                <input type="radio" id="admin" name="role" value="admin" required>
                <label for="admin">Admin</label>
                <br>
                <input type="radio" id="user_university" name="role" value="user_university">
                <label for="user_university">user_university</label>
                <br>
                <input type="radio" id="user_company" name="role" value="user_company">
                <label for="user_company">user_company</label>
            </li>
            @error('role')
            <p style="color:red;">{{$message}}</p>
            @enderror
        </ul>
        <li class="button">
            <button type="submit">Add User</button>
        </li>
    </form>
</body>

</html>