<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Scout Report: {{ $player->user->name }}</title>
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            color: #1a1a1a; 
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }
        .container { padding: 40px; }
        
        /* Sidebar Accent */
        .accent-bar {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 15px;
            background-color: {{ $settings->primary_color ?? '#00FF41' }};
        }

        /* Branding Header */
        .branding {
            background-color: #0f172a;
            color: white;
            padding: 30px 40px;
            margin-bottom: 40px;
        }
        .logo-box { width: 60px; height: 60px; float: left; margin-right: 20px; }
        .academy-info { float: left; }
        .academy-name { 
            font-size: 22px; 
            font-weight: 900; 
            text-transform: uppercase; 
            letter-spacing: -1px;
            font-style: italic;
        }
        .academy-tag { 
            font-size: 10px; 
            color: {{ $settings->primary_color ?? '#00FF41' }}; 
            font-weight: 900; 
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .contact-right { float: right; text-align: right; font-size: 9px; color: #94a3b8; font-weight: bold; }
        .clearfix { clear: both; }

        /* Player Profile Section */
        .player-header { margin-bottom: 30px; }
        .player-photo {
            width: 140px;
            height: 140px;
            float: left;
            border: 4px solid {{ $settings->primary_color ?? '#00FF41' }};
            border-radius: 20px;
            overflow: hidden;
            background: #f1f5f9;
        }
        .player-photo img { width: 100%; height: 100%; object-fit: cover; }
        .player-main-info { float: left; margin-left: 30px; margin-top: 15px; }
        .p-name { font-size: 36px; font-weight: 900; text-transform: uppercase; italic; letter-spacing: -1.5px; line-height: 1; }
        .p-meta { 
            font-size: 12px; 
            font-weight: 900; 
            text-transform: uppercase; 
            color: #64748b; 
            margin-top: 8px;
            letter-spacing: 1px;
        }
        .p-badge {
            display: inline-block;
            background: {{ $settings->primary_color ?? '#00FF41' }};
            color: #000;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 900;
            margin-top: 15px;
            text-transform: uppercase;
        }

        /* Stats Grid */
        .section-header {
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #0f172a;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 20px;
            margin-top: 40px;
        }
        
        .details-table { width: 100%; border-collapse: collapse; }
        .details-table td { padding: 12px 0; border-bottom: 1px solid #f1f5f9; }
        .label { font-size: 9px; font-weight: 900; text-transform: uppercase; color: #94a3b8; }
        .value { font-size: 14px; font-weight: 700; color: #1e293b; }

        /* Skill Bars */
        .skill-row { margin-bottom: 15px; }
        .skill-label { font-size: 10px; font-weight: 900; text-transform: uppercase; color: #1e293b; margin-bottom: 5px; }
        .skill-bar-bg { background: #f1f5f9; height: 8px; border-radius: 4px; overflow: hidden; position: relative; }
        .skill-bar-fill { 
            background: {{ $settings->primary_color ?? '#00FF41' }}; 
            height: 100%; 
            border-radius: 4px; 
        }
        .skill-val { position: absolute; right: 0; top: -18px; font-size: 10px; font-weight: 900; color: {{ $settings->primary_color ?? '#00FF41' }}; }

        /* QR Code & Footer */
        .footer {
            position: absolute;
            bottom: 40px;
            left: 40px;
            right: 40px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        .qr-section { float: right; text-align: center; }
        .qr-box { width: 80px; height: 80px; background: #fff; margin-bottom: 5px; border: 1px solid #e2e8f0; padding: 5px; }
        .footer-text { float: left; width: 70%; font-size: 8px; color: #94a3b8; font-weight: bold; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="accent-bar"></div>
    
    <div class="branding">
        <div class="logo-box">
            @if($settings->academy_logo)
                <img src="{{ public_path('storage/' . $settings->academy_logo) }}" style="width: 100%; height: 100%; object-fit: contain;">
            @else
                <div style="background: {{ $settings->primary_color ?? '#00FF41' }}; width: 100%; height: 100%; border-radius: 10px;"></div>
            @endif
        </div>
        <div class="academy-info">
            <div class="academy-name">{{ $settings->academy_name ?? 'Think Right Football Academy' }}</div>
            <div class="academy-tag">Elite Performance Data Sheet</div>
        </div>
        <div class="contact-right">
            {{ $settings->address }}<br>
            {{ $settings->phone_number }}<br>
            {{ $settings->email }}
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="container">
        <div class="player-header">
            <div class="player-photo">
                @if($player->profile_photo)
                    <img src="{{ public_path('storage/' . $player->profile_photo) }}">
                @else
                    <div style="padding: 40px; text-align: center; color: #cbd5e1; font-size: 40px; font-weight: 900;">TRFA</div>
                @endif
            </div>
            <div class="player-main-info">
                <div class="p-name">{{ $player->user->name }}</div>
                <div class="p-meta">
                    U{{ ceil($player->age / 2) * 2 }} Division &bull; {{ $player->age }} Years Old &bull; {{ $player->preferred_foot }} Foot
                </div>
                <div class="p-badge">{{ $player->position }}</div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div style="width: 100%;">
            <div style="width: 45%; float: left;">
                <div class="section-header">Physical Profile</div>
                <table class="details-table">
                    <tr>
                        <td class="label">Height</td>
                        <td class="value">{{ $player->height ? $player->height . ' cm' : '---' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Weight</td>
                        <td class="value">{{ $player->weight ? $player->weight . ' kg' : '---' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Nationality</td>
                        <td class="value">Nigeria</td>
                    </tr>
                </table>

                <div class="section-header">Athlete Bio</div>
                <p style="font-size: 11px; color: #475569; font-style: italic; line-height: 1.8;">
                    {{ $player->bio ?: 'High-potential athlete currently enrolled in the elite development program at Think Right Football Academy. Demonstrating consistent growth in tactical awareness and technical execution.' }}
                </p>
            </div>

            <div style="width: 45%; float: right;">
                <div class="section-header">Performance Metrics</div>
                <div style="margin-top: 10px;">
                    @foreach($stats as $label => $value)
                    <div class="skill-row">
                        <div class="skill-label">{{ $label }}</div>
                        <div class="skill-bar-bg">
                            <div class="skill-val">{{ $value }}%</div>
                            <div class="skill-bar-fill" style="width: {{ $value }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="footer">
            <div class="footer-text">
                <strong>CONFIDENTIAL SCOUT REPORT</strong><br>
                This document contains verified performance data from the Think Right Football Academy internal assessment system. Unauthorized distribution is prohibited. © {{ date('Y') }} TRFA Elite Management.
            </div>
            <div class="qr-section">
                <div class="qr-box">
                    @php
                        $qrUrl = route('showcase', ['player' => $player->id]);
                        $result = \Endroid\QrCode\Builder\Builder::create()
                            ->writer(new \Endroid\QrCode\Writer\PngWriter())
                            ->data($qrUrl)
                            ->size(100)
                            ->margin(0)
                            ->build();
                        $qrBase64 = base64_encode($result->getString());
                    @endphp
                    <img src="data:image/png;base64,{{ $qrBase64 }}" style="width: 100%; height: 100%;">
                </div>
                <div style="font-size: 7px; font-weight: 900; text-transform: uppercase; color: #94a3b8;">Scan for Live Profile</div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</body>
</html>
