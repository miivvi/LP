@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">You can play the game and get a guaranteed prize</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($user->is_game_available == 1)
                            <div style="text-align: center">
                                <a id="play" class="btn btn-success btn-lg">Play</a>
                                <div id="response"></div>
                            </div>

                        @else
                            <div>You've already taken your chance</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
