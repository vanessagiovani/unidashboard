@extends('layouts.sidebar')
@section('content')
    <style>
        .act-btn{
      background:#f59e0b;
      display: block;
      width: 50px;
      height: 50px;
      line-height: 50px;
      text-align: center;
      color: white;
      font-size: 30px;
      font-weight: bold;
      border-radius: 50%;
      -webkit-border-radius: 50%;
      text-decoration: none;
      transition: ease all 0.3s;
      position: fixed;
      right: 30px;
      bottom:30px;
    }
.act-btn:hover{background: blue}
        
        a {
            text-decoration: none;
        }

        .action {
            display: flex;
        }
    </style>
    
    @if (!$file->isEmpty())
    <div style="padding-left: 18vw">
        <table class="styled-table" style="color: #708090">
            <tbody>
                <thead>
                    <tr style="background-color: #c8a0a0; color:#ffffff;">
                        <th>#</th>
                        <th>File Name</th>
                        <th>Shared</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($file as $i => $item)
                @php
                    $url = false;
                    if($item -> public) $url = true;
                    @endphp
                    <tr>
                        <td>{{$i+1}}</td>
                        <td><a href="/view/{{$item->id}}">{{$item->name}}</a></td>
                        <td>
                            @if ($url)
                            <a href="/share/{{$item->id}}">Yes</a>
                            @else
                            No
                            @endif
                        </td>
                        <td class="action">
                            <a href="#open-update{{ $i }}">
                                <button type="submit"
                                style="width: 5.5vw;background-color:#0ea5e9;height:2vw;border-radius:1vw;border:none;color:white; margin-right: 0.8vw">Update</button>
                            </a>
                            
                            <div id="open-update{{ $i }}" class="modal-window">
                                <div class="outside">
                                    <div class="inside" style="background-color: white;">
                                        <a href="#" title="Close" class="modal-close" style="margin-bottom: 5vh">X</a>
                                        <form action="/update/{{$item->id}}" method="post">
                                            @csrf
                                            <input type="text" name="name" id="" value="{{$item->name}}">
                                            <select class="form-select" name="public">
                                                @if ($url)
                                                    <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                                    @else
                                                    <option value="1">Yes</option>
                                                    <option value="0" selected>No</option>
                                                    @endif
                                            </select>
                                            <button type="submit"
                                            style="width: 5.5vw;background-color:#28A745;height:2vw;border-radius:1vw;border:none;color:white">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <form action="/destroy/{{ $item->id }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <div>
                                    <button type="submit"
                                    style="width: 5.5vw;background-color:#F05F40;height:2vw;border-radius:1vw;border:none;color:white">Delete</button>
                                </div>
                            </form>
        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="empty">
        <h1>You don't have any files :(</h1>
        <img src="/storage/emptyfiles.png" alt="">
    </div>
    @endif
    <a href="#open-modal" class="act-btn">
        +
        </a>      
        <div id="open-modal" class="modal-window">
            <div class="outside">
                <div class="inside" style="background-color: white;">
                    <a href="#" title="Close" class="modal-close" style="margin-bottom: 5vh">X</a>
                    <h1>Upload Your File!</h1>
                    <small>Files should be in PDF</small>
                    <div><img src="/storage/uploadicon.png" alt="" height="200px" width="200px"></div>
                    <form action="/upload" method="POST" enctype="multipart/form-data"> @csrf<input type="file" accept="application/pdf" onchange="form.submit()" required name="file"></form>
            </div>
            </div>
        </div>
@endsection