@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs_index.css') }}">
@endsection

@section('content')
<div class="weight-logs-index__container">

    <div class="card summary-card">
        <div class="summary-section">
            <div class="summary-item"> {{-- hover-effect はCSSで共通化 --}}
                <h3>目標体重</h3>
                <p>{{ $targetWeight !== null ? number_format($targetWeight, 1) . ' kg' : '未設定' }}</p>
            </div>
            <div class="summary-item">
                <h3>目標まで</h3>
                <p>{{ $weightDifference !== null ? ( $weightDifference > 0 ? '+' : '' ) . number_format($weightDifference, 1) . ' kg' : 'N/A' }}</p>
            </div>
            <div class="summary-item">
                <h3>最新体重</h3>
                <p>{{ $currentWeight !== null ? number_format($currentWeight, 1) . ' kg' : 'データなし' }}</p>
            </div>
        </div>
    </div>

    <div class="card table-area-card">
        <div class="search-and-add-section">
            <form action="{{ route('weight_logs.index') }}" method="GET" class="search-form">
                <input type="date" name="date_from" value="{{ request('date_from') }}">
                <span>〜</span>
                <input type="date" name="date_to" value="{{ request('date_to') }}">
                <button type="submit" class="button search-button">検索</button>
                @if(request()->filled('date_from') || request()->filled('date_to'))
                    <a href="{{ route('weight_logs.index') }}" class="button reset-button">リセット</a>
                @endif
            </form>
            <button id="add-data-button" class="button add-data-button-gradient">データを追加</button>
        </div>

        @if((request()->filled('date_from') || request()->filled('date_to')) && isset($searchResultsCount))
            <div class="search-results-info">
                <p>{{ request('date_from') ?? '全て' }} 〜 {{ request('date_to') ?? '全て' }} の検索結果 {{ $searchResultsCount }} 件</p>
            </div>
        @endif

        <table class="weight-logs-table">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                </tr>
            </thead>
            <tbody>
                @forelse($weightLogs as $log)
                <tr class="hover-effect">
                    <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                    <td>{{ number_format($log->weight, 1) }}kg</td>
                    <td>{{ number_format($log->calories) }}cal</td>
                    <td>{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
                    <td>
                        <a href="{{ route('weight_logs.edit', $log->id) }}" class="edit-button button add-data-button-gradient">
                            <svg class="pencil-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.38-2.828-2.829z"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">体重ログがありません。</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-links">
            {{ $weightLogs->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>
<div id="add-data-modal" class="modal">
    <div class="modal-content">
        <h3>Weight Log を追加</h3>
        <form id="add-log-form" action="{{ route('weight_logs.store') }}" method="POST">
            @csrf
            <div class="form__group">
                <label for="log_date">日付: <span class="required-tag">必須</span></label>
                <input type="date" name="date" id="log_date" value="{{ old('date', now()->toDateString()) }}">
                <div class="form__error">@error('date')<div>{{ $message }}</div>@enderror</div>
            </div>
            <div class="form__group">
                <label for="log_weight">体重: <span class="required-tag">必須</span></label>
                <div class="input-with-unit">
                    <input type="text" name="weight" id="log_weight" placeholder="50.0" value="{{ old('weight') }}"> <span class="unit-text">kg</span>
                </div>
                <div class="form__error">@error('weight')<div>{{ $message }}</div>@enderror</div>
            </div>
            <div class="form__group">
                <label for="log_calories">摂取カロリー: <span class="required-tag">必須</span></label>
                <div class="input-with-unit">
                    <input type="text" name="calories" id="log_calories" placeholder="1200" value="{{ old('calories') }}"> <span class="unit-text">cal</span>
                </div>
                <div class="form__error">@error('calories')<div>{{ $message }}</div>@enderror</div>
            </div>
            <div class="form__group">
                <label for="log_exercise_time">運動時間: <span class="required-tag">必須</span></label>
                <input type="time" name="exercise_time" id="log_exercise_time" value="{{ old('exercise_time', '00:00') }}">
                <div class="form__error">@error('exercise_time')<div>{{ $message }}</div>@enderror</div>
            </div>
            <div class="form__group">
                <label for="log_exercise_content">運動内容:</label>
                <textarea name="exercise_content" id="log_exercise_content" rows="3" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                <div class="form__error">@error('exercise_content')<div>{{ $message }}</div>@enderror</div>
            </div>
            <div class="modal-buttons">
                <button type="button" class="button back-button">戻る</button>
                <button type="submit" class="button">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('add-data-modal');
        const addButton = document.getElementById('add-data-button');
        const closeButtons = document.querySelectorAll('.close-button, .back-button');

        if (addButton && modal) {
            addButton.addEventListener('click', function() {
                modal.style.display = 'flex';
            });
        }

        closeButtons.forEach(button => {
            if (button && modal) {
                button.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
            }
        });

        if (modal) {
            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        }

        const hasAddLogErrors = {{ $hasAddLogErrors ? 'true' : 'false' }};
        if (hasAddLogErrors && modal) {
            modal.style.display = 'flex';
        }
    });
</script>
@endsection
