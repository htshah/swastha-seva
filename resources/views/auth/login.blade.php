@extends('layouts.main')

@section('styles')
    <style>
        body{
            background: #fff;
            padding: 21vh 0;
        }
        .card-title{
            font-weight: 500 !important;
            padding: 20px 0 5px;
            margin-bottom: 0 !important;
        }

        .card-subtitle{
            display: block;
            color: #9e9e9e;
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2 m4 offset-m4">
        </div>
    </div>
    <div class="row">
        <div class="col s8 offset-s2 m4 offset-m4">
            <div class="card white grey-text text-darken-4">
                <div class="card-content">
                    <span class="card-title">Swastha Seva</span>
                    <span class="card-subtitle">Login to continue.</span>
                    <form id="login-form">
                        <div class="input-field">
                            <label for="mobile">Mobile No.</label>
                            <input type="text" name="mobile" id="mobile">
                        </div>
                    </form>
                </div>
                <div class="card-action right-align">
                    <a class="blue darken-2 waves-effect waves-light btn">Send OTP</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
