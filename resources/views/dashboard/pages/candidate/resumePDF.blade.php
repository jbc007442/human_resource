<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resume - {{ $user->name }}</title>
    <style>
        /* General Reset */
        * { box-sizing: border-box; }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #2c3e50;
            line-height: 1.5;
            margin: 0;
            padding: 40px;
            background-color: #fff;
        }

        /* Header Section */
        .header {
            text-align: center;
            border-bottom: 2px solid #34495e;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        h1 {
            font-size: 28px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1a252f;
        }
        .contact-info {
            font-size: 13px;
            color: #7f8c8d;
            margin-top: 10px;
        }

        /* Section Styling */
        h3 {
            font-size: 14px;
            color: #2980b9;
            text-transform: uppercase;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-top: 25px;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        /* Experience & Education Items */
        .item {
            margin-bottom: 20px;
        }
        .item-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }
        .item-title {
            font-size: 14px;
            color: #333;
        }
        .item-date {
            font-size: 12px;
            color: #95a5a6;
            float: right; /* Fallback for older PDF engines */
        }
        .item-sub {
            font-style: italic;
            color: #7f8c8d;
            font-size: 13px;
            margin-bottom: 8px;
        }

        /* Lists (Skills & Responsibilities) */
        ul {
            padding-left: 18px;
            margin-top: 5px;
        }
        li {
            font-size: 12.5px;
            margin-bottom: 4px;
        }

        /* Skills Grid */
        .skills-list {
            list-style: none;
            padding: 0;
            display: block;
        }
        .skills-list li {
            display: inline-block;
            background: #f0f3f4;
            padding: 4px 10px;
            border-radius: 4px;
            margin-right: 5px;
            margin-bottom: 8px;
            font-size: 11px;
            color: #34495e;
            border: 1px solid #dcdde1;
        }

        /* Summary */
        .summary-text {
            font-size: 13px;
            text-align: justify;
        }

        /* Print optimization */
        @media print {
            body { padding: 0; }
            .item-date { float: right; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>{{ $user->name }}</h1>
        <div class="contact-info">
            {{ $resume->title }} <br>
            {{ $user->email }} &bull; {{ $user->phone }} <br>
            {{ $resume->address }}
        </div>
    </div>

    <section>
        <h3>Professional Summary</h3>
        <p class="summary-text">{{ $resume->summary }}</p>
    </section>

    <section>
        <h3>Professional Experience</h3>
        @foreach($resume->experiences as $exp)
            <div class="item">
                <div class="item-header">
                    <span class="item-title">{{ $exp->job_title }}</span>
                    <span class="item-date">{{ $exp->start_date }} — {{ $exp->end_date ?? 'Present' }}</span>
                </div>
                <div class="item-sub">{{ $exp->company_name }}</div>

                @php $responsibilities = explode(',', $exp->description); @endphp
                <ul>
                    @foreach($responsibilities as $res)
                        <li>{{ trim($res) }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </section>

    <section>
        <h3>Education</h3>
        @foreach($resume->educations as $edu)
            <div class="item">
                <div class="item-header">
                    <span class="item-title">{{ $edu->degree }}</span>
                    <span class="item-date">{{ $edu->from }} — {{ $edu->to ?? 'Present' }}</span>
                </div>
                <div class="item-sub">{{ $edu->institute }}</div>
            </div>
        @endforeach
    </section>

    <section>
        <h3>Technical Skills</h3>
        <ul class="skills-list">
            @foreach($resume->skills as $skill)
                <li>{{ $skill->skill_name }}</li>
            @endforeach
        </ul>
    </section>

    @if(count($resume->achievements) > 0)
    <section>
        <h3>Key Achievements</h3>
        <ul>
            @foreach($resume->achievements as $ach)
                <li>{{ $ach->title }}</li>
            @endforeach
        </ul>
    </section>
    @endif

</body>
</html>