@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Exam Score Report</h2>

    <div>
        <h4>Score Classification by Subject</h4>
        <canvas id="scoreChart" style="max-width: 100%; height: 400px;"></canvas>
    </div>

    <hr>

    <div>
        <h4>Top 10 Students in Group A (Math, Physics, Chemistry)</h4>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Registration Number</th>
                        <th>Math</th>
                        <th>Physics</th>
                        <th>Chemistry</th>
                        <th>Total Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topStudents as $student)
                        <tr>
                            <td>{{ $student->sbd }}</td>
                            <td>{{ $student->toan }}</td>
                            <td>{{ $student->vat_li }}</td>
                            <td>{{ $student->hoa_hoc }}</td>
                            <td>{{ $student->toan + $student->vat_li + $student->hoa_hoc }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const scoreLevels = @json($scoreLevels);
    const subjects = Object.keys(scoreLevels);
    const levelLabels = ['≥8 points', '6 - <8 points', '4 - <6 points', '<4 points'];

    const datasets = levelLabels.map((label, idx) => {
        return {
            label: label,
            data: subjects.map(subject => {
                switch(idx) {
                    case 0: return scoreLevels[subject]['>=8'];
                    case 1: return scoreLevels[subject]['6-8'];
                    case 2: return scoreLevels[subject]['4-6'];
                    case 3: return scoreLevels[subject]['<4'];
                }
            }),
            backgroundColor: ['#28a745', '#ffc107', '#fd7e14', '#dc3545'][idx]
        };
    });

    const ctx = document.getElementById('scoreChart').getContext('2d');
    const scoreChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: subjects.map(s => s.toUpperCase()),
            datasets: datasets
        },
        options: {
            responsive: true,
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            }
        }
    });
</script>
@endsection
