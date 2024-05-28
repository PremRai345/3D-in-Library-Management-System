<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Book</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            display:flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }
        form{
            border: 2px solid black;
            padding: 15px;
            border-radius: 6px;
        }
        label{
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        div{
            font-size: 20px;
            margin-bottom: 5px;
        }
        input{
            font-size: 15px;
            padding: 6px;
            width: 95%;
            border: 1px solid black;
            border-radius: 7px;
        }
        button{
            padding: 7px;
            border: 2px solid black;
            border-radius: 7px;
            font-size: 16px;
            background: white;
            transition: all 0.3s;
        }
        button:hover{
            color: white;
            background: black;
        }

    </style>
</head>
<body>
    <form action="{{$link}}" method="POST" enctype="multipart/form-data">
        <h1><center>{{$title}}</center></h1>
        <hr>
        <br>
        @csrf
        <div>
            <label for="">Book Name</label>
            <div>
                <input type="text" name="bookname" required value="{{$data->BookName}}">
            </div>
        </div>
        <div>
            <label for="">Book Image</label>
            <div>
                <input type="file" name="bookimage" required value="{{$data->BookImage}}">
            </div>
        </div>
        <div>
            <label for="">Book pdf</label>
            <div>
                <input type="file" name="bookpdf" required value="{{$data->BookPdf}}">
            </div>
        </div>
        <div>
            <label for="">Author Name</label>
            <div>
                <input type="text" name="authorname" required value="{{$data->AuthorName}}">
            </div>
        </div>
        <div>
            <label for="">Book Description</label>
            <div>
                <input type="text" name="bookdes" required value="{{$data->BookDescription}}">
            </div>
        </div>
        <button style="margin:10px;" type="submit">Submit</button><button type="reset">reset</button>
    </form>
</body>
</html>