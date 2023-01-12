@extends('layouts.app')

@section('content')
<style>
    section {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    div {
        color: #fff;
        width: 100%;
        background: #2d2d2d;
        display: flex;
        flex-direction: column;
        align-items: center
    }

</style>

    <section>
        <div>
            <img style="text-align" width="150px" alt="" src="http://staff.prado.test/staffFiles/assets/img/hospital1.png">
            <p style="font-weight: 900; font-size: 10rem; opacity:.5">Ops!</p>
            <p style="text-align:center; font-size:2rem">No internet connection</p>
        </div>
    </section>

@endsection