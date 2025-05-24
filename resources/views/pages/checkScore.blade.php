@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-4 shadow-sm">
        <h4>User Registration</h4>
        <form method="POST" action="{{ route('check.score') }}">
            @csrf
            <label class="form-label mt-2">Registration Number:</label>
            <div class="input-group mb-3">
                <input type="number" name="sbd" class="form-control" placeholder="Enter registration number">
                <button class="btn btn-dark">Submit</button>
            </div>
            @error('sbd')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </form>
    </div>

    @if(isset($score))
        <div class="card p-4 shadow-sm">
            <h4>Detailed Scores</h4>
            <p>Registration Number: {{ $score->sbd }}</p>
            <ul>
                <li>Math: {{ $score->toan }}</li>
                <li>Literature: {{ $score->ngu_van }}</li>
                <li>Foreign Language: {{ $score->ngoai_ngu }}</li>
                <li>Physics: {{ $score->vat_li }}</li>
                <li>Chemistry: {{ $score->hoa_hoc }}</li>
                <li>History: {{ $score->lich_su }}</li>
                <li>Geography: {{ $score->dia_li }}</li>
                <li>Civic Education: {{ $score->gdcd }}</li>
                <li>Foreign Language Code: {{ $score->ma_ngoai_ngu }}</li>
            </ul>
        </div>
    @elseif(request()->has('sbd'))
        <div class="alert alert-warning mt-3">No score found for this registration number.</div>
    @endif


@endsection

