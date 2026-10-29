@extends('layouts.app')

@section('content')
<style>
    .page-hero {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 45px 0;
        margin-bottom: 45px;
    }
    .page-hero h1 {
        font-size: 34px;
        color: var(--primary-dark);
        font-weight: 700;
    }
    .page-body-container {
        max-width: 960px;
        margin: 0 auto;
        padding-bottom: 80px;
        font-size: 15.5px;
        line-height: 1.8;
        color: #334155;
    }
    .page-body-container h2 {
        font-size: 24px;
        margin: 30px 0 15px;
        color: var(--primary-dark);
        font-weight: 700;
        border-bottom: 2px solid var(--primary-accent);
        padding-bottom: 8px;
    }
    .page-body-container h3 {
        font-size: 20px;
        margin: 25px 0 12px;
        color: var(--primary-dark);
        font-weight: 700;
    }
    .page-body-container p {
        margin-bottom: 20px;
    }
    .page-body-container ul, .page-body-container ol {
        margin: 0 0 20px 24px;
    }
    .page-body-container li {
        margin-bottom: 8px;
    }
    .page-body-container table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
    }
    .page-body-container th, .page-body-container td {
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
    }
    .page-body-container th {
        background: var(--cream-bg);
        color: var(--primary-dark);
        font-weight: 700;
    }
</style>

<div class="page-hero">
    <div class="container">
        <h1>{{ $page->title }}</h1>
    </div>
</div>

<div class="container">
    <article class="page-body-container">
        {!! $page->content !!}
    </article>
</div>
@endsection
